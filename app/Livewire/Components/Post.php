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
        $this->likedByme = $post->likes ? in_array(auth()->user()->id, $post->likes->pluck('user_id')->toArray()) : false;
    }

    public function like($id)
    {
        $like = Like::firstOrNew([
            'user_id' => auth()->id(),
            'post_id' => $id,
        ]);

        if ($like->exists) {
            // If the like already exists, delete it
            $like->delete();
            $this->likes--;
            $this->likedByme = false;
        } else {
            // If the like doesn't exist, save it
            $like->save();
            $this->likes++;
            $this->likedByme = true;
        }
    }


    public function render()
    {
        return view('livewire.components.post');
    }
}
