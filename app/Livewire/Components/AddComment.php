<?php

namespace App\Livewire\Components;

use App\Events\CommentNotification;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class AddComment extends Component
{
    public $comment;

    public $latestComments = [];

    #[Locked]
    public $postId;

    public function mount($post)
    {
        $this->postId = $post->id;
        $this->latestComments = $post->comments;
    }

    public function addComment()
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->postId,
            'content' => $this->comment,
        ]);

        $this->comment = '';
        $this->getLatestComments();
        defer(function () {
            $post = Post::withCount('comments')->find($this->postId);
            event(new CommentNotification($post));
        });
    }

    #[On('update-comments')]
    public function updateComments()
    {
        $this->getLatestComments();
    }

    public function getLatestComments()
    {
        $this->latestComments = Comment::with('user:id,first_name,last_name,avatar,username')
            ->where('post_id', $this->postId)
            ->latest()
            ->take(1)
            ->get();
    }

    public function render()
    {
        return view('livewire.components.add-comment');
    }
}
