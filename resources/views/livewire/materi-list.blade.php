<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between mb-12 items-center bg-white p-5 rounded-xl shadow-lg">
        <div>
            <p class="text-2xl font-semibold text-indigo-700"> Selamat datang di Halaman <span class="text-cyan-500 font-mono">Materi!!</span></p>
            <span> Di Sini anda bisa melihat materi yang telah di siapkan oleh pengajar. </span>
        </div>
        <div>
            <img src="{{ asset('img/child.png') }}" alt="" width="300px" height="300px">
        </div>
    </div>
    @if(session()->has('sort'))
        <div id="toast" class="flex justify-between mb-3 items-center bg-gradient-to-r from-cyan-500 to-blue-500 p-5 rounded-xl shadow-lg">
            <div>
                <p class="text-xl font-semibold text-indigo-700"> Kamu sedang mengurutkan materi dalam urutan
                <span class="text-white">
                        {{ session('sort') }}
                </span>
                    sekarang.</p>
            </div>
        </div>
     @endif
    <div class="flex sticky top-0 justify-between items-center border-b border-slate-300">
        <div class="flex items-center">
            <livewire:search-box />
        </div>
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4" wire:click="setSort('desc')">Terbaru</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4" wire:click="setSort('asc')">Terlama</button>
            @if($this->activeMapel)
            <div class="flex gap-3 items-center">
            <x-badge wire:navigate href="{{ route('materi', ['mapel' => $this->activeMapel->slug]) }}" :textColor="$this->activeMapel->text_color" :bgColor="$this->activeMapel->bg_color">
                {{ $this->activeMapel->title }}
            </x-badge>
            <button wire:click="clearFilters()" class="text-blue-500 hover:text-red-500 hover:rotate-90 transition ease-in-out 300ms">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
               </button>
            </div>
            @endif
        </div>
    </div>
    <div class="py-4">
        @if (count($this->materi) > 0)
            @foreach ($this->materi as $materi)
                <x-materi.materi-item :materi="$materi"/>
            @endforeach
        @else
            <p class="text-3xl font-semibold text-center mt-5 shadow-lg p-5 rounded-lg border border-slate-200">Tidak Ada Materi.</p>
        @endif
    </div>
    <div class="my-3">
        {{ $this->materi->onEachSide(1)->links() }}
    </div>
</div>
