<?php

namespace App;

use Carbon\Carbon;
use App\BookingItem;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
    	'booking_id',
    	'time'
    ];

    protected $table = 'bookings';

    public static function saveNewBookings($jsonObject)
    {
    	$json = json_decode($jsonObject, true);

    	for ($i=0; $i <= sizeof($json['bookings']) - 1 ; $i++) { 
    		$booking = new Booking;
    		$booking->booking_id = $json['bookings'][$i]['id'];
    		$booking->time = Carbon::parse($json['bookings'][$i]['datetime']);
    		$booking->save();
    	}
    }

    public static function getItemNames($bookingID)
    {
        $items = BookingItem::where('bookind_id', '=', $bookingID)->get();

        return $items;
    }
}
