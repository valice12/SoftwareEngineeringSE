<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MsMenu;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->input('category', null);
        $searchQuery = $request->input('search', null);
        
        $query = DB::table('msmenu')
            ->select('menuID', 'menuName', 'menuPrice', 'menuType', 'menuImage');
        
        // Filter berdasarkan kategori jika dipilih
        if ($selectedCategory) {
            $query->where('menuType', $selectedCategory);
        }
        
        // Filter berdasarkan kata kunci pencarian
        if ($searchQuery) {
            $query->where('menuName', 'like', '%'.$searchQuery.'%');
        }
        
        // Jika tidak ada filter, ambil 20 produk pertama
        if (!$selectedCategory && !$searchQuery) {
            $query->take(20);
        }
        
        $products = $query->get()->map(function($product) {
            // Handle image path
            if ($product->menuImage) {
                $product->imageUrl = asset('storage/' . $product->menuImage);
            } else {
                $product->imageUrl = asset('images/default-product.png');
            }
            return $product;
        });
        
        return view('product', [
            'products' => $products,
            'selectedCategory' => $selectedCategory,
            'searchQuery' => $searchQuery
        ]);
    }

    public function show($id)
    {
        $today = now()->format('l, d F Y');
        $product = DB::table('msmenu')
            ->where('menuID', $id)
            ->first();

        if (!$product) {
            abort(404); // Produk tidak ditemukan
        }
        
        return view('product-detail', [
            'product' => $product,
            'today' => $today
        ]);
    }

    public function edit($id)
    {
        $today = now()->format('l, d F Y');
        $product = DB::table('msmenu')->where('menuID', $id)->first();
        
        // Convert BLOB to base64 for display
        if ($product && $product->menuImage) {
            $product->imageBase64 = 'data:image/jpeg;base64,' . base64_encode($product->menuImage);
        } else {
            $product->imageBase64 = asset('images/default-product.png');
        }
        
        return view('product-edit', [
            'product' => $product,
            'today' => $today
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'menuName' => 'required|string|max:255',
            'menuPrice' => 'required|numeric',
            'menuCalorie' => 'required|integer',
            'menuType' => 'required|string',
            'menuImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();

        try {
            $updateData = [
                'menuName' => $request->menuName,
                'menuPrice' => $request->menuPrice,
                'menuCalorie' => $request->menuCalorie,
                'menuType' => $request->menuType
            ];

            if ($request->hasFile('menuImage') && $request->file('menuImage')->isValid()) {
                // Hapus gambar lama jika ada
                $oldImage = DB::table('msmenu')->where('menuID', $id)->value('menuImage');
                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
                
                // Simpan gambar baru
                $filePath = $request->file('menuImage')->store('products', 'public');
                $updateData['menuImage'] = $filePath;
            }

            DB::table('msmenu')
                ->where('menuID', $id)
                ->update($updateData);

            DB::commit();

            return redirect()->route('product.detail', $id)
                        ->with('success', 'Product updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Failed to update: '.$e->getMessage());
        }
    }

    public function deleteImage($id)
    {
        DB::beginTransaction();
        
        try {
            $product = DB::table('msmenu')->where('menuID', $id)->first();
            
            if ($product->menuImage) {
                Storage::disk('public')->delete($product->menuImage);
                DB::table('msmenu')
                    ->where('menuID', $id)
                    ->update(['menuImage' => null]);
            }

            DB::commit();
            return back()->with('success', 'Image deleted successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete image: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::table('msmenu')->where('menuID', $id)->delete();
        
        return redirect()->route('product.index')
                    ->with('success', 'Product deleted successfully');
    }


    public function create()
    {
        $today = now()->format('l, d F Y');
        return view('product-create', ['today' => $today]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menuID' => 'required|string|unique:msmenu,menuID',
            'menuName' => 'required|string|max:255',
            'menuPrice' => 'required|numeric|min:0',
            'menuType' => 'required|string',
            'menuCalorie' => 'nullable|integer',
            'menuImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();

        try {
            $imagePath = null;
            if ($request->hasFile('menuImage') && $request->file('menuImage')->isValid()) {
                $imagePath = $request->file('menuImage')->store('products', 'public');
            }

            DB::table('msmenu')->insert([
                'menuID' => $request->menuID,
                'menuName' => $request->menuName,
                'menuPrice' => $request->menuPrice,
                'menuType' => $request->menuType,
                'menuCalorie' => $request->menuCalorie,
                'menuImage' => $imagePath // Simpan path gambar
            ]);

            DB::commit();

            return redirect()->route('product.index')
                        ->with('success', 'Product added successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Hapus gambar yang sudah diupload jika terjadi error
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()->with('error', 'Failed to create product: '.$e->getMessage());
        }
    }
}
