<div class="flex flex-col gap-6 items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900 p-4 h-[calc(100vh-98px)]"
    x-data="{
        currentStep: @entangle('onBoardForm.currentStep'),
        totalSteps: @entangle('onBoardForm.totalSteps'),
        transitionDirection: 'right',
        updateTransition(direction) {
            this.transitionDirection = direction;
            this.$nextTick(() => {
                const focusable = this.$el.querySelector(`[data-step='${this.currentStep}'] input`);
                if (focusable) focusable.focus();
            });
        },
        trapFocus(event) {
            const focusableElements = [
                ...this.$el.querySelectorAll(`[data-step='${this.currentStep}'] input, [data-step='${this.currentStep}'] button, [data-step='${this.currentStep}'] textarea`)
            ];
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];
    
            if (event.shiftKey && document.activeElement === firstElement) {
                event.preventDefault();
                lastElement.focus();
            } else if (!event.shiftKey && document.activeElement === lastElement) {
                event.preventDefault();
                firstElement.focus();
            }
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
            :style="`transform: translateX(-${(currentStep - 1) * 100}%);`" @keydown.tab.prevent="trapFocus($event)">

            <!-- Step 1 -->
            <div class="w-full shrink-0 p-6" data-step="1">
                <h2 class="text-md font-bold text-gray-800 dark:text-gray-200 mb-4">Setup General Info</h2>
                <div class="relative dark:bg-slate-800">
                    <!-- Cover Photo -->
                    <div class="relative w-full h-40">
                        <img src="{{ $onBoardForm->cover ? $onBoardForm->cover->temporaryUrl() : asset('images/cover-placeholder.png') }}"
                            class="rounded-md w-full h-full object-cover" />
                        <button onclick="document.getElementById('coverFile').click();"
                            class="absolute top-2 right-2 bg-gray-700 text-white p-1 rounded-full hover:bg-gray-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-7.036A2.5 2.5 0 1118 5.5v.001a2.5 2.5 0 01-1.768 2.415m-10.857 9.392l-1.768 5.303a1 1 0 001.22 1.22l5.303-1.768m-4.755-.952L20.768 7.232a2.5 2.5 0 00-3.536-3.536L6.88 14.879z" />
                            </svg>
                        </button>
                        <input type="file" name="" id="coverFile" wire:model='onBoardForm.cover' hidden>
                    </div>
                    <!-- Profile Photo -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -bottom-6">
                        <img src="{{ $onBoardForm->profile ? $onBoardForm->profile->temporaryUrl() : asset('images/avatar-placeholder.jpg') }}"
                            class="rounded-full object-cover w-24 h-24 z-10" />
                        <button onclick="document.getElementById('profileFile').click();"
                            class="absolute bottom-2 right-2 bg-gray-700 text-white p-1 rounded-full hover:bg-gray-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-7.036A2.5 2.5 0 1118 5.5v.001a2.5 2.5 0 01-1.768 2.415m-10.857 9.392l-1.768 5.303a1 1 0 001.22 1.22l5.303-1.768m-4.755-.952L20.768 7.232a2.5 2.5 0 00-3.536-3.536L6.88 14.879z" />
                            </svg>
                            <input type="file" name="" id="profileFile" wire:model='onBoardForm.profile'
                                hidden>
                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-4 mt-12">
                    <x-input-text type="text" label="First Name" name="first_name" placeholder="First name"
                        required="true" :error="$errors->first('onBoardForm.first_name')" model="onBoardForm.first_name" />
                    <x-input-text type="text" label="Last Name" name="last_name" placeholder="Last name"
                        :error="$errors->first('onBoardForm.last_name')" model="onBoardForm.last_name" />
                    <x-input-text type="text" label="Phone" name="phone" placeholder="Phone" :error="$errors->first('onBoardForm.phone')"
                        model="onBoardForm.phone" />
                </div>
            </div>

            <!-- Step 2 -->
            <div class="w-full shrink-0 p-6" data-step="2">
                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Setup Personal Info</h2>
                <div class="flex flex-col gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Gender <span
                                class="text-red-500">*</span></label>
                        <div class="flex gap-4 mt-2">
                            <x-radio-button name="gender" label="Male" value="male" :error="$errors->first('onBoardForm.gender')"
                                model="onBoardForm.gender" />
                            <x-radio-button name="gender" label="Female" value="female" :error="$errors->first('onBoardForm.gender')"
                                model="onBoardForm.gender" />
                        </div>
                        <div>
                            <p class="text-red-500 text-xs">
                                @if ($errors->first('onBoardForm.gender'))
                                    {{ $errors->first('onBoardForm.gender') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-xs font-semibold" for="datepicker-autohide">DOB
                            <span class="text-red-500">*</span>
                        </label>
                        <input x-init="flatpickr($el, {
                            maxDate: new Date(new Date().setFullYear(new Date().getFullYear() - 13)),
                            onChange: function(selectedDates, dateStr) {
                                // Emit the date change to Livewire
                                $wire.set('onBoardForm.dob', dateStr);
                            }
                        });" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select DOB" wire:model.defer="onBoardForm.dob" wire:ignore>
                        <p class="text-red-500 text-xs">
                            @error('onBoardForm.dob')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <x-textarea label="Bio" name="bio" placeholder="Bio" :error="$errors->first('onBoardForm.bio')"
                        model="onBoardForm.bio" />
                </div>
            </div>
        </div>
        <!-- Navigation Buttons -->
        <div class="flex justify-between w-full max-w-md p-6" x-cloak>
            <button wire:loading.attr="disabled" type="button" x-show="currentStep > 1"
                @click="updateTransition('left'); $wire.decrementStep()"
                class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">
                Previous
            </button>

            <div class="ml-auto">
                <button wire:loading.remove
                    wire:target='onBoardForm.incrementStep, onBoardForm.cover, onBoardForm.profile, incrementStep'
                    type="button" x-show="currentStep < totalSteps"
                    @click="updateTransition('right'); $wire.incrementStep()"
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">
                    Next
                </button>

                <button wire:loading wire:target='incrementStep'
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300">
                    <x-button-loader message="" />
                </button>

                <button wire:loading wire:target='onBoardForm.cover'
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300"
                    :disabled="true">
                    <x-button-loader message="Cover image" />
                </button>

                <button wire:loading wire:target='onBoardForm.profile'
                    class="px-4 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-600 transition duration-300"
                    :disabled="true">
                    <x-button-loader message="Profile image" />
                </button>

                <button wire:loading.remove
                    wire:target='onBoardForm.incrementStep, onBoardForm.cover, onBoardForm.profile, submit'
                    type="button" x-show="currentStep == totalSteps" @click="$wire.submit()"
                    class="px-4 py-2 bg-black text-white rounded-lg shadow transition duration-300">
                    Submit
                </button>

                <button wire:loading wire:target='submit'
                    class="px-4 py-2 bg-black text-white rounded-lg shadow transition duration-300"
                    :disabled="true">
                    <x-button-loader message="Submit" />
                </button>

            </div>
        </div>
    </div>
</div>
