<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MsStaff;
use App\Models\StaffPosition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = DB::table('msstaff')
            ->join('staffPosition', 'msstaff.staffPositionID', '=', 'staffPosition.staffPositionID')
            ->select(
                'msstaff.staffID',
                'msstaff.staffName',
                'msstaff.staffEmail',
                'staffPosition.staffPosition',
                'staffPosition.staffPositionID'
            )
            ->paginate(10);

        $today = now()->format('l, d F Y');

        return view('staff', [
            'staffs' => $staffs,
            'today' => $today
        ]);
    }

    public function create()
    {
        // Ambil daftar position dari database
         $positions = DB::table('staffposition') // Perhatikan huruf kecil
                     ->select('staffPositionID', 'staffPosition')
                     ->get();

        return view('staff-create', compact('positions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'staffName' => 'required|string|max:255',
            'staffEmail' => 'required|email|unique:msStaff,staffEmail',
            'staffPositionID' => 'required|string|exists:staffPosition,staffPositionID', // Ganti staffPosition menjadi positionID
            'staffAddress' => 'nullable|string',
            'password' => 'required|confirmed|min:6'
        ]);

        // Generate staffID
        $lastStaff = DB::table('msstaff')->orderBy('staffID', 'desc')->first();
        $lastId = $lastStaff ? intval(substr($lastStaff->staffID, 2)) : 0;
        $newId = 'ST' . str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);

        // Dapatkan nama position
        $position = DB::table('staffposition')
                ->where('staffPositionID', $validated['staffPositionID'])
                ->first();

        DB::table('msstaff')->insert([
            'staffID' => $newId,
            'staffName' => $validated['staffName'],
            'staffEmail' => $validated['staffEmail'],
            'staffPositionID' => $validated['staffPositionID'], // Simpan positionID
            'staffAddress' => $validated['staffAddress'] ?? null,
            'staffPhone' => $request->input('staffPhone', ''),
            'staffJoinDate' => $request->input('joinDate', date('Y-m-d')),
            'isActive' => $request->input('isActive', 1),
            'created_at' => now(),
            'updated_at' => now(),
            'staffPassword' => Hash::make($request->password)
        ]);

        return redirect()->route('staff.index')->with('success', 'Staff added successfully!');
    }

    public function destroy($id)
    {
        DB::table('msstaff')->where('staffID', $id)->delete();

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully!');
    }
}
