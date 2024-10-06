<div class="p-4 bg-white shadow-md rounded-lg flex gap-4 justify-between text-sm mb-4 dark:bg-slate-900">
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
                <img src="{{ asset('images/emoji.png') }}" alt="" class="w-5 h-5 cursor-pointer self-end" />
            </div>

            <div class="flex items-center gap-4 mt-4 justify-center text-gray-400 flex-wrap">
                <div class="flex items-center gap-2 cursor-pointer"
                    onclick="document.getElementById('selectedFile').click();">
                    <img src="{{ asset('images/addImage.png') }}" alt="" class="w-3 h-3"
                        type="images/png, images/jpeg, images/jpg, images/gif, images/webp" />
                    Photo

                    <input type="file" wire:model="photo" id='selectedFile' style="display: none">
                </div>
                <div class="flex items-center gap-2 cursor-pointer">
                    <img src="{{ asset('images/addVideo.png') }}" alt="" class="w-3 h-3" />
                    Video
                </div>
                <div class="flex items-center gap-2 cursor-pointer">
                    <img src="{{ asset('images/addEvent.png') }}" alt="" class="w-3 h-3" />
                    Event
                </div>
                <div class="flex items-center gap-2 cursor-pointer">
                    <img src="{{ asset('images/poll.png') }}" alt="" class="w-3 h-3" />
                    Poll
                </div>
            </div>

            <button wire:loading.attr='disabled' :disabled="!$wire.content || $wire.content.length === 0"
                :class="{
                    'cursor-not-allowed bg-gray-400': !$wire.content || $wire.content.length === 0,
                    'bg-blue-500': $wire.content?.length > 0
                }"
                x-cloak class="p-2 text-white rounded-md inline-block self-end mr-11" type="submit">
                <x-loader-button :message="'Post'" />
            </button>
        </form>
    </div>
</div>
