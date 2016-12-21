<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    protected $fillable = [
    	'booking_id',
    	'area',
    	'zone',
    	'seat',
    	'total'
    ];

    protected $table = 'bookingItems';

    public static function saveItems($jsonObject)
    {
    	$json = json_decode($jsonObject, true);

    	for ($i=0; $i <= sizeof($json['bookings']) - 1; $i++) { 
    		for ($j=0; $j <= sizeof($json['bookings'][$i]['items']) - 1 ; $j++) { 
    			$item = new BookingItem;
    			$item->booking_id = $json['bookings'][$i]['id'];
    			$item->area = $json['bookings'][$i]['items'][$j]['area'];
    			$item->zone = $json['bookings'][$i]['items'][$j]['zone'];
    			$item->seat = $json['bookings'][$i]['items'][$j]['seat'];
    			$item->total = $json['bookings'][$i]['items'][$j]['amount']['total'];
    			$item->save();
    		}
    	}
    }

    public static function calculateTotal($bookingRef)
    {
        $items = BookingItem::where('booking_id', '=', $bookingRef)->get();

        $total = 0.0;
        foreach ($items as $item) {
            $total = $total + $item->total;
        }

        return $total;
    }
}
