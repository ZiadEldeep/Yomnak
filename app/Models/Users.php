<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


class Users extends Authenticatable
{
    use HasFactory,HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'password',
        'verificationCode',
        'locationId',
        'code',
        'pushToken',
    ];

    protected $hidden = [
        'password',
        'verificationCode',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class, 'ownerId');
    }

    public function orders()
    {
        return $this->hasMany(OrderTable::class, 'userId');
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'userId');
    }
}
