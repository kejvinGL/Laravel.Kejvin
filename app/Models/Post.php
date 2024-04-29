<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function media(): hasOne
    {
        return $this->hasOne(Media::class, 'post_id');
    }

    public function getMedia(): string
    {
        return Storage::url("media/" . $this->media?->path);
    }

    public function scopeSortedPostList(Builder $query)
    {
        return $query->withCount('comments')->with('user.avatar', "comments.user.avatar")->latest();
    }

    public function scopeSortedUserPosts(Builder $query, $id)
    {
        return $query->where('user_id', $id)->with(['comments.user.avatar'])->latest();
    }

    public function scopeRecentPosts(Builder $query)
    {
        return $query->where('created_at', '>=', now()->subDay())->count();
    }
}
