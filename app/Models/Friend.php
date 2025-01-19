<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';

    protected $fillables = [
        'status',
        'user_id',
        'friend_id',
    ];

    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
