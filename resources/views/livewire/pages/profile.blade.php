<div class="flex gap-6 pt-6">
    <div class="hidden xl:block w-[25%]">
        <div class="flex flex-col gap-6">
            @if (!$userId)
                <livewire:components.user-card />
            @else
                <livewire:components.user-info-card />
            @endif
        </div>
    </div>
    <div class="w-full flex flex-col gap-4 md:w-[500px]">
        <!-- Cards: User -->
        <div class="flex flex-col overflow-hidden rounded-lg bg-white shadow-sm dark:bg-gray-800 dark:text-gray-100">
            <!-- Card Cover/Avatar -->
            <div class="mb-8 bg-cover"
                style="
      background-image: url(
      '{{ Auth::user()->cover ? asset(Auth::user()->cover) : asset('images/cover-placeholder.png') }}');
    ">
                <div class="flex h-32 items-end justify-center">
                    <div class="-mb-12 rounded-full bg-gray-200/50 p-2 dark:bg-gray-600/50">
                        <img src="{{ Auth::user()->profile ? asset(Auth::user()->profile) : asset('images/profile.png') }}"
                            alt="User Avatar" class="inline-block size-20 rounded-full" />
                    </div>
                </div>
            </div>
            <!-- END Card Cover/Avatar -->

            <!-- Card Body -->
            <div class="grow p-5 text-center">
                <h3 class="mb-1 mt-3 text-lg font-semibold">
                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}
                </h3>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                    Web Developer ∙ 12 Projects
                </p>
            </div>
            <!-- END Card Body -->
        </div>
        <!-- END Cards: User -->

        <div className="flex flex-col">
            @if ($userId == auth()->user()->id)
                <livewire:components.add-post />
            @endif
            <livewire:components.feed userId='{{ $userId }}' />
        </div>
    </div>
    <div class="hidden lg:block w-[30%]">
        {{-- <livewire:components.user-info-card /> --}}
    </div>
</div>
