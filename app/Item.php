<?php

namespace App;

use App\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{   
    /**
     * Mass assignable fields
     * 
     * @var array
     */
    protected $fillable = [
    	'transaction_id',
    	'package',
    	'area',
    	'zone',
    	'seat',
    	'net_price',
    	'card_fee',
    	'total'
    ];

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'items';

    /**
     * Returns the related sale
     * 
     * @return object
     */
    public function sale()
    {
    	return $this->belongsTo('App/Sales');
    }

    /**
     * Saves the sales items into database
     * 
     * @param  $jsonObject JSON response from the server
     */
    public static function saveItems($jsonObject)
    {
        $json = json_decode($jsonObject, true);

        for ($i=0; $i <= sizeof($json['sales']) - 1; $i++) { 
            for ($j=0; $j <= sizeof($json['sales'][$i]['items']) - 1; $j++) { 
                $item = new Item;
                $item->transaction_id = $json['sales'][$i]['id'];
                $item->package = $json['sales'][$i]['items'][$j]['package'];
                $item->area = $json['sales'][$i]['items'][$j]['area'];
                $item->zone = $json['sales'][$i]['items'][$j]['zone'];
                $item->seat = $json['sales'][$i]['items'][$j]['seat'];
                $item->net_price = $json['sales'][$i]['items'][$j]['amount']['price'];
                $item->card_fee = $json['sales'][$i]['items'][$j]['amount']['fee'];
                $item->total = $json['sales'][$i]['items'][$j]['amount']['total'];
                $item->created_at = Carbon::now('Europe/Istanbul');
                $item->updated_at = Carbon::now('Europe/Istanbul');
                $item->save();
            }
        }
    }

    public static function calculateFees($transactionID)
    {
        $items = Sales::with('items')->find($transactionID)->items;

        $fee = 0;
        foreach ($items as $item) {
            $fee = $fee + $item->card_fee;
        }

        return $fee;
        // $items = Item::where('transaction_id', '=', $transactionID)->get();

        // $fee = 0.0;
        // foreach ($items as $item) {
        //     $fee = $fee + $item->card_fee;
        // }

        // return $fee;
    }

    public static function calculateNetPrice($transactionID)
    {
        $items = Item::where('transaction_id', '=', $transactionID)->get();

        $netPrice = 0;

        foreach ($items as $item) {
            $netPrice = $netPrice + $item->net_price;
        }

        return $netPrice;
    }

    public static function calculateTax($total)
    {
        $taxFree = $total / 1.18;
        $tax = $total - $taxFree;

        return $tax;
    }

    public static function calculateTotal($transactionID)
    {
        $items = Item::where('transaction_id', '=', $transactionID)->get();

        $total = 0.0;
        foreach ($items as $item) {
            $total = $total + $item->total;
        }

        return $total;
    }
}
