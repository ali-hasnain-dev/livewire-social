<div>
    <div class="flex items-center gap-4">
        <img src="https://images.pexels.com/photos/11213182/pexels-photo-11213182.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load"
            alt="" class="w-8 h-8 rounded-full" />
        <div
            class="flex flex-1 items-center justify-center bg-sky-100 rounded-xl text-sm px-3 py-2 w-full dark:bg-slate-800 dark:border dark:border-slate-600">
            <input type="text" placeholder="Add a comment..." class="bg-transparent outline-none flex-1"
                wire:model='comment' />

            <svg x-cloak x-show='$wire.comment?.length > 0' wire:click='addComment' xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-4 cursor-pointer text-blue-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
            </svg>
        </div>
    </div>
    <div>
        <div class="flex flex-col gap-2 mt-6">
            @if (!empty($latestComments))
                @foreach ($latestComments as $comment)
                    <div class="flex gap-2">
                        <img src="{{ asset('images/avatar.png') }}" alt="" class="w-10 h-10 rounded-full">
                        <div class="flex flex-col">
                            <span class="font-semibold">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            <p class="text-sm mt-3">
                                {{ $comment->content }}
                            </p>
                            <div class="flex items-center gap-8 text-xs text-gray-500 mt-2">
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('images/like.png') }}" alt=""
                                        class="cursor-pointer w-4 h-4" />
                                    <span class="text-gray-300">|</span>
                                    <span class="text-gray-500">1235</span>
                                </div>
                                <div>Reply</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
