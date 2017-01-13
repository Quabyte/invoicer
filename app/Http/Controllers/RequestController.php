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
    	$newRequest->getSales('2016-12-15T12:00', true);

    	return redirect()->back();
    }

    public function getBookings()
    {
        $newRequest = new KoobinRequest('https://euroleague.acikgise.com', 600);
        $newRequest->getBookings('2016-12-15T12:00');

        return redirect()->back();
    }
}
