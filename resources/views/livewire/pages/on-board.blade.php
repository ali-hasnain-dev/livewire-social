<div class="flex flex-col gap-4 items-center justify-center h-[calc(100vh-98px)] " x-data="{
    currentStep: @entangle('currentStep'),
    totalSteps: @entangle('totalSteps'),
}">
    <div class="flex items-center justify-center">
        <p class="my-3 text-md font-semibold">Current step: {{ $currentStep }} of {{ $totalSteps }}</p>
    </div>
    <div class="w-full md:w-[500px] bg-white dark:bg-slate-800 border-black shadow-2xl rounded-xl">
        <div class="w-full p-3" x-show="currentStep== 1">
            <div class="flex my-3">
                <p class="text-lg font-semibold">Setup general info.</p>
            </div>
            <div class="w-full bg-black  items-center justify-center">
                <img src="{{ asset('images/avatar.png') }}" alt="">
            </div>
            <div class="flex flex-col gap-4 p-4">
                <x-input type="text" label="First Name" name="first_name" placeholder="First name" required='true'
                    :error="$errors->first('first_name')" />
                <x-input type="text" label="Last Name" name="last_name" placeholder="Last name" :error="$errors->first('last_name')" />
                <x-input type="text" label="Phone" name="phone" placeholder="Phone" :error="$errors->first('phone')" />
            </div>
        </div>

        <div class="w-full flex flex-col gap-3 p-3" x-show="currentStep== 2" x-cloak>
            <div class="flex my-3">
                <p class="text-lg font-semibold">Setup personal info.</p>
            </div>
            <div class="flex flex-col gap-2">
                <p class="text-xs font-semibold">Gender</p>
                <div class="flex items-center gap-4">
                    <x-radio-button name="gender" label="Male" value="male" :error="$errors->first('gender')" />
                    <x-radio-button name="gender" label="Female" value="female" :error="$errors->first('gender')" />
                </div>
            </div>

            <x-input-date name="dob" label="DOB" placeholder="DOB" :error="$errors->first('dob')" />
            <x-textarea label="Bio" name="bio" placeholder="Bio" :error="$errors->first('bio')" />
        </div>

        <div class="flex justify-between items-center p-2" x-cloak>
            <button wire:loading.attr="disabled" wire:click="decrementStep" type="button" x-show="currentStep > 1"
                class="px-3 py-2 bg-black text-white rounded-md hover:opacity-90 text-sm">Previous</button>
            <button wire:loading.attr="disabled" wire:click="incrementStep" type="button"
                x-show="currentStep < totalSteps"
                class="px-3 py-2 bg-black text-white rounded-md hover:opacity-90  text-sm">Next</button>
            <button wire:loading.attr="disabled" wire:click="submit" type="button"
                class="px-3 py-2 bg-black text-white rounded-md hover:opacity-90  text-sm"
                x-show="currentStep == totalSteps">Submit</button>
        </div>

    </div>

</div>
