<?php

namespace App\Http\Controllers;

use App\Item;
use App\Sales;
use App\Customer;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = Sales::findOrFail($id);

        $fee = Item::calculateFees($transaction->transaction_id);

        $netPrice = Item::calculateNetPrice($transaction->transaction_id);

        $total = Item::calculateTotal($transaction->transaction_id);

        $customer = Customer::getCustomer($transaction->customer_id);

        return view('dashboard.sales.single', compact('transaction', 'fee', 'netPrice', 'total', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function removeDuplicates($id)
    {
        $sale = Sales::find($id);

        $items = Item::where('transaction_id', '=', $sale->transaction_id)->get();

        $itemCount = $items->count();
        $itemCount = $itemCount / 2;

        $deleted = Item::orderBy('id', 'desc')->take($itemCount)->get();

        foreach ($deleted as $remove) {
            Item::destroy($remove->id);
        }

        return redirect()->back();
    }

    public function getIndividualSale(Request $request)
    {
        app('App\Http\Controllers\RequestController')->singleSale($request->transactionID);

        return redirect()->back();
    }

    public function getIndividualBooking(Request $request)
    {
        app('App\Http\Controllers\RequestController')->getSingleBooking($request->bookingRef);

        return redirect()->back();
    }
}
