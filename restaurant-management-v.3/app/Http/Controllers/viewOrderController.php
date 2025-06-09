<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class viewOrderController extends Controller
{
    public function dashboard(){
    $totalRevenue = Order::sum('price');
    $lastMonthRevenue = Order::whereMonth('created_at', now()->subMonth()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->sum('price');

    $revenuePercentage = $lastMonthRevenue > 0 
        ? (($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100
        : 0;


    // $totalProfit = Order::sum('price');


    $totalOrder = Order::count('id');
    $lasMonthOrder = Order::whereMonth('created_at', now()->subMonth()->month)
                                    ->whereYear('created_at', now()->year)
                                    ->count('id');
    $orderPercentage = $lasMonthOrder > 0 
        ? (($totalOrder - $lasMonthOrder) / $lasMonthOrder) * 100
        : 0;

        
    return view('dashboard', [
        'totalRevenue' => $totalRevenue,
        'revenuePercentage' => $revenuePercentage,
        // 'totalProfit' => $totalProfit,
        'totalOrder' => $totalOrder,
        'orderPercentage' => $orderPercentage
    ]);
}
}