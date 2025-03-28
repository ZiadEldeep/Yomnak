<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentCard extends Model
{
    use HasFactory;

    protected $table = 'payment_cards';

    protected $fillable = [
        'id',
        'userId',
        'cardHolderName',
        'cardNumber',
        'cardType',
        'expiryMonth',
        'expiryYear',
        'cvv',
        'isDefault',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
