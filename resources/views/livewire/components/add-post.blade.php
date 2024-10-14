<div class="p-4 bg-white shadow-md rounded-lg flex gap-6 justify-between text-sm mb-4 dark:bg-slate-900">
    <img src="{{ asset('images/avatar.png') }}" alt="" width={48} class="w-12 h-12 object-cover rounded-full" />
    <div class="flex-1" x-init="$('documnet').ready(function() {
        var emojiArea = $('#emojionearea1').emojioneArea({
            pickerPosition: 'right',
            tonesStyle: 'bullet',
            events: {
                keyup: function(editor, event) {
                    $wire.content = this.getText();
                },
                emojibtn_click: function(button, event) {
                    $wire.content = this.getText();
                }
            }
        });

        Livewire.on('new-post-created', function() {
            emojiArea[0].emojioneArea.setText('');
        });
    })">
        <form wire:submit.prevent="addPost" class="flex flex-col gap-3">
            <div class="flex gap-4" wire:ignore>
                <textarea placeholder="What's on your mind?"
                    class="flex-1 bg-slate-100 rounded-lg p-2 outline-none dark:text-white dark:bg-slate-800 dark:border dark:border-slate-600"
                    wire:model='content' id="emojionearea1" rows="5" style="overflow-y: hidden; resize: none;"></textarea>
            </div>
            @if ($images)
                <div class="flex gap-2 flex-wrap">
                    @foreach ($images as $index => $image)
                        <div class="relative">
                            <img src="{{ $image->temporaryUrl() }}" alt="" class="h-20 w-20 rounded-md">
                            <!-- Cross Icon -->
                            <button wire:click="removeImage({{ $index }})"
                                class="absolute top-0 right-0 p-1 text-red-500 hover:text-red-700" type="button">
                                &#10005; <!-- HTML code for the cross icon -->
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            @error('images.*')
                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
            @endError

            <div class="flex gap-2 items-end justify-end mt-4">
                <div class="flex items-center gap-2 cursor-pointer"
                    onclick="document.getElementById('selectedFile').click();">
                    <div x-data="{
                        tooltipVisible: false,
                        tooltipText: 'Add Media',
                        tooltipArrow: true,
                        tooltipPosition: 'top',
                    }" x-init="$refs.content.addEventListener('mouseenter', () => { tooltipVisible = true; });
                    $refs.content.addEventListener('mouseleave', () => { tooltipVisible = false; });" class="relative">
                        <div x-ref="tooltip" x-show="tooltipVisible"
                            :class="{
                                'top-0 left-1/2 -translate-x-1/2 -mt-0.5 -translate-y-full': tooltipPosition ==
                                    'top',
                                'top-1/2 -translate-y-1/2 -ml-0.5 left-0 -translate-x-full': tooltipPosition ==
                                    'left',
                                'bottom-0 left-1/2 -translate-x-1/2 -mb-0.5 translate-y-full': tooltipPosition ==
                                    'bottom',
                                'top-1/2 -translate-y-1/2 -mr-0.5 right-0 translate-x-full': tooltipPosition ==
                                    'right'
                            }"
                            class="absolute w-auto text-sm" x-cloak>
                            <div x-show="tooltipVisible" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 scale-90 -translate-x-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 scale-100 translate-x-0"
                                x-transition:leave-end="opacity-0 scale-90 -translate-x-2"
                                class="relative px-2 py-1 text-white rounded bg-gradient-to-t from-blue-600 to-purple-600 bg-opacity-90">
                                <p x-text="tooltipText" class="flex-shrink-0 block text-xs whitespace-nowrap"></p>
                                <div x-ref="tooltipArrow" x-show="tooltipArrow"
                                    :class="{
                                        'bottom-0 -translate-x-1/2 left-1/2 w-2.5 translate-y-full': tooltipPosition ==
                                            'top',
                                        'right-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px translate-x-full': tooltipPosition ==
                                            'left',
                                        'top-0 -translate-x-1/2 left-1/2 w-2.5 -translate-y-full': tooltipPosition ==
                                            'bottom',
                                        'left-0 -translate-y-1/2 top-1/2 h-2.5 -mt-px -translate-x-full': tooltipPosition ==
                                            'right'
                                    }"
                                    class="absolute inline-flex items-center justify-center overflow-hidden">
                                    <div :class="{
                                        'origin-top-left -rotate-45': tooltipPosition ==
                                            'top',
                                        'origin-top-left rotate-45': tooltipPosition ==
                                            'left',
                                        'origin-bottom-left rotate-45': tooltipPosition ==
                                            'bottom',
                                        'origin-top-right -rotate-45': tooltipPosition == 'right'
                                    }"
                                        class="w-1.5 h-1.5 transform bg-indigo-600 bg-opacity-90"></div>
                                </div>
                            </div>
                        </div>
                        <svg x-ref="content" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="size-6 text-indigo-600 hover:text-indigo-800 ">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>

                    <input type="file" wire:model="images" id='selectedFile' style="display: none"
                        type="images/png, images/jpeg, images/jpg, images/webp" multiple>
                </div>

                <button wire:loading.attr='disabled'
                    :disabled="(!$wire.content || $wire.content.length === 0) && (!$wire.images || $wire.images.length === 0)"
                    :class="{
                        'cursor-not-allowed bg-gray-400': (!$wire.content || $wire.content.length === 0) && (!$wire
                            .images || $wire.images.length === 0),
                        'bg-blue-500': ($wire.content?.length > 0 || ($wire.images && $wire.images.length > 0))
                    }"
                    x-cloak class="p-2 text-white rounded-md inline-block self-end " type="submit">
                    <x-button-loader message="Post" />
                </button>
            </div>
        </form>
    </div>
</div>
