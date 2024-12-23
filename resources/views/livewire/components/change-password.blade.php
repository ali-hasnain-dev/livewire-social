<div class="flex flex-col gap-6 md:w-[550px]">
    <div class="flex flex-col gap-1">
        <h1 class="text-lg font-semibold dark:text-slate-400 text-slate-600">Password</h1>
        <span class="text-slate-500 text-xs">Reset your password</span>
    </div>

    <form wire:submit.prevent="updatePassword">
        @csrf
        <div class="flex flex-col gap-4 ">
            <x-input-text type="password" label="Current Password" name="current_password" placeholder="Current password"
                required='true' :error="$errors->first('old_password')" model="old_password" />

            <x-input-text type="password" label="New Password" name="new_password" placeholder="New password"
                required='true' :error="$errors->first('new_password')" model="new_password" />

            <x-input-text type="password" label="Confirm Password" name="confirm_password"
                placeholder="Confirm password" required='true' :error="$errors->first('confirm_password')" model="confirm_password" />

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
                <button class="p-2 text-sm bg-black text-white rounded-md self-start" type="submit"
                    wire:loading.remove>Update</button>
                <button wire:loading wire:target="updatePassword" wire:loading.attr="disabled"
                    class="p-2 text-sm bg-black text-white rounded-md self-start">
                    <x-button-loader message="Update" />
                </button>
                <p x-cloak x-show="showMessage" x-bind:class="fade ? 'opacity-100' : 'opacity-0'"
                    class="flex text-green-500 text-sm font-semibold">
                    Password updated successfully.
                </p>
            </div>
        </div>
    </form>
</div>
