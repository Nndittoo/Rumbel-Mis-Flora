<x-app-layout>
    <div class="container py-10 h-max mx-auto">
        <a wire:navigate href="{{ route('tugas') }}"
                class="px-4 mb-4 w-max bg-gray-100 p-6  shadow-inner py-2 text-gray-500 hover:text-white hover:bg-black sticky top-2 z-50  flex items-center gap-2 transition ease-in-out duration-300 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <p>Kembali</p>
            </a>
        <div class="flex flex-col justify-between mt-5">
            <div class="relative flex justify-between mb-12 items-center bg-white p-5 rounded-xl shadow-lg">
                <div>
                    <p class="text-2xl font-semibold text-indigo-700"> Selamat datang di Halaman <span class="text-cyan-500 font-mono">Show Tugas</span></p>
                    <span> Di sini kamu bisa melihat tugasmu dan jawaban dari tugasmu. </span>
                </div>
                <div class="">
                    <img src="{{ asset('img/child-thinking.jpg') }}" alt="" width="250px" height="250px">
                </div>
            </div>
            <div id="toast" class="flex justify-between mb-3 items-center
            @if ($tugas->status == 'SELESAI')
            bg-gradient-to-r from-emerald-500 to-green-500
            @else
            bg-gradient-to-r from-pink-500 to-rose-500
            @endif
            p-5 rounded-xl shadow-lg">
                <div class="w-full">
                    <p class="text-xl text-center font-semibold text-white">
                        @if ($tugas->status == 'SELESAI')
                        Tugas anda sudah dijawab !!.
                        @else
                        Sepertinya tugas anda belum dijawab.
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="flex pt-10 flex-wrap -mx-4">
            <!-- Section pertama -->
            <div class="w-full lg:w-1/2 px-4 mb-10 lg:mb-0">
                <div class="max-w-2xl h-max mx-auto bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold mb-5 text-gray-800">{{ $tugas->title }}</h2>
                        @if ($tugas->status != 'SELESAI')
                            <a wire:navigate href="{{ route('tugas.edit', $tugas) }}"
                               class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white hover:from-indigo-700 hover:to-blue-600 transition ease-in-out 300ms p-3 rounded-lg shadow-lg">Edit</a>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 mb-5">Deadline: {{ $tugas->deadline->format('d-m-Y H:i') }}</p>
                    <p class="mb-5">{{ $tugas->description }}</p>
                    @if ($tugas->file_path)
                        <img src="{{ asset('storage/' . $tugas->file_path) }}" alt="gambar tugas" class="mb-5 rounded-lg shadow-md">
                    @endif
                </div>
            </div>

            <!-- Section kedua -->
            <div class="max-w-2xl w-full lg:w-1/2 px-4 h-max mx-auto bg-white p-6 rounded-lg shadow-lg overflow-y-auto sticky top-0">
                <div class="bg-gray-100 p-6 rounded-lg shadow-inner">
                    <h3 class="text-xl font-semibold mb-2 text-gray-800">Balasan dari Guru:</h3>
                    @foreach ($balasan as $pesan)
                        <p class="text-sm text-gray-600 mb-2">"{{ $pesan->note }}"</p>
                        @if ($pesan->balas)
                            <img src="{{ asset('storage/'. $pesan->balas) }}" alt="gambar balasan guru"
                                 class="mt-5 rounded-lg shadow-md transfrom hover:scale-105 transition duration-300">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
