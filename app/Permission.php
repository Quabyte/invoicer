<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
    	'name',
    	'role_id',
    ];

    /**
     * Get the role for the given permission
     */
    public function role()
    {
    	return $this->belongsTo('App/Role');
    }
}
