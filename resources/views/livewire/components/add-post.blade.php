<div class="p-1 bg-slate-100 rounded-lg flex gap-2 justify-between text-sm mb-4 dark:bg-slate-900"
    x-data="{ newPost: @entangle('newPost'), content: @entangle('content'), files: @entangle('files'), uploadedFiles: @entangle('uploadedFiles'), newFile: @entangle('newFile'), turnOffLikes: @entangle('turnOffLikes'), turnOffComments: @entangle('turnOffComments') }">
    <img src="{{ asset('images/avatar.png') }}" alt="" width={48} class="w-10 h-10 object-cover rounded-full" />
    <button
        class="border border-gray-300 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-800 w-full rounded-lg text-start p-2 h-10"
        @click="newPost=true">What's on your mind?
    </button>

    @teleport('body')
        <div x-show="newPost" class="fixed inset-0 z-[99] flex items-center justify-center w-screen h-screen"
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
                class="relative w-full py-6 bg-white border shadow-lg px-7 border-neutral-200 sm:max-w-3xl sm:rounded-lg dark:bg-slate-800">
                <div class="flex items-center justify-between pb-3 p-2">
                    <h3 class="text-md font-semibold">Create post</h3>
                    <button
                        @click="newPost=false, content='', files=[], uploadedFiles=[], turnOffLikes=true, turnOffComments=true"
                        class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full hover:text-gray-800 dark:hover:bg-gray-700 hover:bg-gray-50">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="relative flex w-auto h-[400px] pb-8">
                    <div class="w-1/2 p-2">
                        <div :class="files.length > 0 ? 'border border-gray-300' : 'border border-dashed border-gray-300'"
                            class="flex  h-full rounded-md items-center justify-center">
                            <div class="flex justify-center gap-2 flex-wrap" x-show="files.length > 0">
                                <template x-for="(file, index) in files" :key="index">
                                    <div class="relative">
                                        <img :src="file.url" alt="Image" class="h-24 w-24 rounded-md">
                                        <button @click="$wire.removeImage(index)" wire:key="index"
                                            class="absolute top-0 right-0 p-1 w-8 h-8 text-red-500 hover:text-red-700"
                                            type="button">
                                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <div x-show="files.length < 9"
                                    class="flex flex-col items-center justify-center gap-1 rounded-md cursor-pointer border border-dashed border-gray-300"
                                    onclick="document.getElementById('newSelectedFile').click();">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-20 w-24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                    <input type="file" wire:model="newFile" id="newSelectedFile" style="display: none"
                                        accept="image/png, image/jpeg, image/jpg, image/webp, video/mp4, video/webm, video/ogg">
                                </div>
                            </div>

                            <div x-show="files.length==0"
                                class="flex flex-col items-center justify-center gap-1 cursor-pointer"
                                onclick="document.getElementById('selectedFile').click();">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-10 ">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                                </svg>
                                <p class="text-sm font-semibold" wire:loading.remove wire:target='files'>Upload Media
                                </p>
                                <p class="text-sm font-semibold" wire:loading wire:target='files'>Uploading...</p>

                                <input type="file" wire:model="files" id="selectedFile" style="display: none"
                                    accept="image/png, image/jpeg, image/jpg, image/webp, video/mp4, video/webm, video/ogg"
                                    multiple
                                    onchange="if(this.files.length > 10) { alert('You can only upload a maximum of 10 files'); this.value = ''; }">
                            </div>
                        </div>
                    </div>

                    <div class="w-1/2 p-2 0 h-full">
                        <div class="flex flex-col gap-6">
                            <div class="flex flex-col gap-2" x-data="{ content: @entangle('content') }">
                                <textarea placeholder="What's on your mind?"
                                    class="flex-1 rounded-lg p-2 outline-none dark:text-white dark:bg-slate-800  dark:border-slate-600"
                                    wire:model='content' id="" rows="6" maxlength="1000" style="resize: none;"></textarea>
                                <div class="flex self-end mr-4">
                                    <p x-text="content ? content.length + '/1000' : '0/1000'"
                                        class="text-xs font-bold dark:text-white">
                                    </p>
                                </div>
                                <hr>
                            </div>

                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-600 dark:text-gray-300 font-semibold">Turn off likes?</p>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model='turnOffLikes' class="sr-only peer">
                                    <div
                                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-neutral-950">
                                    </div>
                                </label>
                            </div>

                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-600 font-semibold dark:text-gray-300">Turn off comments?</p>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" wire:model='turnOffComments' class="sr-only peer">
                                    <div
                                        class="relative w-9 h-5 bg-gray-200 peer-focus:outline-none  rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-neutral-950">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-2">
                    @error('files.*')
                        <span class="text-xs text-red-500 items-start text-center">{{ $message }}</span>
                    @enderror
                    <button wire:loading.remove wire:target="addPost, files, removeImage" type="button"
                        wire:click='addPost'
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900"
                        :disabled="!content && files.length === 0">
                        Post
                    </button>

                    <button wire:loading wire:target='addPost'
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900">
                        <x-button-loader message="Post" />
                    </button>

                    <button wire:loading wire:target='files'
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900"
                        :disabled="true">
                        <x-button-loader message="Uploading files" />
                    </button>

                    <button wire:loading wire:target='removeImage'
                        class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-900 focus:ring-offset-2 bg-neutral-950 hover:bg-neutral-900"
                        :disabled="true">
                        <x-button-loader message="Removing file" />
                    </button>
                </div>
            </div>
        </div>
    @endteleport
</div>
