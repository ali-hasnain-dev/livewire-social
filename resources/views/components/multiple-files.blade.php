<div class="w-full self-center" wire:ignore>
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
        <div class="swiper-wrapper">
            <!-- Generate slides using x-for -->
            <template x-for="image in data.images" :key="image.id">
                <div class="swiper-slide">
                    <!-- Conditionally render images or videos -->
                    <template x-if="image.type.startsWith('image')">
                        <img :src="image.url" alt="Image"
                            class="w-full block object-scale-down h-auto rounded-md">
                    </template>
                    <template x-if="image.type.startsWith('video')">
                        <video :src="image.url" controls class="w-full rounded-md"></video>
                    </template>
                </div>
            </template>
        </div>

        <!-- Swiper pagination and navigation -->
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev absolute top-1/2 z-10 p-2 cursor-pointer">
            <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8"
                    stroke="currentColor" class="size-4 hover:size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </div>
        </div>
        <div class="swiper-button-next absolute right-0 top-1/2 z-10 p-2 cursor-pointer">
            <div class="bg-white/95 border p-1 rounded-full text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8"
                    stroke="currentColor" class="size-4 hover:size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </div>
        </div>

        <div class="swiper-scrollbar"></div>
    </div>
</div>
