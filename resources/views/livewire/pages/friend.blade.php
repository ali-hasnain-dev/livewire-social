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
                    class="w-full dark:text-white p-2 border dark:border-gray-600 outline-none dark:bg-gray-700 rounded-md shadow-md"
                    placeholder="Search friends" wire:model.live.debounce.500ms="search">
            </div>
            <div class="flex flex-col gap-2 mt-2">
                @if ($search)
                    @if (count($users) > 0)
                        @foreach ($users as $user)
                            <div
                                class="flex justify-between items-center dark:bg-gray-700  border dark:border-none rounded-lg p-2 shadow-md">
                                <div class="flex gap-1 items-center ">
                                    <img src="{{ $user->avatar ? $user->avatar : asset('images/avatar.png') }}"
                                        alt="">
                                    <div class="flex flex-col gap-1">
                                        <p class="text-sm font-semibold dark:text-white">{{ $user->name }}</p>
                                        <span class="text-xs dark:text-white">{{ $user->username }}</span>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button
                                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">Send
                                        Request</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-md text-gray-400 font-bold flex items-center justify-center h-screen">No friends
                            found</p>
                    @endif
                @else
                    <p class="text-md text-gray-400 font-bold flex items-center justify-center">
                        Search friends
                    </p>
                @endif
            </div>
        </div>
        <div x-show="activeTab === 2" class="">
            <livewire:components.my-friend />
        </div>
        <div x-show="activeTab === 3" class="">
            Pending Request
        </div>
    </div>
</div>
