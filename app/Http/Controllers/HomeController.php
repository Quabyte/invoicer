<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::all();

        return view('home', compact('sales'));
    }

    public function deskOrders()
    {
        $desks = Sales::where('channel', '=', 'DESK')->get();

        return view('deskSales', compact('desks'));
    }

    public function generated()
    {
        $invoices = Invoice::all();

        return view('generated', compact('invoices'));
    }
}
