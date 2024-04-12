<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable =[
        'post_id',
        'user_id',
        'body',
    ];


    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): belongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
