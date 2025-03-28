<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeline extends Model
{
    use HasFactory;

    protected $table = 'timelines';

    protected $fillable = [
        'id',
        'userId',
        'startDay',
        'endDay',
        'timelineType',
        'schedule',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected $casts = [
        'schedule' => 'array', // تحويل الـ JSON تلقائياً إلى Array عند استرجاع البيانات
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
