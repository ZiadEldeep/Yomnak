<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientRate extends Model
{
    use HasFactory;

    protected $table = 'client_rate';

    protected $fillable = [
        'id',
        'clientId',
        'orderId',
        'rating',
        'comment',
        'createdAt'
    ];

    public function client()
    {
        return $this->belongsTo(Users::class, 'clientId');
    }

    public function order()
    {
        return $this->belongsTo(OrderTable::class, 'orderId');
    }
}
