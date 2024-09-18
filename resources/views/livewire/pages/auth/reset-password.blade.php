<div
    class="{{ auth()->check() ? 'h-[calc(100vh-98px)]' : 'h-screen' }} flex items-center flex-col justify-center gap-4 ">
    @if (session()->has('status'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <span class="font-medium">Success!</span>{{ session()->get('status') }}
        </div>
    @endif

    <div class="flex bg-white p-4 gap-6 flex-col w-full md:w-[400px]">
        <h1 class="text-sm font-bold self-center">Reset Password</h1>
        <div class="flex flex-col gap-4">
            <form wire:submit='resetPassword' class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <label for="" class="text-xs font-semibold">Email</label>
                    <input type="email" class="w-full p-2 border border-gray-500 rounded-md" placeholder="Email"
                        wire:model="email" required disabled readonly>
                    <p class="text-red-500 text-xs">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="" class="text-xs font-semibold">New Password</label>
                    <input type="password" class="w-full p-2 border border-gray-500 rounded-md"
                        placeholder="New password" wire:model="password">
                    <p class="text-red-500 text-xs">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="" class="text-xs font-semibold">Confirm Password</label>
                    <input type="password" class="w-full p-2 border border-gray-500 rounded-md"
                        placeholder="Confirm password" wire:model="password_confirmation">
                    <p class="text-red-500 text-xs">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
                <button wire:loading.remove type="submit"
                    class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Reset</button>
                <button wire:loading class="w-full text-blue-500 font-semibold p-2 rounded-md border border-blue-500"
                    disabled>
                    <x-loader-button :message="'Resetting...'" />
                </button>
            </form>
        </div>
    </div>
</div>
