<div x-data="{ data: @entangle('data') }" x-init="console.log(data)" class="flex justify-center mt-6">
    <div class="w-[550px] px-4 py-6 shadow-md rounded-md bg-white dark:bg-slate-800 dark:text-white">
        <!-- Post Header: User Info and Post Time -->
        <div class="flex justify-between mb-4">
            <!-- User Info -->
            <a href="{{ route('profile', ['name' => $post->user->username]) }}" wire:navigate>
                <div class="flex items-center gap-2">
                    <img :src="data.user.avatar ? data.user.avatar : asset('images/avatar-placeholder.jpg')
                    '"
                        alt="User Avatar" class="w-10 h-10 rounded-full object-cover">
                    <div class="flex flex-col gap-1">
                        <span class="text-sm font-semibold"
                            x-text="data.user.first_name + ' ' + data.user.last_name"></span>
                        <span class="text-xs font-normal"
                            x-text="data.created_at ? new Date(data.created_at).toLocaleString() : ''"></span>
                    </div>
                </div>
            </a>

            <!-- More Options (button) -->
            <span class="text-xs font-bold cursor-pointer">
                <img src="{{ asset('images/more.png') }}" alt="More Options" class="w-5">
            </span>
        </div>

        <!-- Post Content -->
        <div class="mb-4">
            <p class="text-lg font-semibold" x-text="data.title"></p>
            <p class="text-sm mt-2" x-text="data.content"></p>
        </div>

        <!-- Likes Section -->
        <div class="flex items-center gap-2 text-sm">
            <span x-text="data.likes_count + ' likes'"></span>
            <button @click="toggleLike" class="text-blue-500 hover:underline">
                <span x-text="data.is_liked ? 'Unlike' : 'Like'"></span>
            </button>
        </div>

        <!-- Comments Section -->
        <div class="mt-4">
            <p class="font-semibold">Comments</p>
            <div x-show="data.comments.length > 0" class="mt-2">
                <template x-for="comment in data.comments" :key="comment.id">
                    <div class="flex gap-2 mb-2">
                        <img :src="comment.user.avatar ? comment.user.avatar : '{{ asset('images/avatar-placeholder.jpg') }}'"
                            alt="User Avatar" class="w-8 h-8 rounded-full object-cover">
                        <div class="flex flex-col gap-1">
                            <span x-text="comment.user.first_name + ' ' + comment.user.last_name"></span>
                            <span x-text="comment.content"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleLike() {
        // Implement your like/unlike logic here
        this.data.is_liked = !this.data.is_liked;
        this.data.likes_count += this.data.is_liked ? 1 : -1;
    }
</script>
