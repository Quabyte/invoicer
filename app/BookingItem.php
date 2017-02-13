<?php

namespace App;

use App\Utilities\Util;
use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{   
    /**
     * Mass assignable fields
     * 
     * @var array
     */
    protected $fillable = [
    	'booking_id',
    	'area',
    	'zone',
    	'seat',
    	'total'
    ];

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'bookingItems';

    /**
     * Saves the booking items
     * 
     * @param  json $jsonObject 
     * @return void             
     */
    public static function saveItems($jsonObject)
    {
        $json = Util::decodeJson($jsonObject);

    	for ($i=0; $i <= sizeof($json['bookings']) - 1; $i++) { 
    		for ($j=0; $j <= sizeof($json['bookings'][$i]['items']) - 1 ; $j++) { 
    			$item = new BookingItem;
    			$item->booking_id = $json['bookings'][$i]['id'];
    			$item->area = $json['bookings'][$i]['items'][$j]['area'];
    			$item->zone = $json['bookings'][$i]['items'][$j]['zone'];
    			$item->seat = $json['bookings'][$i]['items'][$j]['seat'];
                $total = str_replace(',', '', $json['bookings'][$i]['items'][$j]['amount']['total']);
    			$item->total = $total;
                $item->status = $json['bookings'][$i]['items'][$j]['transaction_type'];
    			$item->save();
    		}
    	}
    }

    public static function saveItemsForOneBooking($jsonObject, $bookingRef)
    {
        $json = Util::decodeJson($jsonObject);
        dd($json['bookings'][0]['items'][0]['seat']);
        for ($i=0; $i <= sizeof($json['bookings']) - 1; $i++) {
            if (is_array($json['bookings'][$i]['items'])) {
                for ($j=0; $j <= sizeof($json['bookings'][$i]['items']) - 1 ; $j++) {
                    if (!static::seatExists($json['bookings'][$i]['items'][$j]['seat'])) {
                        $item = new BookingItem;
                        $item->booking_id = $bookingRef;
                        $item->area = $json['bookings'][$i]['items'][$j]['area'];
                        $item->zone = $json['bookings'][$i]['items'][$j]['zone'];
                        $item->seat = $json['bookings'][$i]['items'][$j]['seat'];
                        $total = str_replace(',', '', $json['bookings'][$i]['items'][$j]['amount']['total']);
                        $item->total = $total;
                        $item->status = $json['bookings'][$i]['items'][$j]['transaction_type'];
                        $item->save();
                    }
                }
            } else {
                return true;
            }
        }
    }

    protected function seatExists($seat)
    {
        $bookingItems = BookingItem::where('seat', '=', $seat)->get();

        if (count($bookingItems)) {
            return false;
        }

        return true;
    }

    /**
     * Calculates the booking total amount
     * 
     * @param  string $bookingRef
     * @return integer             
     */
    public static function calculateTotal($bookingRef)
    {
        $items = BookingItem::where('booking_id', '=', $bookingRef)->get();

        $total = 0.0;
        foreach ($items as $item) {
            $total = $total + $item->total;
        }

        return $total;
    }

    public static function getAreaCount($bookingRef)
    {
        $areas = BookingItem::where('booking_id', '=', $bookingRef)->get(['area']);
        $list = [];
        $count = [
            "Courtside Row-1" => 0,
            "Courtside Row-2" => 0,
            "Courtside Row-3" => 0,
            "Gold Suites" => 0,
            "Silver Suites" => 0,
            "Bronze Suites" => 0,
            "Gold Hospitality" => 0,
            "PL1" => 0,
            "PL2" => 0,
            "PL3" => 0,
            "PL4" => 0,
            "PL5" => 0,
            "PL6" => 0,
            "PL7" => 0,
            "PL7 Low Visibility" => 0,
            "PL8" => 0,
            "PL9" => 0,
            "PL10" => 0,
            "PL10-Low-Visibility" => 0
        ];

        foreach ($areas as $area) {
            switch ($area->area) {
                case 'Courtside Row-1':
                    $count['Courtside Row-1'] = $count['Courtside Row-1'] + 1;
                    break;
                case 'Courtside Row-2':
                    $count['Courtside Row-2'] = $count['Courtside Row-2'] + 1;
                    break;
                case 'Courtside Row-3':
                    $count['Courtside Row-3'] = $count['Courtside Row-3'] + 1;
                    break;
                case 'Gold Suites':
                    $count['Gold Suites'] = $count['Gold Suites'] + 1;
                    break;
                case 'Silver Suites':
                    $count['Silver Suites'] = $count['Silver Suites'] + 1;
                    break;
                case 'Bronze Suites':
                    $count['Bronze Suites'] = $count['Bronze Suites'] + 1;
                    break;
                case 'Gold Hospitality':
                    $count['Gold Hospitality'] = $count['Gold Hospitality'] + 1;
                    break;
                case 'PL1':
                    $count['PL1'] = $count['PL1'] + 1;
                    break;
                case 'PL2':
                    $count['PL2'] = $count['PL2'] + 1;
                    break;
                case 'PL3':
                    $count['PL3'] = $count['PL3'] + 1;
                    break;
                case 'PL4':
                    $count['PL4'] = $count['PL4'] + 1;
                    break;
                case 'PL5':
                    $count['PL5'] = $count['PL5'] + 1;
                    break;
                case 'PL6':
                    $count['PL6'] = $count['PL6'] + 1;
                    break;
                case 'PL7':
                    $count['PL7'] = $count['PL7'] + 1;
                    break;
                case 'PL7 Low Visibility':
                    $count['PL7 Low Visibility'] = $count['PL7 Low Visibility'] + 1;
                    break;
                case 'PL8':
                    $count['PL8'] = $count['PL8'] + 1;
                    break;
                case 'PL9':
                    $count['PL9'] = $count['PL9'] + 1;
                    break;
                case 'PL10':
                    $count['PL10'] = $count['PL10'] + 1;
                    break;
                case 'PL10-Low-Visibility':
                    $count['PL10-Low-Visibility'] = $count['PL10-Low-Visibility'] + 1;
                    break;
            }
        }

        foreach ($count as $item => $value) {
            if ($value > 0) {
                $list[$item] = $value / 2;
            }
        }

        return $list;
    }
}