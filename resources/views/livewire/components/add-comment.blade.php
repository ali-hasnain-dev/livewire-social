<div>
    <div class="flex items-center gap-4">
        <img src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('images/avatar-placeholder.jpg') }}"
            alt="" class="w-8 h-8 rounded-full object-cover" />
        <div
            class="flex flex-1 items-center justify-center bg-sky-100 rounded-xl text-sm px-3 py-2 w-full dark:bg-slate-800 dark:border dark:border-slate-600">
            <input type="text" placeholder="Add a comment..." class="bg-transparent outline-none flex-1"
                wire:model='comment' />

            <svg wire:loading.remove x-cloak x-show='$wire.comment?.length > 0' wire:click='addComment'
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4 cursor-pointer text-blue-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>

            <button wire:loading class="size-4 cursor-pointer text-blue-500" type="submit"
                wire:loading.attr="disabled">
                <x-button-loader message="" />
            </button>
        </div>
    </div>
    <div>
        @if ($latestComment)
            <div class="flex flex-col gap-2 mt-6" x-data="{ data: @entangle('data') }">
                <div class="flex gap-4">
                    <img src="{{ $latestComment->user->avatar ? asset($latestComment->user->avatar) : asset('images/avatar-placeholder.jpg') }}"
                        alt="" class="w-8 h-8 rounded-full">
                    <div class="flex flex-col">
                        <span class="font-semibold text-xs"
                            x-text="data.user.first_name + ' ' + data.user.last_name"></span>
                        <span class="text-xs text-gray-500">{{ $latestComment->created_at->diffForHumans() }}</span>
                        <p class="text-sm mt-3" x-text="data.content"></p>
                        <div class="flex items-center gap-8 text-xs text-gray-500 mt-2">
                            <div class="flex items-center gap-1.5" x-data="{ isLiked: @entangle('likedByme'), likes: @entangle('likesCount') }">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4 cursor-pointer"
                                    :class='isLiked ? "text-blue-500" : ""'
                                    x-on:click="isLiked=!isLiked, isLiked ? likes++ : likes--,$wire.likeComment({{ $latestComment->id }}) ">
                                    <path stroke-linecap="round" stroke-linejoin="round" d=" M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384
                1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0
                1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054
                1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483
                0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904
                18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0
                1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958
                8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                </svg>
                                <span x-show="likes > 0" class="text-gray-300">|</span>
                                <span x-show="likes > 0" class="text-gray-500">
                                    <span class="text-gray-500" x-text="likes">
                                    </span>
                            </div>
                            <div>Reply</div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
