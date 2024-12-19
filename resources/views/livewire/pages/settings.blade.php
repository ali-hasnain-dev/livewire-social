<div x-data="{ activeTab: 1 }" class="flex items-center flex-col dark:bg-slate-900">
    <!-- Tabs Header - Positioned 10px below navbar -->
    <div class="flex border-b border-gray-300 mt-[10px]">
        <button @click="activeTab = 1" :class="{ ' font-semibold underline underline-offset-[15px]': activeTab === 1 }"
            class="px-4 py-2 focus:outline-none border-b-2 border-transparent">
            General
        </button>
        <button @click="activeTab = 2" :class="{ 'font-semibold underline underline-offset-[15px]': activeTab === 2 }"
            class="px-4 py-2 focus:outline-none border-b-2 border-transparent">
            Password
        </button>
        <button @click="activeTab = 3" :class="{ 'font-semibold underline underline-offset-[15px]': activeTab === 3 }"
            class="px-4 py-2 focus:outline-none border-b-2 border-transparent">
            Notifications
        </button>
    </div>

    <!-- Tabs Content - Positioned 15px below tab navbar -->
    <div class="py-4  items-center justify-center flex w-full" x-cloak>
        <div x-show="activeTab === 1" class="w-full flex flex-col gap-8 items-center">
            <livewire:components.general-info />
            <livewire:components.about-info />
            <livewire:components.change-password />

        </div>
        <div x-show="activeTab === 2" class="w-full md:w-[550px] bg-white p-4 rounded-lg shadow-md dark:bg-slate-800">
            <livewire:components.change-password />
        </div>
        <div x-show="activeTab === 3">
            <p class="text-gray-500 font-semibold">Comming Soon Feature</p>
        </div>
    </div>
</div>
