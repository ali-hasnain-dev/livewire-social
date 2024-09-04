<div class="h-[calc(100vh-98px)] flex items-center justify-center">
    <div class="bg-white p-8 rounded-md shadow-md w-[400px]">
        <h1 class="mb-4 text-lg font-semibold text-blue-500">Welcome to Livewire Social</h1>
        <form class="flex flex-col gap-4" wire:submit.prevent="submitLogin">
            <p class="text-red-500 text-xs self-center font-bold">
                @session('error')
                    {{ session()->pull('error') }}
                @endsession
            </p>
            <div class="flex flex-col gap-2">
                <label for="" class="text-sm">Email</label>
                <input type="text" class="w-full p-2 border border-gray-500 rounded-md" placeholder="Email"
                    wire:model="email" required>
                <p class="text-red-500 text-xs">
                    @error('email')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <div class="flex flex-col gap-2">
                <label for="" class="text-sm">Password</label>
                <input type="password" class="w-full p-2 border border-gray-500 rounded-md" placeholder="Password"
                    wire:model="password" required>
                <p class="text-red-500 text-xs">
                    @error('password')
                        {{ $message }}
                    @enderror
                </p>
            </div>
            <button class="p-2 bg-blue-500 text-white rounded-md" type="submit"
                wire:loading.attr="disabled">login</button>
        </form>
        <div class="flex items-center justify-center mt-4">
            <p>Don't have an account? <a href="/signup" wire:navigate class="text-blue-500"><b>Signup</b></a>
            </p>
        </div>
    </div>
</div>
