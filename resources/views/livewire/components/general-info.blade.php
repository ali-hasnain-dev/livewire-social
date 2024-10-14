<div class="flex flex-col gap-6 ">
    <h1 class="text-xl font-bold">General Info</h1>
    @if (session()->has('profile_success'))
        <p class="flex items-center justify-center self-center text-green-500 text-sm font-semibold">
            {{ session()->pull('profile_success') }}</p>
    @endif
    <form wire:submit.prevent="updateProfile">
        <div class="md:flex justify-center items-center gap-24">
            <div class="flex flex-col gap-4 w-full">
                <x-input type="text" label="User Name" name="username" placeholder="User Name" required='true'
                    :error="$errors->first('username')" />

                <x-input type="text" label="name" name="name" placeholder="Name" required='true'
                    :error="$errors->first('name')" />

                <x-input type="text" label="Bio" name="bio" placeholder="Bio" :error="$errors->first('bio')" />

                <div class="flex flex-col gap-2">
                    <label for="" class="text-xs font-semibold">DOB</label>
                    <input type="date" class="w-full p-2 border border-gray-500 rounded-md dark:bg-slate-700"
                        placeholder="DOB" wire:model="dob">
                    <p class="text-red-500 text-xs">
                        @error('dob')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <button wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
                    class="p-2 bg-blue-500 text-white rounded-md self-end">
                    <x-button-loader message="Save" />
                </button>
            </div>
        </div>
    </form>
</div>
