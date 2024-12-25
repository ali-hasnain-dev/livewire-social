<div class="flex justify-between">
    <a href="{{ route('profile', ['name' => $post->user->username]) }}" wire:navigate>
        <div class="flex items-center gap-2">
            <img src="{{ $post->user->avatar ? asset($post->user->avatar) : asset('images/avatar-placeholder.jpg') }}"
                alt="" class="w-10 h-10 rounded-full object-cover">
            <div class="flex flex-col gap-1">
                <span class="text-sm font-semibold" x-text="data.user.first_name + ' ' + data.user.last_name"></span>
                <span class="text-xs font-normal">{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </a>
    <span class="text-xs font-bold cursor-pointer">
        <img src="{{ asset('images/more.png') }}" alt="" class="w-5">
    </span>
</div>
