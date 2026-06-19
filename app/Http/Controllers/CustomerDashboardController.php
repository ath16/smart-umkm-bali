<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    /**
     * Show the customer dashboard.
     */
    public function index(): View
    {
        return view('customer.dashboard');
    }
}
