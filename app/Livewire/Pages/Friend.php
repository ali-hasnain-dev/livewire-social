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
            $users = User::query()
                ->with('sentFriendRequest', 'isFollowing')
                ->where('id', '!=', Auth::user()->id)
                ->where(function ($query) {
                    $query->orWhere('username', 'like', '%' . $this->search . '%')
                        ->orWhere('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%');
                })
                ->select('id', 'first_name', 'last_name', 'username', 'avatar')
                ->limit(10)
                ->get();

            $this->users = $users;
            $this->searchtext = $this->search;
        } else {
            $this->searchtext = 'Suggestions';
            $this->users = User::query()
                ->with('isFollowing')
                ->where('id', '!=', Auth::user()->id)
                ->whereDoesntHave('sentFriendRequest', function ($query) {
                    $query->where('sender', Auth::id());
                })
                ->select('id', 'first_name', 'last_name', 'username', 'avatar')
                ->limit(7)
                ->inRandomOrder()
                ->get();
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

    public function follow($id)
    {
        $user = User::find($id);

        if ($user->followers()->where('follower', Auth::id())->exists()) {
            $user->followers()->detach(Auth::id());
        } else {
            $user->followers()->attach(Auth::id());
        }
    }

    public function render()
    {
        return view('livewire.pages.friend');
    }
}
