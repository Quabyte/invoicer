<?php

namespace App\Http\Controllers;

use App\User;
use App\Booking;
use App\Customer;
use App\Proforma;
use Carbon\Carbon;
use App\BookingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proformas = Proforma::all();
        $bookings = Booking::all();
        return view('dashboard.proforma.all', compact('proformas', 'bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.proforma.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proforma = new Proforma;
        $proforma->booking_id = $request->bookingID;
        $proforma->generatedBy = Auth::id();
        $proforma->total = $request->bookingTotal;
        $proforma->canceled = false;
        $proforma->item_name = ' ';
        $proforma->item_count = 0;

        $tickets = BookingItem::getAreaCount($proforma->booking_id);

        $proforma->category_names = implode('.', array_keys($tickets));
        $proforma->ticket_counts = implode('.', array_values($tickets));

        $existingCount = Proforma::where('booking_id', '=', $request->bookingID)->count();

        $proforma->generate_count = $existingCount + 1;
        $proforma->vat = $request->vat;
        $proforma->tax = $request->tax;
        $proforma->net_price = $request->netPrice;
        $proforma->customer_id = $request->customerID;
        $proforma->created_at = $request->proformaDate;
        $proforma->updated_at = Carbon::now('Europe/Istanbul');
        $proforma->save();

        return redirect()->action('ProformaController@generateProforma', ['id' => $proforma->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::findOrFail($id);
        $tickets = BookingItem::getAreaCount($booking->booking_id);
        $items = BookingItem::where('booking_id', '=', $booking->booking_id)->get();
        $assignee = Customer::where('id', '=', $booking->customer_id)->get();
        $timeNow = Carbon::now('Europe/Istanbul');
        $total = BookingItem::calculateTotal($booking->booking_id);
        $proforma = Proforma::where('booking_id', '=', $booking->booking_id)->first();

        return view('dashboard.proforma.detail', compact('booking', 'items', 'assignee', 'timeNow', 'tickets', 'total', 'proforma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proforma = Proforma::findOrFail($id);
        $user = User::findOrFail($proforma->generatedBy);

        return view('dashboard.proforma.edit', compact('proforma', 'user'));
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
        $proforma = Proforma::findOrFail($id);
        $proforma->total = $request->total;
        $proforma->created_at = $request->createdAt;
        $proforma->updated_at = Carbon::now('Europe/Istanbul');
        $proforma->vat = $request->vat;
        $proforma->tax = $request->tax;
        $proforma->net_price = $request->net;
        $proforma->generate_count = $proforma->generate_count + 1;
        $proforma->save();

        return redirect()->action('ProformaController@generateProforma', ['id' => $proforma->id]);
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

    /**
     * Generates the proforma and shows the PDF version
     * 
     * @param  integer $id Proforma ID
     * @return response
     */
    public function generateProforma($id)
    {
        $proforma = Proforma::findOrFail($id);
        $customer = Customer::where('id', '=', $proforma->customer_id)->first();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dashboard.proforma.pdf', compact('proforma', 'customer'));
        return $pdf->stream();
    }

    public function generatedList()
    {
        $proformas = Proforma::all();

        return view('dashboard.proforma.generatedAll', compact('proformas'));
    }
}
