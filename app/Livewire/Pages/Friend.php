<?php

namespace App\Livewire\Pages;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Friend extends Component
{
    public $search, $searchtext = '';

    public $users = [];

    public function mount()
    {
        $this->updatedSearch();
    }

    public function updatedSearch()
    {
        if ($this->search) {
            $users = User::where('id', '!=', Auth::user()->id)->where('name', 'like', '%' . $this->search . '%')->orWhere('username', 'like', '%' . $this->search . '%')->select('id', 'name', 'username', 'avatar')->get();

            $this->users = $users;
            $this->searchtext = $this->search;
        } else {
            $this->searchtext = 'Suggestions';
            $this->users = User::with('sentFriendRequest')->where('id', '!=', Auth::user()->id)->select('id', 'name', 'username', 'avatar')->limit(7)->inRandomOrder()->get();
        }
    }

    public function addFriend($id)
    {
        $alreadyExists = FriendRequest::where([['sender', Auth::user()->id], ['receiver', $id]])->first();
        if ($alreadyExists) {
            $alreadyExists->delete();
        } else {
            FriendRequest::create([
                'sender' => Auth::user()->id,
                'receiver' => $id,
            ]);
        }


        $this->updatedSearch();
    }

    public function render()
    {
        return view('livewire.pages.friend');
    }
}
