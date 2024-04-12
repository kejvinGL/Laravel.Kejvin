<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'path',
        'hash_name',
        'original_name',
        'ext',
        'size',
        'type',
    ];


    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
