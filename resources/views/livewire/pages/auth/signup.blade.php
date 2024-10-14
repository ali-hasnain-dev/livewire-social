<div class="{{ auth()->check() ? 'h-[calc(100vh-98px)]' : 'h-screen' }} flex items-center justify-center">
    <div class="bg-white p-8 rounded-md shadow-md w-full md:w-[400px] dark:bg-slate-800">
        <h1 class="mb-1 text-lg font-semibold text-blue-500">Let's create new account!</h1>
        <form class="flex flex-col gap-2" wire:submit.prevent="submitsignup">
            <p class="text-red-500 text-xs self-center font-bold">
                @session('error')
                    {{ session()->pull('error') }}
                @endsession
            </p>
            <div class="flex flex-col gap-2">
                <label for="" class="text-xs font-semibold">Name</label>
                <input type="text" class="w-full p-2 outline-none border border-gray-500 rounded-md dark:bg-slate-700"
                    placeholder="Name" wire:model="name" required>
                <p class="text-red-500 text-xs">
                    @error('name')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="flex flex-col gap-2">
                <label for="" class="text-xs font-semibold">Username</label>
                <input type="text"
                    class="w-full p-2 outline-none border border-gray-500 rounded-md dark:bg-slate-700"
                    placeholder="Username" wire:model="username" required>
                <p class="text-red-500 text-xs">
                    @error('username')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="flex flex-col gap-2">
                <label for="" class="text-xs font-semibold">Email</label>
                <input type="email"
                    class="w-full p-2 outline-none border border-gray-500 rounded-md dark:bg-slate-700"
                    placeholder="Email" wire:model="email" required>
                <p class="text-red-500 text-xs">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="flex flex-col gap-2">
                <label for="" class="text-xs font-semibold">Password</label>
                <input type="password"
                    class="w-full p-2 outline-none border border-gray-500 rounded-md dark:bg-slate-700"
                    placeholder="Password" wire:model="password" required>
                <p class="text-red-500 text-xs">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="p-2 bg-blue-500 text-white rounded-md" type="submit" wire:loading.remove>Signup</button>
            <button wire:loading class="w-full text-blue-500 font-semibold p-2 rounded-md border border-blue-500"
                disabled>
                <<x-button-loader message="Signup" />
            </button>
        </form>
        <div class="flex items-center justify-center mt-4">
            <p>Already have an account? <a href="/signin" wire:navigate class="text-blue-500 text-sm"><b>Signin</b></a>
            </p>
        </div>
    </div>
</div>
