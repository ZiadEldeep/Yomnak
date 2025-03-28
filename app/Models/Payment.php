<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'id',
        'userId',
        'orderId',
        'paymentMethod',
        'amount',
        'currency',
        'status',
        'transactionId',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'orderId');
    }
}
