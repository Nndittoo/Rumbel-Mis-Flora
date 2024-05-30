<x-app-layout>
    <div class="h-max w-screen p-5 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="h-40 shadow-lg flex items-start justify-between p-5 rounded-lg bg-white transition-transform transform hover:scale-105">
            <p class="text-3xl flex flex-col h-full justify-center font-bold text-indigo-700"> Orang Tua dari
                <span class="text-xl text-gray-600">
                    @foreach ($siswa as $siswa)
                        {{ $siswa->full_name }}
                    @endforeach
                </span>
            </p>
            <p class="flex h-full justify-center items-center text-lg text-gray-500">
                {{ $waktu }}
            </p>
        </div>

        <div class="mt-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="shadow-lg p-8 bg-white rounded-lg transition-transform transform hover:scale-105">
                    <p class="text-xl font-semibold text-indigo-700 mb-3">Informasi Anak :</p>
                    <div class="border-t-2 p-3 border-indigo-200">
                        <p class="flex justify-between items-center">Nama Lengkap <span class="w-[60%]">: {{ $siswa->full_name }}</span></p>
                        <p class="flex justify-between items-center">Tempat/Tanggal Lahir <span class="w-[60%]">: {{ $siswa->tempatLahir }}/{{ $siswa->tanggalLahir }}</span></p>
                        <p class="flex justify-between items-center">Asal Sekolah <span class="w-[60%]">: {{ $siswa->sekolah }}</span></p>
                        <p class="flex justify-between items-center">Status <span class="w-[60%]">: {{ $siswa->status }}</span></p>
                    </div>
                </div>
                <div class="shadow-lg p-8 bg-white rounded-lg transition-transform transform hover:scale-105">
                    <p class="text-xl font-semibold text-indigo-700 mb-3">Informasi Uang Les :</p>
                    @foreach ($uangLes as $uang)
                    <div class="border-t-2 p-3 border-indigo-200 gap-3">
                        <p class="flex justify-between items-center">Periode <span class="w-[40%]">: {{ $uang->periode }}</span></p>
                        <p class="flex justify-between items-center">Metode Pembayaran <span class="w-[40%] lowercase">: {{ $uang->caraBayar }}</span></p>
                        <p class="flex justify-between items-center">Total Uang Les <span class="w-[40%]">: {{ $uang->uang }}</span></p>
                        <p class="flex justify-between items-center">Status <span class="w-[40%]">: {{ $uang->status }}</span></p>
                        <p class="flex justify-between items-center">Tanggal Bayar <span class="w-[40%]">: {{ $uang->tanggal }}</span></p>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="shadow-lg p-8 mt-10 bg-white rounded-lg transition-transform transform hover:scale-105">
                <h1 class="text-center text-xl font-semibold text-indigo-700 border-b-2 pb-2 border-indigo-200"> Daftar Jadwal Modul </h1>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 p-5">
                    @foreach ($mapel as $mapel)
                        <div
                            class="p-6 shadow-md border rounded-lg bg-white relative cursor-pointer hover:border-indigo-300 transition ease-in-out 300ms transform hover:scale-105">
                            <div class="rounded-lg h-64 overflow-hidden mb-4">
                                <img alt="content" class="object-cover object-center h-full w-full"
                                    src="{{ asset("storage/".$mapel->image) }}">
                            </div>
                            <div class="flex flex-col">
                                <div class="flex gap-5 mt-3 flex-wrap">
                                    @foreach($mapel->jadwal as $hari)
                                <p class="flex p-2 bg-indigo-500 bg-opacity-50 text-white font-mono rounded-xl">{{ $hari }}</p>
                                     @endforeach
                                </div>
                                <div class="flex flex-col mt-5">
                                    <a class="text-xl font-medium title-font">{{ $mapel->title }}</a>
                                <div class="flex gap-5 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-indigo-600">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                      </svg>
                                    <div class="flex items-center gap-3 text-gray-600">
                                    <p>{{ $mapel->kelas_mulai }}</p> -
                                    <p>{{ $mapel->kelas_akhir }}</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
