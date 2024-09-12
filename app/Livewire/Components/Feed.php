<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Carbon\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Component;

class Feed extends Component
{
    public $posts;
    public $count = 0;
    public $offsetOfPosts = 10;
    public $hasMoreData = true;
    public $hasNewPosts = false;

    public $userId;

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
        $newPostIds = Post::with('user')
            ->orderByDesc('created_at')->whereDate('created_at', Carbon::today())->whereTime('created_at', '>=', Carbon::now()->subMinutes(3))->get()->pluck('id');

        $this->hasNewPosts = count($newPostIds) > 0 ? true : false;
    }

    public function refreshPosts()
    {
        $this->hasNewPosts = false;
        $this->count = 0;
        $this->offsetOfPosts = 10;
        $this->getMorePost();
    }

    #[Renderless]
    public function getMorePost()
    {
        $newPost = Post::select('id', 'content', 'image', 'user_id', 'created_at')
            ->with([
                'user:id,name,avatar,username',
                'likes:id,post_id,user_id'
            ])
            ->withCount('likes')
            ->orderByDesc('created_at')
            ->offset($this->offsetOfPosts * $this->count)
            ->take($this->offsetOfPosts)
            ->when($this->userId, fn($query) => $query->where('user_id', $this->userId))
            ->get();

        if ($newPost->count() < $this->offsetOfPosts) {
            $this->hasMoreData = false;
        }

        $this->posts = $this->count == 0 ? $newPost : [...$this->posts, ...$newPost];
    }

    public function render()
    {
        return view('livewire.components.feed');
    }
}
