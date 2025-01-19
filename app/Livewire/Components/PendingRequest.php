<?php

namespace App\Livewire\Components;

use App\Models\Friend;
use App\Models\FriendRequest;
use Auth;
use DB;
use Livewire\Component;
use Log;

class PendingRequest extends Component
{

    public $requests;

    public function mount()
    {
        $this->getAllRequest();
    }

    public function getAllRequest()
    {
        $this->requests = FriendRequest::with('senderUser')->where("receiver", Auth::user()->id)->orderBy("created_at", "desc")->get();
    }

    public function deleteRequest($id)
    {

        try {
            FriendRequest::findOrFail($id)->delete();
            $this->getAllRequest();
        } catch (\Throwable $th) {
            Log::error($th->getCode());
            Log::error($th->getMessage());
        }

    }

    public function acceptRequest($id)
    {

        try {

            DB::transaction(function () use ($id) {
                $FriendRequest = FriendRequest::findOrFail($id);
                $frind = new Friend();
                $frind->status = 'added';
                $frind->user_id = $FriendRequest->sender;
                $frind->friend_id = $FriendRequest->receiver;
                $frind->save();

                $frind = new Friend();
                $frind->status = 'added';
                $frind->user_id = $FriendRequest->receiver;
                $frind->friend_id = $FriendRequest->sender;
                $frind->save();

                $FriendRequest->delete();
                $this->getAllRequest();
            });

        } catch (\Throwable $th) {
            Log::error($th->getCode());
            Log::error($th->getMessage());

            dd('here', $th->getCode(), $th->getMessage());
        }

    }

    public function render()
    {
        return view('livewire.components.pending-request');
    }
}
