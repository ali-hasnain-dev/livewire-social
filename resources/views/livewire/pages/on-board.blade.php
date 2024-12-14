<div class="flex flex-col gap-6 items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 p-4"
    x-data="{
        currentStep: @entangle('currentStep'),
        totalSteps: @entangle('totalSteps'),
        transitionDirection: 'right',
        updateTransition(direction) {
            this.transitionDirection = direction;
        }
    }">

    <!-- Step Indicator -->
    <div class="text-center">
        <p class="text-lg font-medium text-gray-700 dark:text-gray-300">
            Step <span x-text="currentStep"></span> of <span x-text="totalSteps"></span>
        </p>
    </div>

    <!-- Step Container -->
    <div class="relative w-full max-w-md bg-white dark:bg-slate-800 shadow-lg rounded-xl overflow-hidden">

        <!-- Steps Wrapper -->
        <div class="relative flex transition-transform duration-500 ease-in-out"
            :style="`transform: translateX(-${(currentStep - 1) * 100}%);`">

            <!-- Step 1 -->
            <div class="w-full shrink-0 p-6">
                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Setup General Info</h2>
                <div class="flex items-center justify-center mb-4">
                    <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="w-24 h-24 rounded-full border">
                </div>
                <div class="flex flex-col gap-4">
                    <x-input type="text" label="First Name" name="first_name" placeholder="First name"
                        required="true" :error="$errors->first('first_name')" />
                    <x-input type="text" label="Last Name" name="last_name" placeholder="Last name"
                        :error="$errors->first('last_name')" />
                    <x-input type="text" label="Phone" name="phone" placeholder="Phone" :error="$errors->first('phone')" />
                </div>
            </div>

            <!-- Step 2 -->
            <div class="w-full shrink-0 p-6">
                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Setup Personal Info</h2>
                <div class="flex flex-col gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Gender <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-4 mt-2">
                            <x-radio-button name="gender" label="Male" value="male" :error="$errors->first('gender')" />
                            <x-radio-button name="gender" label="Female" value="female" :error="$errors->first('gender')" />
                        </div>
                    </div>
                    <x-input-date name="dob" label="DOB" placeholder="DOB" required="true" :error="$errors->first('dob')" />
                    <x-textarea label="Bio" name="bio" placeholder="Bio" :error="$errors->first('bio')" />
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="flex justify-between w-full max-w-md mt-4" x-cloak>
        <button type="button" x-show="currentStep > 1" @click="updateTransition('left'); $wire.decrementStep()"
            class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">
            Previous
        </button>

        <button type="button" x-show="currentStep < totalSteps"
            @click="updateTransition('right'); $wire.incrementStep()"
            class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">
            Next
        </button>

        <button type="button" x-show="currentStep == totalSteps" @click="$wire.submit()"
            class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-500 transition duration-300">
            Submit
        </button>
    </div>
</div>
