<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddPost extends Component
{
    use WithFileUploads;
    public $content;
    public $photo;

    public function addPost()
    {
        if ($this->content) {
            $post = Post::create([
                'content' => $this->content,
                'user_id' => auth()->user()->id
            ]);

            if ($post) {
                $this->content = '';
                $this->dispatch('post-created');
            }
        }
    }


    #[On('echo:like-notification,LikeNotfication')]
    public function handleNofication($data)
    {
        dd($data);
    }

    public function render()
    {
        return view('livewire.components.add-post');
    }
}
