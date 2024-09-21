<div class="mt-24 flex items-center justify-center">
    <div class="flex flex-col gap-4 w-full md:w-[400px] bg-white p-8 rounded-md">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        <div class="mt-4 flex items-center justify-between">
            <button class="p-2 bg-blue-500 text-white rounded-md" wire:click="sendVerificationEmail">Resend Verification
                Email</button>
            <button wire:click="logout" type="submit"
                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                Logout
            </button>
        </div>
    </div>
</div>
