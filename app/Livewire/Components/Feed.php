<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Carbon\Carbon;
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
        $newPost = Post::select('id', 'content', 'image', 'user_id', 'created_at') // Only select required fields from Post
            ->with([
                'user:id,name,avatar', // Select only necessary fields from user
                'likes:id,post_id,user_id' // Only necessary fields from likes
            ])
            ->withCount('likes') // Get count of likes
            ->orderByDesc('created_at') // Order posts by creation date
            ->offset($this->offsetOfPosts * $this->count) // Pagination logic
            ->take($this->offsetOfPosts) // Limit number of posts fetched
            ->get();

        if ($newPost->count() < $this->offsetOfPosts) {
            $this->hasMoreData = false; // No more data to load
        }

        $this->posts = $this->count == 0 ? $newPost : [...$this->posts, ...$newPost];
    }

    public function render()
    {
        return view('livewire.components.feed');
    }
}
