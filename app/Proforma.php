<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    protected $fillable = [
    	'booking_id',
    	'generatedBy',
    	'total',
    	'canceled'
    ];

    protected $table = 'proformas';

    public static function checkIfGenerated($bookigRef)
    {
    	$proformaCount = Proforma::where('booking_id', '=', $bookigRef)->count();

    	if ($proformaCount > 0) {
    		return false;
    	}

    	return true;
    }
}
