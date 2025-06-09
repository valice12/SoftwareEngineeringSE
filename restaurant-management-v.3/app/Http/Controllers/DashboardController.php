<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\MsMenu;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $today = now()->format('l, d F Y');

        // Current Month Revenue
        $currentMonthRevenue = TransactionDetail::whereMonth('transactiondate', now()->month)
        ->whereYear('transactiondate', now()->year)
        ->join('msmenu', 'transactiondetail.menuID', '=', 'msmenu.menuID')
        ->sum(DB::raw('transactiondetail.quantity * msmenu.menuPrice'));
        
        // Current Month Profit
        $currentMonthProfit = TransactionDetail::whereMonth('transactiondate', now()->month)
        ->whereYear('transactiondate', now()->year)
        ->join('msmenu', 'transactiondetail.menuID', '=', 'msmenu.menuID')
        ->sum(DB::raw('transactiondetail.quantity * (msmenu.menuPrice * 0.6)'));
        
        // Current Month Orders
        $currentMonthOrder = TransactionDetail::whereMonth('transactiondate', now()->month)
        ->whereYear('transactiondate', now()->year)
        ->count();
        
        // Top Products
        $topProducts = TransactionDetail::select('msmenu.menuID', 'msmenu.menuname', DB::raw('SUM(transactiondetail.quantity) as total_sold'))
        ->join('msmenu', 'transactiondetail.menuID', '=', 'msmenu.menuID')
        ->whereMonth('transactiondetail.transactiondate', now()->month)
        ->whereYear('transactiondetail.transactiondate', now()->year)
        ->groupBy('msmenu.menuID', 'msmenu.menuname')
        ->orderByDesc('total_sold')
        ->limit(3)
        ->get();

        $topFiveMenus = DB::table('msmenu')
        ->select('menuID', 'menuName', 'menuPrice', 'menuType', 'menuImage')
        ->take(5)
        ->get()
        ->map(function ($product) {
            $product->imageUrl = $product->menuImage
                ? asset('storage/' . $product->menuImage)
                : asset('images/default-product.png');
            return $product;
        });
        
        // Weekly Sales
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weeklySales = TransactionDetail::select(
            DB::raw('DATE(transactiondate) as date'),
            DB::raw('SUM(transactiondetail.quantity * msmenu.menuPrice) as total')
            )
            ->join('msmenu', 'transactiondetail.menuID', '=', 'msmenu.menuID')
            ->whereBetween('transactiondate', [$startOfWeek, $endOfWeek])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
            // Format weekly sales data
            $weeklySalesData = [];
            $currentDay = $startOfWeek->copy();
            while ($currentDay <= $endOfWeek) {
                $dateString = $currentDay->format('Y-m-d');
                $sale = $weeklySales->firstWhere('date', $dateString);
                $weeklySalesData[] = $sale ? $sale->total : 0;
                $currentDay->addDay();
            }
            
        $staffs = DB::table('msstaff')
        ->join('staffPosition', 'msstaff.staffPositionID', '=', 'staffPosition.staffPositionID')
        ->select(
            'msstaff.staffID',
            'msstaff.staffName',
            'msstaff.staffEmail',
            'staffPosition.staffPosition',
            'staffPosition.staffPositionID'
        )->paginate(10);

        return view('dashboard', compact(
            'currentMonthRevenue',
            'currentMonthProfit',
            'currentMonthOrder',
            'topProducts',
            'weeklySalesData',
            'startOfWeek',
            'endOfWeek',
            'staffs', 
            'today',
            'topFiveMenus'
        ));
    }
}