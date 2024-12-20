<div class="flex flex-col gap-6 md:w-[550px] mb-12" x-data="{ deleteAccount: false, password: @entangle('password'), erorMessage: @entangle('erorMessage') }">
    <div class="flex flex-col gap-1">
        <h1 class="text-lg font-semibold dark:text-slate-400 text-slate-600">Delete Account</h1>
        <span class="text-slate-500 text-xs">Once your account is deleted, all of its resources and data will be
            permanently deleted.</span>
    </div>
    <button @click="deleteAccount=true"
        class="text-sm text-red-500 p-2 self-start border border-red-500 rounded-md">Delete Account</button>

    @teleport('body')
        <div x-show="deleteAccount" class="fixed inset-0 z-[99] flex items-center justify-center w-screen h-screen"
            wire:ignore.self>
            <div x-show="deleteAccount" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
            <div x-show="deleteAccount" x-trap.inert.noscroll="deleteAccount" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-md sm:rounded-lg dark:bg-slate-800">
                <div class="flex items-center justify-between pb-3 p-2">
                    <h3 class="text-md font-semibold">Are you sure you want to delete your account?</h3>
                </div>
                <div class="flex flex-col gap-4 p-2">
                    <p class="text-sm text-gray-500">This action cannot be undone. This will permanently delete your account
                        and remove all your data.</p>
                    <form wire:submit.prevent="deleteAccount" class="flex flex-col gap-4">
                        @csrf
                        <x-input-text type="password" label="Password" name="password" placeholder="Password"
                            required='true' :error="$errors->first('password')" model="password" />
                        <div class="flex items-center gap-2 justify-end self-end">
                            <p class="text-red-500 text-sm font-semibold" x-text='erorMessage'></p>
                            <button type="button" class="border border-gray-950 p-2 text-sm rounded-md shadow-md"
                                @click="deleteAccount=false, password='', erorMessage='' ">Cancel</button>
                            <button @click="erorMessage=''" wire:loading.remove
                                class="border border-red-500 p-2 text-sm text-red-500 rounded-md shadow-md"
                                type="submit">Delete Account</button>
                            <button wire:loading wire:target="deleteAccount" wire:loading.attr="disabled"
                                class="border border-red-500 p-2 text-sm text-red-500 rounded-md shadow-md">
                                <x-button-loader message="Delete Account" spinColor="text-red-500" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endteleport
</div>
