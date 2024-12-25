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

    public $files = [];

    public $uploadedFiles = [];

    public $newFile;

    public $turnOffLikes = true;
    public  $turnOffComments = true;


    public $newPost = false;

    public function updatedFiles()
    {
        $this->validate([
            'files.*' => [
                'nullable',
                'file',
                function ($attribute, $value, $fail) {
                    $mimeType = $value->getMimeType();

                    if (str_starts_with($mimeType, 'image')) {
                        if (!in_array($value->getClientOriginalExtension(), ['png', 'jpeg', 'jpg', 'webp'])) {
                            return $fail("The $attribute must be a file of type: png, jpeg, jpg, webp.");
                        }

                        if ($value->getSize() > 5120 * 1024) { // 5 MB
                            return $fail("The $attribute must not be greater than 5MB.");
                        }
                    } elseif (str_starts_with($mimeType, 'video')) {
                        if ($value->getClientOriginalExtension() !== 'mp4') {
                            return $fail("The $attribute must be a file of type: mp4.");
                        }

                        if ($value->getSize() > 10240 * 1024) { // 10 MB
                            return $fail("The $attribute must not be greater than 10MB.");
                        }
                    } else {
                        return $fail("The $attribute must be an image or video file.");
                    }
                },
            ],
        ]);

        foreach ($this->files as $file) {
            $this->uploadedFiles[] = $file; // Store the original file
            $this->files[] = [
                'url' => $file->temporaryUrl(), // Generate preview URL
            ];
        }
        $this->files = array_slice($this->files, count($this->uploadedFiles)); // Avoid duplicates
    }

    public function updatedNewFile()
    {
        // Validate the new file
        $this->validate([
            'newFile' => 'image|max:1024', // Validate image and max size 1MB
        ]);

        // Add to uploaded files and preview URLs
        $this->uploadedFiles[] = $this->newFile;
        $this->files[] = [
            'url' => $this->newFile->temporaryUrl(),
        ];

        // Clear the newFile property
        $this->reset('newFile');
    }

    public function removeImage($index)
    {
        array_splice($this->files, $index, 1);
    }

    public function addPost(): void
    {
        $this->validate([
            'content' => 'nullable|required_without:uploadedFiles|max:1000',
            'uploadedFiles.*' => [
                'nullable',
                'file',
                function ($attribute, $value, $fail) {
                    $mimeType = $value->getMimeType();

                    if (str_starts_with($mimeType, 'image')) {
                        if (!in_array($value->getClientOriginalExtension(), ['png', 'jpeg', 'jpg', 'webp'])) {
                            return $fail("The $attribute must be a file of type: png, jpeg, jpg, webp.");
                        }

                        if ($value->getSize() > 5120 * 1024) { // 5 MB
                            return $fail("The $attribute must not be greater than 5MB.");
                        }
                    } elseif (str_starts_with($mimeType, 'video')) {
                        if ($value->getClientOriginalExtension() !== 'mp4') {
                            return $fail("The $attribute must be a file of type: mp4.");
                        }

                        if ($value->getSize() > 10240 * 1024) { // 10 MB
                            return $fail("The $attribute must not be greater than 10MB.");
                        }
                    } else {
                        return $fail("The $attribute must be an image or video file.");
                    }
                },
            ],
        ]);

        $post = Post::create([
            'content' => $this->content ?? '',
            'allow_comments' => $this->turnOffComments,
            'allow_likes' => $this->turnOffLikes,
            'user_id' => Auth::user()->id,
        ]);

        if ($this->uploadedFiles) {
            foreach ($this->uploadedFiles as $file) {
                $mimeType = $file->getMimeType();
                $path = $file->store('uploads', 'public');
                $post->images()->create([
                    'url' => 'storage/' . $path,
                    'type' => $mimeType,
                ]);
            }
        }

        if ($post) {
            $this->content = '';
            $this->files = [];
            $this->uploadedFiles = [];
            $this->newPost = false;
            $this->turnOffLikes = true;
            $this->turnOffComments = true;
            $this->dispatch('new-post-created');
        }
    }

    public function render()
    {

        return view('livewire.components.add-post');
    }
}
