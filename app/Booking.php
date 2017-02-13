<?php

namespace App;

use App\Request;
use Carbon\Carbon;
use App\BookingItem;
use App\Utilities\Util;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    /**
     * Mass assignable fields
     * 
     * @var array
     */
    protected $fillable = [
    	'booking_id',
    	'time',
        'customer_id'
    ];

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'bookings';

    /**
     * Saves new Bookings into database
     * 
     * @param  json $jsonObject 
     * @return void
     */
    public static function saveNewBookings($jsonObject)
    {
        
        $json = Util::decodeJson($jsonObject);

    	for ($i=0; $i <= sizeof($json['bookings']) - 1 ; $i++) { 
    		$booking = new Booking;
    		$booking->booking_id = $json['bookings'][$i]['id'];
    		$booking->time = Carbon::parse($json['bookings'][$i]['datetime']);

            if (isset($json['bookings'][$i]['customer']['id'])) {
                $booking->customer_id = $json['bookings'][$i]['customer']['id'];
            } else {
                $booking->customer_id = null;
            }

            if (is_array(($json['bookings'][$i]['customer']))) {
                $request = new Request('https://euroleague.acikgise.com', 600);
                $request->getSingleCustomer($booking->customer_id);
            }

    		$booking->save();
    	}
    }

    public static function updateBooking($jsonObject, $bookingRef)
    {
        $json = Util::decodeJson($jsonObject);

        dd($json);

        for ($i=0; $i <= sizeof($json['bookings']) - 1 ; $i++) {
            $booking = Booking::where('booking_id', '=', $bookingRef)->first();
            $booking->customer_id = $json['bookings'][$i]['customer']['id'];
            $booking->time = Carbon::parse($json['bookings'][$i]['datetime']);
            $booking->save();
        }
    }

    /**
     * Returns the booking item names
     * 
     * @param  string $bookingID
     * @return collection
     */
    public static function getItemNames($bookingID)
    {
        $items = BookingItem::where('booking_id', '=', $bookingID)->get();

        return $items;
    }
}
