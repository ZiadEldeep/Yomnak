<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'id',
        'userId',
        'orderId',
        'rating',
        'comment',
        'isApproved',
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
