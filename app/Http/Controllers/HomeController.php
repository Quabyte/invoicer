<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Customer;
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
        Bugsnag::notifyError('ErrorType', 'Test Error');
        return view('home', compact('sales'));
    }
}
