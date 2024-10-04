<div class="p-4 bg-white rounded-lg shadow-md text-sm flex flex-col gap-6 dark:bg-slate-800">
    <div class="flex relative dark:bg-slate-800">
        <img src="{{ asset('images/avatar4.png') }}" class="rounded-md" />
        <img src="{{ asset('images/avatar.png') }}"
            class="rounded-full object-cover w-12 h-12 absolute left-0 right-0 m-auto -bottom-6 ring-1 ring-white z-10" />
    </div>
    <div class="flex flex-col gap-2 items-center">
        <span class="font-semibold">User Name</span>
        <div class="flex items-center gap-4">
            <div class="flex">
                <img src="https://images.pexels.com/photos/19578755/pexels-photo-19578755/free-photo-of-woman-watching-birds-and-landscape.jpeg?auto=compress&cs=tinysrgb&w=800&lazy=load"
                    alt="" class="rounded-full object-cover w-3 h-3" />
                <img src="https://images.pexels.com/photos/19578755/pexels-photo-19578755/free-photo-of-woman-watching-birds-and-landscape.jpeg?auto=compress&cs=tinysrgb&w=800&lazy=load"
                    alt="" class="rounded-full object-cover w-3 h-3" />
                <img src="https://images.pexels.com/photos/19578755/pexels-photo-19578755/free-photo-of-woman-watching-birds-and-landscape.jpeg?auto=compress&cs=tinysrgb&w=800&lazy=load"
                    alt="" class="rounded-full object-cover w-3 h-3" />
            </div>
            <span class="text-xs text-gray-500">500 Folowers</span>
        </div>
        <a href="{{ route('profile', ['name' => auth()->user()->username]) }}" wire:navigate
            class="bg-blue-500 text-white p-2 text-xs rounded-lg">
            My Profile
        </a>
    </div>
</div>
