<div id="search-box">
    <div class="flex items-center gap-5 w-96">
        <h3 class="text-lg font-semibold text-gray-900">Search</h3>
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" class="w-6 h-6 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </span>
            <input
                wire:model.live.debounce.5ms="search"
                class="w-full pl-10 pr-3 py-2 bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 text-sm text-gray-800 placeholder-gray-400"
                type="text" placeholder="Search Listening">
        </div>
    </div>
</div>
