<div class="flex rounded-md bg-white p-4 gap-4 flex-col dark:bg-slate-800">
    <div class="flex justify-between ">
        <a href="{{ route('profile', ['name' => $post->user->username]) }}" wire:navigate>
            <div class="flex items-center gap-2">
                <img src="{{ $post->user->avatar ? $post->user->avatar : asset('images/avatar.png') }}" alt=""
                    class="w-10 h-10 rounded-full object-cover">
                <div class="flex flex-col gap-1">
                    <span class="text-sm font-semibold">{{ $post->user->name }}</span>
                    <span class="text-xs font-normal">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </a>
        <span class="text-xs font-bold cursor-pointer">
            <img src="{{ asset('images/more.png') }}" alt="" class="w-5">
        </span>
    </div>

    @if ($post->content)
        <p class="text-sm">{{ $post->content }}</p>
    @endif

    @if (count($post->images) > 0)
        @if (count($post->images) > 1)
            <div class="w-[500px]">
                <div class="swiper h-[400px] bg-white dark:bg-slate-800 w-full rounded-md" x-init="new Swiper($el, {
                    modules: [Navigation, Pagination],
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                })">
                    <!-- Additional required wrapper -->
                    <div x-cloak class="swiper-wrapper">
                        @foreach ($post->images as $image)
                            <div class="swiper-slide">
                                @if (Str::startsWith($image->type, 'image'))
                                    <img src="{{ asset($image->url) }}" alt=""
                                        class="w-full block object-scale-down h-[400px] rounded-md">
                                @elseif (Str::startsWith($image->type, 'video'))
                                    <x-video :source="asset($image->url)" :type="$post->images[0]->type" />
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev absolute top-1/2 z-10 p-2 cursor-pointer">
                        <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.8" stroke="currentColor" class="size-4 hover:size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="swiper-button-next absolute right-0 top-1/2 z-10 p-2 cursor-pointer">
                        <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.8" stroke="currentColor" class="size-4 hover:size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </div>
                    </div>

                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
        @else
            @if (Str::startsWith($post->images[0]->type, 'image'))
                <img src="{{ asset($post->images[0]->url) }}" alt="" class="w-full h-auto rounded-md">
            @elseif (Str::startsWith($post->images[0]->type, 'video'))
                <x-video :source="asset($post->images[0]->url)" :type="$post->images[0]->type" />
            @endif

        @endif
    @endif

    <div class="flex items-center justify-between text-xs my-1">
        <div class="flex gap-2">
            <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xl dark:bg-slate-700" x-data="{ likesCount: @entangle('likes'), isLiked: @entangle('likedByme') }">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4 cursor-pointer" :class='isLiked ? "text-blue-500" : ""'
                    x-on:click="isLiked=!isLiked, isLiked? likesCount++ : likesCount-- ,$wire.like({{ $post->id }})">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                </svg>

                <span x-show="likesCount > 0" class="text-gray-300">|</span>
                <span x-show="likesCount > 0" class="text-gray-500">
                    <span class="text-gray-500" x-text="likesCount">
                    </span>
            </div>
            <div class="flex items-center gap-2 bg-slate-50 p-2 rounded-xl dark:bg-slate-700" x-data="{ commentCount: @entangle('comments') }">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                </svg>

                <span class="text-gray-300">|</span>
                <span class="text-gray-500" x-text="commentCount">
                </span>
            </div>
        </div>
        <div>
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
        </div>
    </div>
    <livewire:components.add-comment :post="$post" :key="'post-comment-' . $post->id" />
</div>
