<?php

namespace App\Livewire\Components;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class AddComment extends Component
{

    public $comment;
    public $latestComments;

    #[Locked]
    public $postId;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->getLatestComments();
    }

    public function addComment()
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->postId,
            'content' => $this->comment
        ]);

        $this->comment = '';
        $this->getLatestComments();
    }

    public function getLatestComments()
    {
        $this->latestComments = Comment::with('user')
            ->where('post_id', $this->postId)
            ->limit(3)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.components.add-comment');
    }
}
