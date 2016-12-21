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
}
