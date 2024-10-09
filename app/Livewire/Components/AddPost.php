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

    #[Validate(['images.*' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:1024'])]
    public $images;

    public function addPost(): void
    {
        dd($this->images);
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

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
    }

    public function render()
    {
        return view('livewire.components.add-post');
    }
}
