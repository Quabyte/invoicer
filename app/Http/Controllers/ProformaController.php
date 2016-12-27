<?php

namespace App\Http\Controllers;

use App\Booking;
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
        $proforma->customer_name = $request->customerName;
        $proforma->customer_address = $request->customerAddress;
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
        $items = BookingItem::where('booking_id', '=', $booking->booking_id)->get();
        $timeNow = Carbon::now('Europe/Istanbul');
        $total = BookingItem::calculateTotal($booking->booking_id);

        return view('dashboard.proforma.detail', compact('booking', 'items', 'timeNow', 'total'));
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

    public function generateProforma($id)
    {
        $proforma = Proforma::findOrFail($id);
        $items = Booking::getItemNames($proforma->booking_id);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('dashboard.proforma.pdf', compact('proforma', 'items'));
        return $pdf->stream();
    }
}
