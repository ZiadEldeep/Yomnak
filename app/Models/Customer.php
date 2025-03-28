<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'id',
        'name',
        'phone',
        'address',
        'carId',
    ];

    public $timestamps = false;

    public function car()
    {
        return $this->belongsTo(Car::class, 'carId');
    }

    public function orders()
    {
        return $this->hasMany(OrderTable::class, 'customerId');
    }
}
