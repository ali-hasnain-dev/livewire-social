<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'cover',
        'username',
        'first_name',
        'last_name',
        'phone',
        'bio',
        'dob',
        'email',
        'gender',
        'status',
        'is_new',
        'is_admin',
        'password',
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

    public function myFriends(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'id');
    }

    public function friendRequests()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'receiver', 'sender');
    }

    public function sentFriendRequest()
    {
        return $this->hasOne(FriendRequest::class, 'receiver', 'id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following', 'follower');
    }

    public function isFollowing()
    {
        return $this->hasOne(Follow::class, 'following', 'id');
    }

    public function pendingRequests()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'sender', 'receiver');
    }
}
