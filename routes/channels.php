<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel(
    'post-like-notification.{post}',
    function (User $user, Post $post) {
        return true;
    }
);

Broadcast::channel(
    'post-comment-notification.{post}',
    function (User $user, Post $post) {
        return true;
    }
);
