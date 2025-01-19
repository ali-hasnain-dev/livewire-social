<div class="w-full md:w-[450px] flex flex-col gap-6">
    <div class="flex flex-col gap-6">
        @if ($requests)
            @foreach ($requests as $user)
                <div
                    class="flex justify-between items-center dark:bg-gray-700  border dark:border-none rounded-lg p-4 shadow-md">
                    <a href="{{ route('profile', ['name' => $user->senderUser->username]) }}" wire:navigate
                        class="flex gap-1 items-center ">
                        <img src="{{ $user->senderUser->avatar ? $user->senderUser->avatar : asset('images/avatar.png') }}"
                            alt="">
                        <div class="flex flex-col gap-1">
                            <p class="text-xs font-semibold dark:text-white">
                                {{ $user->senderUser->first_name . ' ' . $user->senderUser->last_name }}
                            </p>
                            <span class="text-xs dark:text-white">{{ $user->senderUser->username }}</span>
                        </div>
                    </a>
                    <div class="flex items-center gap-1.5">
                        <button class="border border-red-600 text-red-600 p-2 rounded text-xs"
                            wire:click="deleteRequest({{ $user->id }})">Delete</button>
                        <button class="border border-green-500 bg-green-500 text-white p-2 rounded text-xs"
                            wire:click="acceptRequest({{ $user->id }})">Confirm</button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="flex justify-center mt-5 mb-5">
                <p class="text-center text-md font-semibold">No pending request</p>
            </div>
        @endif
    </div>
</div>