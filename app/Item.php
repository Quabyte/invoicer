<?php

namespace App;

use App\Item;
use Carbon\Carbon;
use App\Utilities\Util;
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
        $json = Util::decodeJson($jsonObject);

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
        $items = Item::where('transaction_id', '=', $transactionID)->get();

        $fee = 0.0;

        foreach ($items as $item) {
            $fee = $fee + $item->card_fee;
        }

        return $fee;
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

    public static function getAreaCount($transactionID)
    {
        $areas = Item::where('transaction_id', '=', $transactionID)->get(['area']);
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
