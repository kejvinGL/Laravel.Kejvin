<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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


    public function role(): belongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function avatar(): string
    {
        $avatar = Media::where('user_id', $this->id)
            ->where('type', 'avatar')
            ->first();

        if ($avatar !== null && isset($avatar->path)) {
            return Storage::url("avatars/".$avatar->path);
        }

        return Storage::url("avatars/default/default.svg");
    }

    public function getRole()
    {
        return $this->role()->first()->id;
    }
}