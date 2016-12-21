<?php

namespace App;

use App\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{   
    /**
     * Mass assignable fields
     * 
     * @var array
     */
    protected $fillable = [
    	'id',
    	'transaction_id',
    	'time',
    	'customer_name',
    	'customer_surname',
    	'payment_method',
    	'channel',
    	'is_cancelled',
    	'total'
    ];

    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'sales';

    /**
     * Overwrite default primary key
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Returns the related customer
     * 
     * @return object
     */
    public function customer()
    {
        return $this->belongsTo('App/Customer');
    }

    /**
     * Returns the related items
     * 
     * @return collection
     */
    public function items()
    {
        return $this->hasMany('App/Item');
    }

    /**
     * Saves the sales into database from JSON response
     * 
     * @param $jsonObject JSON response from the server
     */
    public static function saveNewSales($jsonObject)
    {
    	$json = json_decode($jsonObject, true);

        for ($i = 0; $i <= sizeof($json['sales']) - 1; $i++) {
            $sale = new Sales;
            $sale->customer_id = $json['sales'][$i]['customer']['id'];
            $sale->transaction_id = $json['sales'][$i]['id'];
            $sale->time = Carbon::parse($json['sales'][$i]['datetime']);
            $sale->payment_method = $json['sales'][$i]['method_of_payment'];
            $sale->channel = $json['sales'][$i]['channel'];
            $sale->is_cancelled = $json['sales'][$i]['items'][0]['canceled'];
            $sale->transaction_type = $json['sales'][$i]['items'][0]['transaction_type'];
            $sale->created_at = Carbon::now('Europe/Istanbul');
            $sale->updated_at = Carbon::now('Europe/Istanbul');
            $sale->save();
        }
    }

    public static function getItemNames($transactionID)
    {
        $items = Item::where('transaction_id', '=', $transactionID)->get();

        return $items;
    }
}