<div class="flex gap-6 pt-6">
    <div class="hidden xl:block w-[25%]">
        <div class="flex flex-col gap-6">
            <livewire:components.user-card />
        </div>
    </div>
    <div class=" lg:w-[50%] xl:w-[65%]">
        <div className="flex flex-col">
            @if ($userId == auth()->user()->id)
                <livewire:components.add-post />
            @endif
            <livewire:components.feed userId='{{ $userId }}' />
        </div>
    </div>
    <div class="hidden lg:block w-[30%]">
        <livewire:components.user-info-card />
    </div>
</div>
