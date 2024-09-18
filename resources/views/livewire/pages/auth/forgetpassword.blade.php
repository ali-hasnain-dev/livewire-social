<div
    class="{{ auth()->check() ? 'h-[calc(100vh-98px)]' : 'h-screen' }} flex items-center flex-col justify-center gap-4 ">
    @if (session()->has('status'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Success!</span>{{ session()->get('status') }}
        </div>
    @endif
    <h1 class="text-3xl font-bold my-3">Forgot Password?</h1>
    <p class="text-sm opacity-80">Enter your email address and we will send you a password reset link.</p>
    <form action="" class="w-full md:w-[400px] flex flex-col items-center gap-4" wire:submit='forgotPassword'>
        <div class="mb-4 w-full md:w-[400px]">
            <input type="email" id="email" name="email"
                class="mt-1 p-2 w-full md:w-[400px] border rounded-md {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}"
                placeholder="email" wire:model='email' required>
            <span class="text-red-500 font-normal text-xs">{{ $errors->first('email') }}</span>
        </div>
        <div class="flex justify-between items-center space-x-3">
            <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded-md hover:opacity-90"
                wire:loading.remove>Get reset link</button>
            <button wire:loading class="px-3 py-2 bg-blue-500 text-white rounded-md hover:opacity-90" disabled>
                <x-loader-button :message="'Getting reset link...'" />
            </button>
            <a href="{{ route('login') }}" wire:navigate
                class="px-3 py-2 ml-2 hover:bg-gray-100 hover:rounded-lg">Cancel</a>
        </div>
    </form>
</div>
