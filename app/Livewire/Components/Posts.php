<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $count = 0;
    public $offsetOfPosts = 10;
    public function loadMore()
    {
        $this->count++;
    }


    public function render()
    {
        $newPost = Post::with('user')->offset($this->offsetOfPosts * $this->count)->orderByDesc('created_at')->take($this->offsetOfPosts)->get();
        $this->posts = $this->count == 0 ? $newPost : [...$this->posts, ...$newPost];
        return view('livewire.components.posts');
    }
}
