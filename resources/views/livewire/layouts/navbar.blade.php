<div class=" flex items-center justify-between h-16">
    <div class="hidden md:block">
        <a href="/" wire:navigate class="text-xl font-bold text-blue-500">Livewire Social</a>
    </div>
    <div class="flex gap-4 text-sm font-semibold">
        <a href="/" wire:navigate
            class="{{ request()->routeIs('home') ? 'text-gray-500 font-bold underline underline-offset-8' : 'text-gray-400' }}">Home</a>
        <a href="" class="text-gray-400">Friends</a>
        {{-- <a href="">help</a> --}}
    </div>
    <div class="text-sm font-semibold self-right">
        @auth
            <div x-data="{ open: false }" class="relative">
                <div class="flex items-center gap-2">
                    <h1 class="text-xs font-bold">{{ auth()->user()->name }}</h1>
                    <img @click="open = !open"
                        src="{{ auth()->user()->avatar ? auth()->user()->avatar : asset('images/avatar.png') }}"
                        alt="" class="rounded-full w-10 h-10 object-cover cursor-pointer">
                </div>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-cloak
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                    <div class="flex flex-col gap-2 p-2">
                        <a href="/settings" wire:navigate
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                            Settings
                        </a>
                        <hr>
                        <a href="javascript:void(0)" wire:click="logout"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                            Signout
                        </a>
                        <!-- Add more menu items here -->
                    </div>
                </div>
            </div>

        </div>
    @else
        <a href="/signin" wire:navigate class="text-blue-500"><b>Signin</b></a>
    @endauth
</div>
