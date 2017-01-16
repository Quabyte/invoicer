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
    	$newRequest->getSales('2017-01-16T17:25', true);

    	return redirect()->back();
    }

    public function getBookings()
    {
        $newRequest = new KoobinRequest('https://euroleague.acikgise.com', 600);
        $newRequest->getBookings('2016-12-27T14:34');

        return redirect()->back();
    }

    public function getCustomer()
    {
        $customerRequest = new KoobinRequest('https://euroleague.acikgise.com', 600);
        $customerRequest->getCustomers('2016-12-14T17:12', '2017-01-16T14:15');

        return redirect()->back();
    }
}
