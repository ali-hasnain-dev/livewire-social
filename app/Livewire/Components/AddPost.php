<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddPost extends Component
{
    use WithFileUploads;
    public $content;

    #[Validate('nullable|sometimes|image|max:1024')]
    public $image;

    public function addPost(): void
    {
        if ($this->content) {
            $post = Post::create([
                'content' => $this->content,
                'user_id' => Auth::user()->id
            ]);

            if ($post) {
                $this->content = '';
                $this->dispatch('new-post-created');
            }
        }
    }

    public function render()
    {
        return view('livewire.components.add-post');
    }
}
