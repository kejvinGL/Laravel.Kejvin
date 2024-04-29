<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable =[
        'user_id',
        'post_id',
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

    public function scopeCurrentAvatar(Builder $query)
    {
        return $query->where(['user_id' => auth()->id(), 'type'=> 'avatar'])->first();
    }


}
