<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    protected $table = 'friend_requests';

    protected $fillable = [
        'sender',
        'receiver',
    ];
}
