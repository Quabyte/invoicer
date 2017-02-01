<?php

namespace App;

use App\Role;
use App\Permission;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the roles for the given user.
     */
    public function role()
    {
        return $this->belongsTo('App/Role');
    }

    public static function checkPermission()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            return true;
        } elseif ($user->role_id == 2) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkRoot()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkEuroleague()
    {
        $user = Auth::user();

        if ($user->role_id == 1) {
            return true;
        } elseif ($user->role_id == 3) {
            return true;
        } else {
            return false;
        }
    }
}
