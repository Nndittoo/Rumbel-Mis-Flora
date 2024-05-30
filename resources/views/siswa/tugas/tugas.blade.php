<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold mb-5 text-gray-800">Tugas Saya</h2>
            <a wire:navigate class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white hover:from-indigo-700 hover:to-blue-600 transition ease-in-out 300ms p-3 rounded-lg shadow-lg" href="{{ route('tugas.create') }}">
                New Tugas
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
            @foreach ($tugas as $t)
                <div class="bg-white p-6 rounded-lg shadow-lg transform transition hover:scale-105 duration-300">
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
                    <a wire:navigate href="{{ route('tugas.show', $t->title) }}"
                       class="inline-flex items-center justify-center h-10 px-5 font-medium tracking-wide text-white transition duration-200 bg-indigo-600 rounded-lg hover:bg-indigo-500 focus:shadow-outline focus:outline-none mt-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
