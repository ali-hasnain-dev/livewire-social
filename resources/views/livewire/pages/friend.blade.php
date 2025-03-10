<div class="flex flex-col gap-4 items-center justify-center mt-5" x-data="{ activeTab: 1 }">
    <div class="flex gap-6 dark:text-white items-center justify-center">
        <p class="text-sm cursor-pointer text-gray-400" @click="activeTab = 1"
            :class="{ 'text-gray-700 font-bold dark:text-white underline underline-offset-[10px]': activeTab === 1 }">
            Search</p>
        <p class="text-sm cursor-pointer text-gray-400" @click="activeTab = 2"
            :class="{ 'text-gray-700 font-bold dark:text-white underline underline-offset-[10px]': activeTab === 2 }">My
            Friends</p>
        <p class="text-sm cursor-pointer  text-gray-400" @click="activeTab = 3"
            :class="{ 'text-gray-700 font-bold dark:text-white underline underline-offset-[10px]': activeTab === 3 }">
            Pending Request</p>
    </div>

    <div class="mt-5" x-cloak>
        <div x-show="activeTab === 1" class="w-full md:w-[450px] flex flex-col gap-6">
            <div class="w-full">
                <input type="text"
                    class="w-full dark:text-white p-2 border dark:border-gray-600 outline-none dark:bg-gray-700 rounded-md shadow-md placeholder:italic"
                    placeholder="Add new friends" wire:model.live.debounce.500ms="search">
            </div>
            <div class="flex flex-col gap-2 my-4">
                <p class="text-sm font-semibold text-gray-400 dark:text-white mb-2">{{ $searchtext }}:</p>
                @if (count($users) > 0)
                    @foreach ($users as $user)
                        <div
                            class="flex justify-between items-center dark:bg-gray-700  border dark:border-none rounded-lg p-4 shadow-md">
                            <a href="{{ route('profile', ['name' => $user->username]) }}" wire:navigate
                                class="flex gap-1 items-center ">
                                <img src="{{ $user->avatar ? $user->avatar : asset('images/avatar.png') }}"
                                    alt="">
                                <div class="flex flex-col gap-1">
                                    <p class="text-xs font-semibold dark:text-white">
                                        {{ $user->first_name . ' ' . $user->last_name }}</p>
                                    <span class="text-xs dark:text-white">{{ $user->username }}</span>
                                </div>
                            </a>
                            <div class="flex items-center gap-3.5">
                                <i class="fa-solid fa-user-plus cursor-pointer {{ $user->isFollowing ? 'text-blue-500' : '' }}"
                                    wire:click='follow({{ $user->id }})'
                                    title="{{ $user->isFollowing ? 'Unfollow' : 'Follow' }}"></i>
                                <i class="fa-solid fa-plus cursor-pointer {{ $user->sentFriendRequest ? 'text-blue-500' : '' }}"
                                    wire:click="addFriend({{ $user->id }})"
                                    title="{{ $user->sentFriendRequest ? 'Cancel Request' : 'Add Friend' }}"></i>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-md text-gray-400 font-bold flex items-center justify-center mt-8">No friends
                        found</p>
                @endif

            </div>
        </div>
        <div x-show="activeTab === 2" class="">
            <livewire:components.my-friend />
        </div>
        <div x-show="activeTab === 3" class="">
            <livewire:components.pending-request />
        </div>
    </div>
</div>
