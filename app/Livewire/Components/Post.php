<?php

namespace App\Livewire\Components;

use App\Events\LikeNotfication;
use App\Models\Like;
use App\Models\Post as ModelsPost;
use Livewire\Attributes\On;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $post_id;
    public $likes;
    public $likedByme = false;

    public function mount($post)
    {
        $this->post = $post;
        $this->post_id = $post->id;
        $this->likes = $post->likes_count;
        $this->likedByme = $post->likes ? in_array(auth()->user()->id, $post->likes->pluck('user_id')->toArray()) : false;
    }

    public function like($id)
    {
        $like = Like::firstOrNew([
            'user_id' => auth()->id(),
            'post_id' => $id,
        ]);

        if ($like->exists) {
            $like->delete();
            $this->likedByme = false;
        } else {
            $like->save();
            $this->likedByme = true;
        };

        event(new LikeNotfication($like));
    }

    #[On('echo-private:post-like-notification.{post_id},LikeNotfication')]
    public function updateLikeCount($event)
    {
        $id = $event['like']['post_id'];
        $post = ModelsPost::withCount('likes')->find($id);
        $this->likes = $post->likes_count;
    }


    public function render()
    {
        return view('livewire.components.post');
    }
}
