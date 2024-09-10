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
    <div class="py-4  items-center justify-center flex w-full" x-cloak>
        <div x-show="activeTab === 1" class="w-full md:w-[700px] bg-white p-4 rounded-lg shadow-md">
            <livewire:components.general-info />
        </div>
        <div x-show="activeTab === 2" class="w-full md:w-[550px] bg-white p-4 rounded-lg shadow-md">
            <livewire:components.change-password />
        </div>
        <div x-show="activeTab === 3">
            <p class="text-gray-500 font-semibold">Comming Soon Feature</p>
        </div>
    </div>
</div>
