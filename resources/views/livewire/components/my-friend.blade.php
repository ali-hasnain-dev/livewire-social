<div class="w-full md:w-[450px] flex flex-col gap-6">
    @if (count($myFriends) > 0)
        @foreach ($myFriends as $user)
            <div class="flex justify-between items-center dark:bg-gray-700  border dark:border-none rounded-lg p-2 shadow-md">
                <div class="flex gap-1 items-center ">
                    <img src="{{ $user->avatar ? $user->avatar : asset('images/avatar.png') }}" alt="">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-semibold dark:text-white">{{ $user->first_name . ' ' . $user->last_name }}</p>
                        <span class="text-xs dark:text-white">{{ $user->username }}</span>
                    </div>
                </div>
                <div class="flex gap-2">

                </div>
            </div>
        @endforeach
    @else
        <p class="text-md text-gray-400 font-bold flex items-center justify-center">No friends yet</p>
    @endif
</div>