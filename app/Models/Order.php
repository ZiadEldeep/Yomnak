<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTable extends Model
{
    use HasFactory;

    protected $table = 'order_table';

    protected $fillable = [
        'id',
        'partitionId',
        'type',
        'elementId',
        'elementName',
        'elementDescription',
        'priceSizes',
        'quantity',
        'paymentId',
        'imageUrl',
        'buyerName',
        'status',
        'createdAt',
        'userId',
        'promoCodeId',
        'size',
        'salad',
        'additions',
        'additionPrice',
        'carId',
        'customerId',
        'pushToken',
    ];

    public $timestamps = false;

    protected $casts = [
        'priceSizes' => 'array',
        'additions' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'userId');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'carId');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerId');
    }
}
