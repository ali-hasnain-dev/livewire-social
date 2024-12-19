<div class="flex flex-col gap-6 md:w-[550px]">
    <div class="flex flex-col gap-1">
        <h1 class="text-lg font-semibold dark:text-slate-400 text-slate-600">About</h1>
        <span class="text-slate-500 text-xs">Update about yourself information</span>
    </div>
    @if (session()->has('profile_success'))
        <p class="flex items-center justify-center self-center text-green-500 text-sm font-semibold">
            {{ session()->pull('profile_success') }}</p>
    @endif
    <form wire:submit.prevent="updateAbount">
        @csrf
        <div class="md:flex justify-center items-center gap-24">
            <div class="flex flex-col gap-4 w-full">
                <x-input-text type="text" label="Phone" name="phone" placeholder="Phone" required='false'
                    :error="$errors->first('phone')" model="phone" />

                <div class="flex flex-col gap-2">
                    <label class="text-xs font-semibold" for="datepicker-autohide">DOB
                        <span class="text-red-500">*</span>
                    </label>
                    <input x-init="flatpickr($el, {
                        maxDate: new Date(new Date().setFullYear(new Date().getFullYear() - 13)),
                        onChange: function(selectedDates, dateStr) {
                            // Emit the date change to Livewire
                            $wire.set('dob', dateStr);
                        }
                    });" type="text"
                        class="w-full p-2 outline-none border text-sm font-normal border-slate-200 dark:border-slate-700 rounded-lg dark:bg-slate-900 shadow"
                        placeholder="Select DOB" wire:model.defer="dob" wire:ignore>
                    <p class="text-red-500 text-xs">
                        @error('dob')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <x-textarea label="Bio" name="bio" placeholder="Bio" :error="$errors->first('bio')" model="bio" />
                <button wire:loading.attr="disabled" wire:loading.class="bg-gray-400"
                    class="p-2 text-sm bg-black text-white rounded-lg self-start ">
                    <x-button-loader message="Save" />
                </button>
            </div>
        </div>
    </form>
</div>
