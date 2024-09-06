<div class=" flex items-center justify-between h-20">

    <div class="hidden md:block">
        <h1 class="text-xl font-bold text-blue-500">Hello world!</h1>
    </div>
    <div class="flex gap-4 items-center text-sm">
        <a href="/" wire:navigate>Home</a>
        <a href="">Schedule</a>
        <a href="">help</a>
    </div>
    <div class="text-sm font-semibold self-right">

        @auth
            <div x-data="{ open: false }" class="relative">
                <div class="flex items-center gap-2">
                    <h1 class="text-xs font-bold">{{ auth()->user()->name }}</h1>
                    <img @click="open = !open"
                        src="{{ auth()->user()->avatar ? auth()->user()->avatar : asset('images/noAvatar.png') }}"
                        alt="" class="rounded-full w-10 h-10 object-cover cursor-pointer">
                </div>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20">
                    <div class="flex flex-col gap-2 p-2">
                        <a href="/profile" wire:navigate class="block px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
                            Profile
                        </a>
                        <hr>
                        <a href="/signout" wire:navigate class="block px-4 py-2 text-gray-800 hover:bg-gray-200 rounded-md">
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

</div>
