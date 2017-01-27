<?php

namespace App\Http\Controllers;

use App\Request as KoobinRequest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
    	return view('home');
    }

    public function makeRequest()
    {	
    	$newRequest = new KoobinRequest('https://euroleague.acikgise.com', 600);
    	$newRequest->getSales();

    	return redirect()->back();
    }

    public function getBookings()
    {
        $newRequest = new KoobinRequest('https://euroleague.acikgise.com', 600);
        $newRequest->getBookings();

        return redirect()->back();
    }

    public function getCustomer()
    {
        $customerRequest = new KoobinRequest('https://euroleague.acikgise.com', 600);
        $customerRequest->getCustomers();

        return redirect()->back();
    }

    public function singleCustomer($customerID)
    {
        $request = new KoobinRequest('https://euroleague.acikgise.com', 600);
        $request->updateCustomer($customerID);

        return redirect()->back();
    }
}
