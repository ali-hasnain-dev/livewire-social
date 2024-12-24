<?php

namespace App\Livewire\Components;

use App\Events\CommentNotification;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class AddComment extends Component
{
    public $comment;

    public $latestComment;

    #[Locked]
    public $postId;

    public $likedByme = false;

    public $data;

    public $likesCount;


    public function mount($post)
    {
        $this->postId = $post->id;
        $this->likedByme = $post->latestComment->likes ? in_array(Auth::user()->id, $post->latestComment->likes->pluck('user_id')->toArray()) : false;
        $this->latestComment = $post->latestComment;
        $this->data = $post->latestComment->toArray();
        $this->likesCount = $post->latestComment->likes->count();
    }

    public function addComment()
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $this->postId,
            'content' => $this->comment,
        ]);

        $this->comment = '';
        $this->getlatestComment();
        defer(function () {
            $post = Post::withCount('comments')->find($this->postId);
            event(new CommentNotification($post));
        });
    }

    #[On('update-comments')]
    public function updateComments()
    {
        $this->getlatestComment();
    }

    public function getlatestComment()
    {
        $comment = Comment::with('user:id,first_name,last_name,avatar,username', 'likes')
            ->where('post_id', $this->postId)
            ->latest()
            ->first()
            ->toArray();
        $this->data = $comment;
        $this->likesCount = $comment['likes_count'];
    }

    public function likeComment()
    {
        $like = Like::where([['user_id', Auth::user()->id], ['likeable_type', 'App\Models\Comment'], ['likeable_id', $this->data['id']]])->first();
        if ($like) {
            $like->delete();
            $this->likedByme = false;
        } else {
            Like::create([
                'user_id' => Auth::user()->id,
                'likeable_type' => 'App\Models\Comment',
                'likeable_id' => $this->data['id'],
            ]);
            $this->likedByme = true;
        }
    }

    public function render()
    {
        return view('livewire.components.add-comment');
    }
}
