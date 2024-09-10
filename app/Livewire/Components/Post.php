<?php

namespace App\Livewire\Components;

use App\Models\Like;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public $likes;
    public $likedByme = false;

    public function mount($post)
    {
        $this->post = $post;
        $this->likes = $post->likes_count;
        $this->likedByme = $post->isLikedByMe();
    }

    public function like($id)
    {
        $post = Like::where([['user_id', auth()->id()], ['post_id', $id]])->first();
        if ($post) {
            $post->delete();
            $this->likes--;
            $this->likedByme = false;
        } else {
            Like::firstOrCreate([
                'user_id' => auth()->id(),
                'post_id' => $id,
            ]);
            $this->likedByme = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.components.post');
    }
}
