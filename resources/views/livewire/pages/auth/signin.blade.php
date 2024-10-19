<div class="{{ auth()->check() ? 'h-[calc(100vh-98px)]' : 'h-screen' }}  flex items-center justify-center">
    <div class="bg-white p-8 rounded-md shadow-md w-[400px] dark:bg-slate-800">
        <h1 class="mb-1 text-lg font-semibold text-blue-500">Livewire Social</h1>
        <p class="text-sm font-semibold mb-2">Welcome Back!</p>
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

            <x-input type="text" label="Email" name="email" placeholder="Email" required='true'
                :error="$errors->first('email')" />
            <x-input type="password" label="Password" name="password" placeholder="Password" required='true'
                :error="$errors->first('password')" />
            <a href="/forgot-password" wire:navigate class="text-xs self-end hover:underline"><b>Forgot
                    Password?</b></a>
            <button class="p-2 bg-black text-white rounded-md mt-5" type="submit" wire:loading.attr="disabled">
                <x-button-loader message="Signin" />
            </button>
        </form>
        <div class="flex items-center justify-center mt-4">
            <p class="text-sm">Don't have an account? <a href="/signup" wire:navigate
                    class="text-black dark:white text-xs hover:underline"><b>Signup</b></a>
            </p>
        </div>
    </div>
</div>
