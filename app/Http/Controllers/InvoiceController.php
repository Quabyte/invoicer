<?php

namespace App\Http\Controllers;

use App\Item;
use App\Sales;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class InvoiceController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.invoice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fee = Item::calculateFees($request->transaction_id);
        $netPrice = Item::calculateNetPrice($request->transaction_id);
        $total = Item::calculateTotal($request->transaction_id);

        $invoice = new Invoice;
        $invoice->transaction_id = $request->transaction_id;
        $invoice->customer_name = $request->customerName;
        $invoice->address = $request->customerAddress;
        $invoice->zip_code = $request->customerZIP;
        $invoice->province = $request->customerProvince;
        $invoice->country = $request->customerCountry;
        $invoice->package = '2017 Turkish Airlines EuroLeague Final Four Istanbul';
        $invoice->net_price = $netPrice;
        $invoice->tax = Item::calculateTax($total);
        $invoice->fee = $fee;
        $invoice->total = $total;
        $invoice->price_text = $request->priceText;
        $invoice->generated = $request->invoiceDate;
        $invoice->canceled = false;
        $invoice->save();

        return redirect()->action('InvoiceController@show', ['id' => $invoice->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('dashboard.invoice.single', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    public function preview($id)
    {   
        $invoice = Invoice::findOrFail($id);
        $items = Sales::getItemNames($invoice->transaction_id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dashboard.invoice.pdf', compact('invoice', 'items'));
        return $pdf->stream();
    }
}
