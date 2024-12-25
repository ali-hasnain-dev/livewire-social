<div class="flex rounded-md bg-white p-4 gap-4 flex-col dark:bg-slate-800 w-full" x-data="{
    data: @entangle('data'),
    isTruncated: true
}">

    <x-user-avatar-div :post="$post" />

    <x-content :post="$post" />

    <template x-if="data.images.length > 0">
        <template x-if="data.images.length > 1">
            <x-multiple-files />
        </template>
    </template>

    <template x-if="data.images.length === 1">
        <x-single-file />
    </template>

    <div class="flex items-center justify-between text-xs my-1">
        <div class="flex gap-2">
            <template x-if="data.allow_likes">
                <x-like-component :post="$post" :likedByme="$likedByme" />
            </template>

            <x-comment-count />
        </div>
        {{-- <div>
            <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xl dark:bg-slate-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                </svg>

                <span class="text-gray-300">|</span>
                <span class="text-gray-500">
                    125
                </span>
            </div>
        </div> --}}
    </div>

    <template x-if="data.allow_comments">
        <livewire:components.add-comment :post="$post" :key="'post-comment-' . $post->id" />
    </template>
</div>
