<?php

namespace App\Livewire\Components;

use App\Events\LikeNotfication;
use App\Models\Like;
use App\Models\Post as ModelsPost;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Post extends Component
{
    public $post;

    public $post_id;

    public $likes;

    public $comments;

    public $likedByme = false;

    public function mount($post)
    {
        $this->post = $post;
        $this->post_id = $post->id;
        $this->likes = $post->likes_count;
        $this->likedByme = $post->likes ? in_array(Auth::user()->id, $post->likes->pluck('user_id')->toArray()) : false;
        $this->comments = $post->comments_count;
    }

    public function like($id)
    {
        $like = Like::firstOrNew([
            'user_id' => Auth::id(),
            'post_id' => $id,
        ]);

        if ($like->exists) {
            $like->delete();
            $this->likedByme = false;
        } else {
            $like->save();
            $this->likedByme = true;
        }

        defer(function () use ($id) {
            $post = ModelsPost::withCount('likes')->find($id);
            event(new LikeNotfication($post));
        });
    }

    // #[On('echo-private:post-like-notification.{post_id},LikeNotfication')]
    // public function updateLikeCount($event)
    // {
    //     $this->likes = $event['like']['likes_count'];
    // }

    // #[On('echo-private:post-comment-notification.{post_id},CommentNotification')]
    // public function updateCommentCount($event)
    // {
    //     $this->comments = $event['comment']['comments_count'];
    //     $this->dispatch('update-comments');
    // }

    public function render()
    {
        return view('livewire.components.post');
    }
}
