<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Element extends Model
{
    use HasFactory;

    protected $table = 'elements';

    protected $fillable = [
        'id',
        'partitionId',
        'elementName',
        'elementDescription',
        'priceSizeOptions',
        'imageUrl',
        'userId',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function partition(): BelongsTo
    {
        return $this->belongsTo(MenuPartition::class, 'partitionId');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
