<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract {
    use Authenticatable, Authorizable, SoftDeletes;

    public function assets() {
        return $this->hasMany('App\Models\Asset');
    }

    protected $fillable = [
        'name', 'email',
    ];

    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at'];
}
