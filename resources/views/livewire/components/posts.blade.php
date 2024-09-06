<div class="flex flex-col gap-4">
    @foreach ($posts as $post)
        <div class="flex rounded-md bg-white p-4 gap-4 flex-col">
            <div class="flex justify-between ">
                <div class="flex items-center gap-4">
                    <img src="{{ $post->user->avatar ? $post->user->avatar : asset('images/noAvatar.png') }}"
                        alt="" class="w-10 h-10 rounded-full object-cover">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-semibold">{{ $post->user->name }}</span>
                        <span class="text-xs">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <span class="text-xs font-bold cursor-pointer">
                    <img src="{{ asset('images/more.png') }}" alt="" class="w-5">
                </span>
            </div>
            <p>{{ $post->content }}</p>
            <img src="{{ $post->image }}" alt="" class="w-full h-96">
        </div>
    @endforeach
</div>
