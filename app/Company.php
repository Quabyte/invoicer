<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
    	'name',
    	'logo_path',
    	'address',
    	'telephone',
    	'fax',
    	'tax_administration',
    	'tax_number',
    	'mersis_number',
    	'vat'
    ];
}
