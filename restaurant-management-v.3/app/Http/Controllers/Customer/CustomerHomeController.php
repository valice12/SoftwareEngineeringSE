<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class CustomerHomeController extends Controller
{
    public function index()
    {
        return view('customer.home');
    }
}