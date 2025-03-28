<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCodeTable extends Model
{
    use HasFactory;

    protected $table = 'promo_code_table';

    protected $fillable = [
        'id',
        'partitionId',
        'code',
        'discount',
        'createdAt',
        'count',
        'endDate',
    ];

    public $timestamps = false;

    protected $casts = [
        'endDate' => 'datetime',
    ];
}
