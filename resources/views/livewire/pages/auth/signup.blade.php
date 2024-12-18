<div class="{{ auth()->check() ? 'h-[calc(100vh-98px)]' : 'h-screen' }} flex items-center justify-center">
    <div class="bg-white p-8 rounded-md shadow-md w-full md:w-[400px] dark:bg-slate-800">
        <h1 class="mb-1 text-lg font-semibold text-blue-500">Wire Social</h1>
        <p class="text-xs font-semibold mb-2">Let's create new account!</p>
        <form class="flex flex-col gap-2" wire:submit.prevent="submitsignup">
            <p class="text-red-500 text-xs self-center font-bold">
                @session('error')
                    {{ session()->pull('error') }}
                @endsession
            </p>

            <x-input-text type="text" label="Username" name="username" placeholder="Username" required='true'
                :error="$errors->first('signupForm.username')" model="signupForm.username" />

            <x-input-text type="email" label="Email" name="email" placeholder="Name" required='true'
                :error="$errors->first('signupForm.email')" model="signupForm.email" />

            <x-input-text type="password" label="Password" name="password" placeholder="Password" required='true'
                :error="$errors->first('signupForm.password')" model="signupForm.password" />

            <button class="p-2 bg-black text-white rounded-md" type="submit" wire:loading.remove>Signup</button>
            <button wire:loading class="w-full text-blue-500 font-semibold p-2 rounded-md border border-blue-500"
                disabled>
                <x-button-loader message="Signup" />
            </button>
        </form>
        <div class="flex items-center justify-center mt-4">
            <p class="text-sm">Already have an account? <a href="/signin" wire:navigate
                    class="text-black dark:text-blue-500 text-xs hover:underline"><b>Signin</b></a>
            </p>
        </div>
    </div>
</div>
