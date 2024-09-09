<div class="flex flex-col gap-4 relative" wire:poll.180s='checkNewPost'>
    @if ($hasNewPosts)
        <div class="sticky top-20 w-full flex justify-center z-40">
            <p x-on:click="$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }))" wire:click='refreshPosts'
                class="text-center text-white bg-blue-500 font-semibold rounded-3xl border border-blue-500 inline-block px-2 py-1 cursor-pointer">
                New Posts</p>
        </div>
    @endif
    @if ($posts)
        @foreach ($posts as $post)
            <div class="flex rounded-md bg-white p-4 gap-2 flex-col" wire:key="post-{{ $post->id }}">
                <div class="flex justify-between ">
                    <div class="flex items-center gap-2">
                        <img src="{{ $post->user->avatar ? $post->user->avatar : asset('images/avatar.png') }}"
                            alt="" class="w-10 h-10 rounded-full object-cover">
                        <div class="flex flex-col gap-1">
                            <span class="text-sm font-semibold">{{ $post->user->name }}</span>
                            <span class="text-xs font-normal">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <span class="text-xs font-bold cursor-pointer">
                        <img src="{{ asset('images/more.png') }}" alt="" class="w-5">
                    </span>
                </div>
                <p class="text-sm">{{ $post->content }}</p>
                @if ($post->image)
                    <img src="{{ $post->image }}" alt="" class="w-full h-96">
                @endif
            </div>
        @endforeach

        @if ($hasMoreData)
            <div x-intersect.full="$wire.loadMore" class="flex justify-center mt-5 mb-5">
                <img src="{{ asset('images/loading.gif') }}" alt="" class="bg-gray-100">
            </div>
        @else
            <div class="flex justify-center mt-5 mb-5">
                <p class="text-center text-sm font-semibold">No more posts</p>
            </div>
        @endif
    @else
        <div class="flex justify-center mt-5 mb-5">
            <p class="text-center text-md font-semibold">No posts</p>
        </div>
    @endif
</div>
