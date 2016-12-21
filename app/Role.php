<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
    	'name',
    	'display_name',
    	'description'
    ];

    /**
     * Get the user for the given role
     */
    public function users()
    {
    	return $this->hasMany('App/User');
    }

    /**
     * Get the permissions for the given role
     */
    public function permissions()
    {
    	return $this->hasMany('App/Permission');
    }
}
