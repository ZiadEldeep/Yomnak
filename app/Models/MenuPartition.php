<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuPartition extends Model
{
    use HasFactory;

    protected $table = 'menu_partitions';

    protected $fillable = [
        'id',
        'partitionName',
        'partitionDescription',
        'menuId',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'menuId');
    }
}
