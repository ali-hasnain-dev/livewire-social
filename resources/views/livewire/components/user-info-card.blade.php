<div class="p-4 bg-white dark:bg-slate-800 rounded-lg shadow-md text-sm flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-md font-semibold">User Info.</h1>
        <a href="{{ route('settings') }}" wire:navigate class="text-sm text-blue-500"><i
                class="fa-regular fa-pen-to-square"></i></a>
    </div>
    <div class="flex flex-col gap-4">
        <div class="flex items-center gap-2 justify-between">
            <p class="text-xs font-semibold text-gray-300">
                <span>
                    <i class="fa-solid fa-user"></i>
                </span>
                Gender
            </p>
            <p class="text-xs">{{ Auth::user()->gender ? Auth::user()->gender : 'N/A' }}</p>
        </div>
        <div class="flex items-center gap-2 justify-between">
            <p class="text-xs font-semibold text-gray-300 ">
                <span>
                    <i class="fa-solid fa-mobile-screen "></i>
                </span>
                Phone
            </p>
            <p class="text-xs">{{ Auth::user()->phone ? Auth::user()->phone : 'N/A' }}</p>
        </div>
        <div class="flex items-center gap-2 justify-between">
            <p class="text-xs font-semibold text-gray-300">
                <span>
                    <i class="fa-regular fa-calendar "></i>
                </span>
                DOB
            </p>
            <p class="text-xs">{{ Auth::user()->dob ? Auth::user()->dob : 'N/A' }}</p>
        </div>
        @if (Auth::user()->bio)
            <div class="flex flex-col gap-2">
                <p class="text-xs font-semibold text-gray-300">About</p>
                <p class="text-xs">{{ Auth::user()->bio }}</p>
            </div>
        @endif

    </div>
</div>
