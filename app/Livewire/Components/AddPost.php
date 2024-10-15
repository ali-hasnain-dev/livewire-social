<?php

namespace App\Livewire\Components;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddPost extends Component
{
    use WithFileUploads;
    public $content;

    public $files;

    public function addPost(): void
    {
        $this->validate([
            'files.*' => [
                'nullable',
                'file', // Ensures it’s a file
                function ($attribute, $value, $fail) {
                    $mimeType = $value->getMimeType();

                    if (str_starts_with($mimeType, 'image')) {
                        // Validate image file types and size
                        if (!in_array($value->getClientOriginalExtension(), ['png', 'jpeg', 'jpg', 'webp'])) {
                            return $fail("The $attribute must be a file of type: png, jpeg, jpg, webp.");
                        }

                        if ($value->getSize() > 5120 * 1024) { // 5 MB
                            return $fail("The $attribute must not be greater than 5MB.");
                        }
                    } elseif (str_starts_with($mimeType, 'video')) {
                        // Validate video file type and size
                        if ($value->getClientOriginalExtension() !== 'mp4') {
                            return $fail("The $attribute must be a file of type: mp4.");
                        }

                        if ($value->getSize() > 10240 * 1024) { // 10 MB
                            return $fail("The $attribute must not be greater than 10MB.");
                        }
                    } else {
                        return $fail("The $attribute must be an image or video file.");
                    }
                }
            ],
        ]);


        $post = Post::create([
            'content' => $this->content ?? '',
            'user_id' => Auth::user()->id
        ]);

        if ($this->files) {
            foreach ($this->files as $image) {
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
            $this->files = null;
            $this->dispatch('new-post-created');
        }
    }

    public function removeImage($index)
    {
        array_splice($this->files, $index, 1);
    }

    public function render()
    {
        return view('livewire.components.add-post');
    }
}
