<div class="text-sm">
    <p>
        <!-- Truncated Content -->
        <template x-if="isTruncated">
            <span x-text="data.content.slice(0, 130) + (data.content.length > 130 ? '...' : '')"></span>
        </template>

        <!-- Full Content with Transition -->
        <template x-if="!isTruncated">
            <span x-transition:enter="transition-all ease-in-out duration-500 transform opacity-0 -translate-y-2"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition-all ease-in-out duration-500 transform opacity-0 translate-y-2"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                x-text="data.content"></span>
        </template>

        <!-- Button -->
        <button x-show="data.content.length > 130" @click="isTruncated = !isTruncated"
            class="text-blue-500 underline whitespace-nowrap ml-1">
            <span class="text-xs" x-text="isTruncated ? 'See More' : 'See Less'"></span>
        </button>
    </p>
</div>
