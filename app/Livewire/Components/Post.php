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

    public $data;

    public function mount(ModelsPost $post)
    {
        $this->likedByme = $post->likes ? in_array(Auth::user()->id, $post->likes->pluck('user_id')->toArray()) : false;
        $this->data = $this->post->toArray();
    }

    public function like($id)
    {
        $like = Like::firstOrNew([
            'user_id' => Auth::id(),
            'likeable_id' => $id,
            'likeable_type' => ModelsPost::class,
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
