<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Post extends Component
{
    public $post;

    public function mount($post)
    {

        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.components.post');
    }
}
