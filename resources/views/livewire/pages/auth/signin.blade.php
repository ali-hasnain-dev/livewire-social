<div class="{{ auth()->check() ? 'h-[calc(100vh-98px)]' : 'h-screen' }}  flex items-center justify-center">
    <div class="bg-white p-8 rounded-md shadow-md w-[400px] dark:bg-slate-800">
        <h1 class="mb-1 text-lg font-semibold text-blue-500">Welcome to Livewire Social</h1>
        <form class="flex flex-col gap-2" wire:submit.prevent="submitLogin">
            <p class="text-red-500 text-xs self-center font-bold">
                @session('error')
                    {{ session()->pull('error') }}
                @endsession
            </p>
            <p class="text-green-500 text-xs self-center font-bold">
                @session('success')
                    {{ session()->pull('success') }}
                @endsession
            </p>

            @if (session()->has('status'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <span class="font-medium">Success!</span>{{ session()->get('status') }}
                </div>
            @endif
            <div class="flex flex-col gap-2">
                <label for="" class="text-xs font-semibold">Email</label>
                <input type="email"
                    class="w-full p-2 border border-gray-500 rounded-md outline-none dark:bg-slate-700"
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
                    class="w-full p-2 border border-gray-500 rounded-md outline-none dark:bg-slate-700"
                    placeholder="Password" wire:model="password" required>
                <p class="text-red-500 text-xs">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <a href="/forgot-password" wire:navigate class="text-blue-500 text-xs self-end"><b>Forgot
                    Password?</b></a>
            <button class="p-2 bg-blue-500 text-white rounded-md" type="submit" wire:loading.remove>Signin</button>
            <button wire:loading class="w-full text-blue-500 font-semibold p-2 rounded-md border border-blue-500"
                disabled>
                <x-loader-button :message="'Signing...'" />
            </button>
        </form>
        <div class="flex items-center justify-center mt-4">
            <p>Don't have an account? <a href="/signup" wire:navigate class="text-blue-500 text-sm"><b>Signup</b></a>
            </p>
        </div>
    </div>
</div>
