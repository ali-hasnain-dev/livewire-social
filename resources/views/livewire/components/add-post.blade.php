<div class="p-1 bg-slate-100 rounded-lg flex gap-2 justify-between text-sm mb-4 dark:bg-slate-900"
    x-data="{ newPost: false }">
    <img src="{{ asset('images/avatar.png') }}" alt="" width={48} class="w-10 h-10 object-cover rounded-full" />
    <button class="border border-gray-300 dark:border-gray-700 hover:bg-gray-50 w-full rounded-lg text-start p-2 h-10"
        @click="newPost=true">Write new
        post
    </button>

    @teleport('body')
        <div x-show="newPost" class="fixed top-20 left-0 z-[99] flex items-start justify-center w-screen h-screen"
            wire:ignore.self>
            <div x-show="newPost" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute inset-0 w-full h-full bg-white backdrop-blur-sm bg-opacity-70"></div>
            <div x-show="newPost" x-trap.inert.noscroll="newPost" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 sm:scale-95"
                class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-3xl sm:rounded-lg">
                <div class="flex items-center justify-between pb-3 p-2">
                    <h3 class="text-lg font-semibold">New Post</h3>
                    <button @click="newPost=false"
                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="relative flex w-auto h-[400px] pb-8">
                    <div class="w-1/2 p-2">

                        <div
                            class="flex border border-dashed border-gray-300 h-full rounded-md items-center justify-center">
                            @if (count($files) > 0)
                                <div class="flex justify-center gap-2 flex-wrap">
                                    @foreach ($files as $index => $image)
                                        <div class="relative">
                                            <img src="{{ $image->temporaryUrl() }}" alt=""
                                                class="h-24 w-24 rounded-md">
                                            <!-- Cross Icon -->
                                            <button wire:click="removeImage({{ $index }})"
                                                class="absolute top-0 right-0 p-1 text-red-500 hover:text-red-700"
                                                type="button">
                                                &#10005; <!-- HTML code for the cross icon -->
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center gap-1 cursor-pointer"
                                    onclick="document.getElementById('selectedFile').click();">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-10 ">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                    </svg>
                                    <p class="text-sm  font-semibold">Upload Media</p>

                                    <input type="file" wire:model="files" id="selectedFile" style="display: none"
                                        accept="image/png, image/jpeg, image/jpg, image/webp, video/mp4, video/webm, video/ogg"
                                        multiple
                                        onchange="if(this.files.length > 10) { alert('You can only upload a maximum of 10 files'); this.value = ''; }">
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- Dark vertical line with full height -->
                    <div class="w-1/2 p-2 0 h-full">
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-2 " x-data="{ content: @entangle('content') }">
                                <textarea placeholder="What's on your mind?"
                                    class="flex-1 bg-slate-100 rounded-lg p-2 outline-none dark:text-white dark:bg-slate-800 dark:border dark:border-slate-600"
                                    wire:model='content' id="" rows="6" maxlength="1000" style="resize: none;"></textarea>
                                <div class="flex self-end mr-4">
                                    <p x-text="content ? content.length + '/1000' : '0/1000'"
                                        class="text-xs font-bold dark:text-white">
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-600 font-semibold">Turn off likes?</p>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model='offLikes' class="sr-only peer">
                                    <div
                                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>

                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-600 font-semibold">Turn off comments?</p>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model='offComments' class="sr-only peer">
                                    <div
                                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-600 font-semibold">Turn off share?</p>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model='offShares' class="sr-only peer">
                                    <div
                                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                    <button @click="newPost=false" type="button"
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2">Cancel</button>
                    <button wire:loading.attr="disabled" wire:click="addPost" type="button"
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">Post</button>
                </div>
            </div>
        </div>
    @endteleport
</div>
