<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'car';

    protected $fillable = [
        'id',
        'name',
        'description',
        'ownerName',
        'email',
        'phone',
        'address',
        'imagePaths',
        'documentPaths',
        'ownerId',
    ];

    public function owner()
    {
        return $this->belongsTo(Users::class, 'ownerId');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'carId');
    }

    public function orders()
    {
        return $this->hasMany(OrderTable::class, 'carId');
    }
}
