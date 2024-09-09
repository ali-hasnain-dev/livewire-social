<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $count = 0;
    public $offsetOfPosts = 10;
    public $hasMoreData = true;
    public $hasNewPosts = false;

    public function mount()
    {
        $this->getMorePost();
    }

    public function loadMore()
    {
        $this->count++;
        $this->getMorePost();
    }

    #[On('post-created')]
    public function updatePostList()
    {
        $this->count = 0;
        $this->offsetOfPosts = 10;
        $this->getMorePost();
    }

    public function checkNewPost()
    {
        $newPostIds = Post::with('user')->orderByDesc('created_at')->take($this->offsetOfPosts)->whereTime('created_at', '>=', Carbon::now()->subMinutes(3))->get()->pluck('id')->pluck('id');

        $this->hasNewPosts = count($newPostIds) > 0 ? true : false;
    }

    public function refreshPosts()
    {
        $this->hasNewPosts = false;
        $this->count = 0;
        $this->offsetOfPosts = 10;
        $this->getMorePost();
    }

    public function getMorePost()
    {
        $newPost = Post::with('user')->offset($this->offsetOfPosts * $this->count)->orderByDesc('created_at')->take($this->offsetOfPosts)->get();
        if ($newPost->count() < $this->offsetOfPosts) {
            $this->hasMoreData = false; // No more data to load
        }

        $this->posts = $this->count == 0 ? $newPost : [...$this->posts, ...$newPost];
    }

    public function render()
    {

        return view('livewire.components.posts');
    }
}
