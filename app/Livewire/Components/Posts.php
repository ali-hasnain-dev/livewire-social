<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $count = 0;
    public $offsetOfPosts = 10;
    public $hasMoreData = true;
    public function loadMore()
    {
        $this->count++;
    }

    #[On('post-created')]
    public function updatePostList()
    {
        $this->count = 0;
        $this->offsetOfPosts = 10;
    }

    public function render()
    {
        $newPost = Post::with('user')->offset($this->offsetOfPosts * $this->count)->orderByDesc('created_at')->take($this->offsetOfPosts)->get();
        if ($newPost->count() < $this->offsetOfPosts) {
            $this->hasMoreData = false; // No more data to load
        }

        $this->posts = $this->count == 0 ? $newPost : [...$this->posts, ...$newPost];
        return view('livewire.components.posts');
    }
}
