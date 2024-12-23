<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class Settings extends Component
{
    #[Title('Settings')]
    public function render()
    {
        return view('livewire.pages.settings');
    }
}
