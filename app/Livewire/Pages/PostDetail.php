<?php

namespace App\Livewire\Pages;

use App\Models\Post;
use Livewire\Component;

class PostDetail extends Component
{
    public $post;
    public $data;

    public function mount($id)
    {
        $this->post = Post::with([
            'user:id,first_name,last_name,username,avatar',
            'likes',
            'comments',
        ])->find($id);

        $this->data = $this->post->toArray();
    }
    public function render()
    {
        return view('livewire.pages.post-detail');
    }
}
