<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class HistoryController extends Controller
{
    public function index(){
        $today = now()->format('l, d F Y');
        $orders = Order::all();
        return view('orders', compact('orders', 'today'));
    }

    public function destroy($orderId)
    {
        $order = Order::find($orderId);

        if (!$order) {
            return redirect()->route('history.index')->with('error', 'Order not found');
        }

        $order->delete();

        return redirect()->route('history.index')->with('success', 'Order deleted successfully');
    }
}