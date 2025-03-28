<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'id',
        'userId',
        'carId',
        'orderId',
        'carName',
        'carDescription',
        'carImage',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class, 'carId');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderId');
    }
}
