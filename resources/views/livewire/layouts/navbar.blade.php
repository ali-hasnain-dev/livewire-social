<div class=" flex items-center justify-between h-16">
    <div class="hidden md:block">
        <a href="/" wire:navigate.hover class="text-xl font-bold text-blue-500">Wire Social</a>
    </div>
    <div class="flex gap-4 text-sm font-semibold">
        <a href="/" wire:navigate.hover
            class="{{ request()->routeIs('home') ? 'text-gray-500 dark:text-white font-bold underline underline-offset-8' : 'text-gray-400 ' }}">Home</a>
        <a href="{{ route('friends') }}" wire:navigate
            class="{{ request()->routeIs('friends') ? 'text-gray-500 dark:text-white font-bold underline underline-offset-8' : 'text-gray-400' }}">Friends</a>
    </div>
    <div class="text-sm font-semibold self-right">
        @auth
            <div x-data="{ open: false }" class="relative">
                <div class="flex items-center gap-2">
                    <h1 class="text-xs font-bold">{{ auth()->user()->username }}</h1>
                    <img @click="open = !open"
                        src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('images/avatar-placeholder.jpg') }}"
                        alt="" class="rounded-full w-10 h-10 object-cover cursor-pointer">
                </div>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-cloak x-transition:enter.duration.500ms
                    x-transition:leave.duration.400ms
                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 dark:bg-slate-800 ">
                    <div class="flex flex-col gap-3 p-2">
                        <div class="flex gap-2 items-center p-2 cursor-pointer hover:bg-gray-200 hover:rounded-md dark:hover:bg-slate-600"
                            @click="darkMode = !darkMode">
                            <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                Dark Mode
                            </svg>
                            <a x-show="!darkMode" href="javascript:void(0)"
                                class="block text-gray-800 rounded-md dark:text-white">
                                Dark Mode
                            </a>
                            <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                Light Mode
                            </svg>
                            <a x-show="darkMode" href="javascript:void(0)"
                                class="block text-gray-800 rounded-md dark:text-white">
                                Light Mode
                            </a>
                        </div>

                        <a href="/settings" wire:navigate
                            class="block  text-gray-800 rounded-md items-start float-start dark:text-white">
                            <div
                                class="flex gap-2 items-center p-2 hover:bg-gray-200 hover:rounded-md dark:hover:bg-slate-600 ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                <span>Settings</span>
                            </div>
                        </a>

                        <hr>
                        <div class="flex gap-2 items-center p-2 cursor-pointer hover:bg-gray-200 hover:rounded-md dark:hover:bg-slate-600"
                            wire:click="logout">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            <a href="javascript:void(0)" class="block text-gray-800 rounded-md dark:text-white">
                                Signout
                            </a>
                        </div>
                        <!-- Add more menu items here -->
                    </div>
                </div>
            </div>
        </div>
    @else
        <a href="/signin" wire:navigate class="text-blue-500"><b>Signin</b></a>
    @endauth
</div>
