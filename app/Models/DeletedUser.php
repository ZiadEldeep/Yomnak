<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeletedUser extends Model
{
    use HasFactory;

    protected $table = 'deleted_users';

    protected $fillable = [
        'id',
        'userId',
        'email',
        'name',
        'reason',
        'deletedAt',
    ];

    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
