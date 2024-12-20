<div class="flex flex-col gap-4 relative" {{ when(!$userId, 'wire:poll.180s.keep-alive=checkNewPost') }}>
    @if ($hasNewPosts)
        <div class="sticky top-20 w-full flex justify-center z-40 md:w-[500px]">
            <p x-on:click="$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }))" wire:click='refreshPosts'
                class="text-center text-white bg-blue-500 font-semibold rounded-3xl border border-blue-500 inline-block px-2 py-1 cursor-pointer">
                New Posts</p>
        </div>
    @endif

    @if ($posts)
        @foreach ($posts as $post)
            <livewire:components.post :$post :key="'post-' . $post->id" />
        @endforeach

        @if ($hasMoreData)
            <div x-intersect.full="$wire.loadMore" class="flex justify-center mt-5 mb-5">
                <div
                    class="w-6 h-6 rounded-full animate-spin border-4 border-dashed border-slate-700 dark:border-white border-t-transparent">
                </div>
            </div>
        @else
            <div class="flex justify-center mt-5 mb-5">
                <p class="text-center text-sm font-semibold">No more posts</p>
            </div>
        @endif
    @else
        <div class="flex justify-center mt-5 mb-5">
            <p class="text-center text-md font-semibold">No posts available</p>
        </div>
    @endif
</div>
