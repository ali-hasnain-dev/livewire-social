<div x-data="{ activeTab: 1 }" class="flex items-center flex-col">
    <!-- Tabs Header - Positioned 10px below navbar -->
    <div class="flex border-b border-gray-300 mt-[10px]">
        <button @click="activeTab = 1"
            :class="{ 'border-blue-500 text-blue-500 font-semibold underline underline-offset-8': activeTab === 1 }"
            class="px-4 py-2 focus:outline-none">
            General
        </button>
        <button @click="activeTab = 2"
            :class="{ 'border-blue-500 text-blue-500 font-semibold underline': activeTab === 2 }"
            class="px-4 py-2 focus:outline-none">
            Password
        </button>
        <button @click="activeTab = 3"
            :class="{ 'border-blue-500 text-blue-500 font-semibold underline': activeTab === 3 }"
            class="px-4 py-2 focus:outline-none">
            Notifications
        </button>
    </div>

    <!-- Tabs Content - Positioned 15px below tab navbar -->
    <div class="py-4 h-[calc(100vh-98px)] items-center justify-center flex w-full">
        <div x-show="activeTab === 1" class="w-full md:w-[700px] bg-white p-4 rounded-lg shadow-md">
            <livewire:components.general-info />
        </div>
        <div x-show="activeTab === 2" class="w-[400px] bg-white p-4 rounded-lg shadow-md">
            <div class="flex flex-col gap-8">
                <h1 class="text-xl font-bold">Password</h1>
                <form action="">
                    <div class="flex flex-col gap-2">
                        <label for="" class="text-xs font-semibold">Current Password</label>
                        <input type="password" class="w-full p-2 border border-gray-500 rounded-md"
                            placeholder="Current password" wire:model="password" required>
                        <p class="text-red-500 text-xs">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="" class="text-xs font-semibold">New Password</label>
                        <input type="password" class="w-full p-2 border border-gray-500 rounded-md"
                            placeholder="New password" wire:model="password" required>
                        <p class="text-red-500 text-xs">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="" class="text-xs font-semibold">Confirm Password</label>
                        <input type="password" class="w-full p-2 border border-gray-500 rounded-md"
                            placeholder="Confirm password" wire:model="password" required>
                        <p class="text-red-500 text-xs">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="self-end">
                        <button class="p-2 bg-blue-500 text-white rounded-md self-end" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div x-show="activeTab === 3">
            <p>This is the content of Tab 3.</p>
        </div>
    </div>
</div>
