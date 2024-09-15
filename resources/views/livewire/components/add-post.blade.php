<div class="p-4 bg-white shadow-md rounded-lg flex gap-4 justify-between text-sm mb-4">
    <img src="{{ asset('images/avatar.png') }}" alt="" width={48} class="w-12 h-12 object-cover rounded-full" />
    <div class="flex-1">
        <form wire:submit.prevent="addPost" class="flex flex-col gap-3">
            <div class="flex gap-4">
                <textarea placeholder="What's on your mind?" class="flex-1 bg-slate-100 rounded-lg p-2 outline-none" wire:model='content'
                    rows="5" id="auto-resizing-textarea" style="overflow-y: hidden; resize: none;"></textarea>
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

            <button x-show='$wire.content?.length >0' x-cloak
                class="p-2 bg-blue-500 text-white rounded-md inline-block self-end mr-11" type="submit"
                wire:loading.remove>Post</button>
            <button wire:loading
                class="rounded-md inline-block self-end mr-11 text-blue-500 font-semibold p-2 border border-blue-500"
                disabled>
                <x-loader-button :message="'Posting...'" />
            </button>
        </form>
    </div>
</div>
