<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="flex justify-between mb-12 items-center bg-white p-5 rounded-xl shadow-lg">
            <div>
                <p class="text-2xl font-semibold text-indigo-700"> Selamat datang di Halaman <span class="text-cyan-500 font-mono">Tugas</span></p>
                <span> Kamu bisa melihat tugas tugas yang telah kamu kirim. </span>
            </div>
            <div>
                <img src="{{ asset('img/child-writing.jpg') }}" alt="" width="250px" height="250px">
            </div>
        </div>
        <div class="flex justify-between mb-3 items-center p-5 border-b">
            <div class="flex items-center rounded-md shadow-sm flex-col p-5 bg-gradient-to-r from-blue-500 to-indigo-600">
                <p class="text-xl text-white"> Kamu telah mengirim </p>
                <p class="text-5xl font-semibold text-slate-200">{{ $tugas->count() }}</p>
                <p class="text-sm text-slate-400">Tugas</p>
            </div>
            <div class="flex items-center rounded-md shadow-sm flex-col p-5 bg-gradient-to-r from-blue-500 to-indigo-600">
                <p class="text-xl text-white"> Total tugas yang telah dijawab : </p>
                <p class="text-5xl font-semibold text-slate-200">{{ $selesai }}</p>
                <p class="text-sm text-slate-400">Tugas</p>
            </div>
            <div class="flex items-center rounded-md shadow-sm flex-col p-5 bg-gradient-to-r from-blue-500 to-indigo-600">
                <p class="text-xl text-white"> Total tugas yang belum, dijawab : </p>
                <p class="text-5xl font-semibold text-slate-200">{{ $belumSelesai }}</p>
                <p class="text-sm text-slate-400">Tugas</p>
            </div>
        </div>
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-2xl font-bold text-gray-800">Tugas Saya</h2>
            <a wire:navigate class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white hover:from-indigo-700 hover:to-blue-600 transition ease-in-out 300ms p-3 rounded-lg shadow-lg" href="{{ route('tugas.create') }}">
                New Tugas
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @foreach ($tugas as $t)
                <div wire:navigate href="{{ route('tugas.show', $t->title) }}" class="bg-white cursor-pointer relative p-6 rounded-lg shadow-lg transform transition hover:scale-105 duration-300">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-indigo-500 to-blue-500 text-white flex items-center justify-center font-bold text-xl shadow-md">
                            {{ substr($t->title, 0, 1) }}
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $t->title }}</h3>
                            <p class="text-gray-600 text-sm">Deadline: {{ $t->deadline }}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">{{ $t->description }}</p>
                    <div class="flex justify-between items-center">
                        <a wire:navigate href="{{ route('tugas.show', $t->title) }}"
                            class="inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-500 focus:shadow-outline focus:outline-none">
                             <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                             </svg>
                             Lihat Detail
                         </a>
                         <p class="inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white rounded-lg">{{ $t->status }}</p>
                    </div>
                    <div class="absolute top-0 right-0 shadow p-3 rounded-sm">
                        @if($t->status == 'SELESAI')
                        <p class="text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                          </svg>
                        </p>
                        @else
                          <p class="text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                              </svg>
                          </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
