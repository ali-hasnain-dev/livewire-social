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
    
        {{-- Livewire.on('new-post-created', function() {
            emojiArea[0].emojioneArea.setText('');
        }); --}}
    })">
        <form wire:submit.prevent="addPost" class="flex flex-col gap-3">
            <div class="flex flex-col gap-2 relative" wire:ignore x-data="{ content: @entangle('content') }">
                <textarea placeholder="What's on your mind?"
                    class="flex-1 bg-slate-100 rounded-lg p-2 outline-none dark:text-white dark:bg-slate-800 dark:border dark:border-slate-600"
                    wire:model='content' id="" rows="8" maxlength="1000" style="overflow-y: hidden; resize: none;"></textarea>

                <!-- SVG icon positioned at the bottom-left corner of the textarea -->
                <svg x-cloak xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 absolute left-2 bottom-6 text-indigo-600 dark:text-white cursor-pointer"
                    onclick="document.getElementById('selectedFile').click();">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M2.25 18.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <input type="file" wire:model="files" id="selectedFile" style="display: none"
                    accept="image/png, image/jpeg, image/jpg, image/webp, video/mp4, video/webm, video/ogg" multiple
                    onchange="if(this.files.length > 10) { alert('You can only upload a maximum of 10 files'); this.value = ''; }">
                <div class="flex self-end mr-4">
                    <p x-text="content ? content.length + '/1000' : '0/1000'" class="text-xs font-bold dark:text-white">
                    </p>
                </div>
            </div>

            @if ($files)
                <div class="flex gap-2 flex-wrap">
                    @foreach ($files as $index => $image)
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

            @error('files.*')
                <span class="text-red-500 font-bold text-xs">{{ $message }}</span>
            @endError

            <div class="flex gap-2 items-end justify-end mt-4">
                <button wire:loading.attr='disabled'
                    :disabled="(!$wire.content || $wire.content.length === 0) && (!$wire.files || $wire.files.length === 0)"
                    :class="{
                        'cursor-not-allowed bg-gray-400': (!$wire.content || $wire.content.length === 0) && (!$wire
                            .files || $wire.files.length === 0),
                        'bg-blue-500': ($wire.content?.length > 0 || ($wire.files && $wire.files.length > 0))
                    }"
                    x-cloak class="p-2 text-white rounded-md inline-block self-end " type="submit">
                    <x-button-loader message="Post" />
                </button>
            </div>
        </form>
    </div>
</div>
