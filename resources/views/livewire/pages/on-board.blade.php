<div class="flex items-center justify-center h-[calc(100vh-98px)] ">
    <div class="w-full md:w-[500px] bg-white dark:bg-slate-800 border-black shadow-2xl rounded-xl">
        <div class="w-full bg-black  items-center justify-center">
            <img src="{{ asset('images/avatar.png') }}" alt="">
        </div>
        <div class="flex flex-col gap-4 p-4">
            <x-input type="text" label="First Name" name="first_name" placeholder="First name" required='true'
                :error="$errors->first('first_name')" />
            <x-input type="text" label="Second Name" name="second_name" placeholder="Second name"
                :error="$errors->first('second_name')" />
            <x-textarea label="Bio" name="bio" placeholder="Bio" :error="$errors->first('bio')" />
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
        </div>
    </div>

</div>
