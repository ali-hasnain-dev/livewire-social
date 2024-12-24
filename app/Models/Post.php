<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['image', 'content', 'allow_comments', 'allow_likes',  'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function isLikedByMe()
    {
        return Like::where([['user_id', Auth::id()], ['post_id', $this->id]])->exists();
    }

    public function latestComment()
    {
        return $this->hasOne(Comment::class)->latest();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
