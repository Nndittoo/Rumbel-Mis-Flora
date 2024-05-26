<x-app-layout>
    <div class="container pb-10 h-max mx-auto">
        <div class="flex justify-between mt-5">
            <a wire:navigate href="{{ route('tugas') }}"
                class="px-4 py-2 text-slate-400 hover:text-black flex items-center gap-2 transition ease-in-out 300ms rounded-md"><svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <p>Kembali</p>
            </a>
        </div>
        <div class="flex pt-10 flex-wrap -mx-4">
            <!-- Section pertama -->
            <div class="w-full lg:w-1/2 px-4 mb-10 lg:mb-0">
                <div class="max-w-2xl h-max mx-auto bg-white p-5 rounded-lg shadow-md">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold mb-5">{{ $tugas->title }}</h2>
                        <h2 class="text-2xl font-bold mb-5">{{ $tugas->status }}</h2>
                        @if ($tugas->status == 'SELESAI')
                            @else
                            <a wire:navigate href="{{ route('tugas.edit', $tugas) }}"
                            class="px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ml-2 flex items-center">Edit</a>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mb-5">Deadline: {{ $tugas->deadline->format('d-m-Y H:i') }}</p>
                    <p class="mb-5">{{ $tugas->description }}</p>

                    <img src="{{ asset('storage/' . $tugas->file_path) }}" alt="gambar tugas" class="mb-5">
                </div>
            </div>

            <!-- Section kedua -->
            <div
                class="max-w-2xl w-full lg:w-1/2 px-4 h-max mx-auto bg-white p-5 rounded-lg shadow-md overflow-y-auto sticky top-0">
                <div class=" bg-gray-100 p-5 rounded-lg">
                    <h3 class="text-xl font-semibold mb-2">Balasan dari Guru:</h3>
                    @foreach ($balasan as $pesan)
                        <p class="text-sm text-gray-600 mb-2">"{{ $pesan->note }}"</p>
                            <img src="{{ asset('storage/'. $pesan->balas) }}" alt="gambar balasan guru"
                                class="mt-5 rounded-lg shadow-md">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
