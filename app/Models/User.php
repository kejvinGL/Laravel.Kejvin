<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'username',
        'name',
        'email',
        'password',
        'darkmode',
        'lang',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }

    public function media(): hasMany
    {
        return $this->hasMany(Media::class);
    }

    public function avatar(): hasOne
    {
        return $this->hasOne(Media::class)->where('type', 'avatar');
    }


    public function role(): belongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class);
    }


    public function getAvatar(): string
    {
        return $this->avatar?->path ?
            Storage::url("media/" . $this->avatar?->path)
            : Storage::url("media/default/default.svg");
    }

    public function getRole()
    {
        return $this->role->id;
    }

    public function scopeWhereRole(Builder $query, $role)
    {
        $query->whereRelation('role', 'name', $role);
    }

    public function scopeSortedUserList(Builder $query)
    {
        return $query->withCount(['posts', 'comments'])->with('avatar')->latest();
    }

    public function scopeRecentUsers(Builder $query)
    {
        return $query->where('created_at', '>=', now()->subDay())->count();
    }
}
