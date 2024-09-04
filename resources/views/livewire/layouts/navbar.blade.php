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
        @if (auth()->check())
            {{ auth()->user()->name }}
        @endif
        @auth
            <a href="javascript:void(0)" wire:click="logout">Logout</a>
        @else
            <a href="/signin" wire:navigate class="text-blue-500"><b>Signin</b></a>
        @endauth
    </div>

</div>
