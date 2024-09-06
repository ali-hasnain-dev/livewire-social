<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public function mount()
    {
        $this->posts = Post::with('user')->get();
    }

    public function render()
    {
        return view('livewire.components.posts');
    }
}
