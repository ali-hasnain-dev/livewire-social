<div class="flex rounded-md bg-white p-4 gap-2 flex-col">
    <div class="flex justify-between ">
        <div class="flex items-center gap-2">
            <img src="{{ $post->user->avatar ? $post->user->avatar : asset('images/avatar.png') }}" alt=""
                class="w-10 h-10 rounded-full object-cover">
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
