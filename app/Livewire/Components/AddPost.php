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

    #[Validate([
        'images' => 'nullable|array|max:4', // Ensure images is an array and limit to max 4
        'images.*' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:1024', // Validate each image
    ])]
    public $images;

    public function addPost(): void
    {
        $post = Post::create([
            'content' => $this->content,
            'user_id' => Auth::user()->id
        ]);

        if ($this->images) {
            foreach ($this->images as $image) {
                $mimeType = $image->getMimeType();
                $path = $image->store('uploads/', 'public');
                $post->images()->create([
                    'url' => 'storage/' . $path,
                    'type' => $mimeType,
                ]);
            }
        }

        if ($post) {
            $this->content = '';
            $this->images = null;
            $this->dispatch('new-post-created');
        }
    }

    public function render()
    {
        return view('livewire.components.add-post');
    }
}
