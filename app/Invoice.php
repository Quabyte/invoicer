<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
    	'transaction_id',
    	'customer_name',
    	'address',
    	'zip_code',
    	'province',
    	'country',
    	'package',
    	'net_price',
    	'tax',
    	'fee',
    	'total',
    	'price_text',
    	'canceled',
    	'generated',
    ];

    protected $table = 'invoices';

    public static function convertToTL($amount, $rate)
    {
        return round($amount * $rate, 2);
    }

    public static function checkGenerated($transactionID)
    {
        $invoice = Invoice::where('transaction_id', '=', $transactionID)->first();

        if ($invoice) {
            return true;
        }

        return false;
    }
}
