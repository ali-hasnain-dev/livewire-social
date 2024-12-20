<div class="flex flex-col gap-6 md:w-[550px] ">
    <div class="flex flex-col gap-1">
        <h1 class="text-lg font-semibold dark:text-slate-400 text-slate-600">General Info</h1>
        <span class="text-slate-500 text-xs">Update your account's profile information</span>
    </div>

    <form wire:submit.prevent="updateGeneralProfile">
        @csrf
        <div class="md:flex justify-center items-center gap-24">
            <div class="flex flex-col gap-4 w-full">
                <x-input-text type="text" label="User Name" name="username" placeholder="User Name" required='true'
                    :error="$errors->first('username')" model="username" />

                <x-input-text type="text" label="First Name" name="first_name" placeholder="First Name"
                    required='true' :error="$errors->first('first_name')" model="first_name" />

                <x-input-text type="text" label="Last Name" name="last_name" placeholder="Last Name"
                    :error="$errors->first('last_name')" model="last_name" />

                <div>
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Gender <span
                            class="text-red-500">*</span></label>
                    <div class="flex gap-4 mt-2">
                        <x-radio-button name="gender" label="Male" value="male" :error="$errors->first('onBoardForm.gender')" model="gender" />
                        <x-radio-button name="gender" label="Female" value="female" :error="$errors->first('onBoardForm.gender')" model="gender" />
                    </div>
                    <div>
                        <p class="text-red-500 text-xs">
                            @if ($errors->first('onBoardForm.gender'))
                                {{ $errors->first('onBoardForm.gender') }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2" x-data="{
                    showMessage: @entangle('showMessage'),
                    fade: true,
                    interval: null
                }" x-init="$watch('showMessage', value => {
                    if (value) {
                        fade = true;
                        // Start fading in and out
                        interval = setInterval(() => fade = !fade, 1000); // Toggle every 1 second (fade in/out)
                        // Stop fading after 5 seconds and hide the message
                        setTimeout(() => {
                            clearInterval(interval); // Stop the fading
                            showMessage = false;
                        }, 6000); // 5 seconds duration
                    }
                })">
                    <button class="p-2 text-sm bg-black text-white rounded-lg self-start" wire:loading.remove
                        wire:target="updateGeneralProfile">
                        Save
                    </button>

                    <button wire:loading class="p-2 text-sm bg-black text-white rounded-lg self-start">
                        <x-button-loader message="Save" />
                    </button>

                    <p x-show="showMessage" x-bind:class="fade ? 'opacity-100' : 'opacity-0'"
                        class="flex text-green-500 text-sm font-semibold transition-opacity duration-1000">
                        Profile updated successfully
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>
