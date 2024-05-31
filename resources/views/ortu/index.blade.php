<x-app-layout>
    <div class="h-max w-screen p-5">
        <div class="h-40 shadow-lg flex items-start justify-between p-5 rounded-lg bg-white bg-opacity-50 transition-transform transform hover:scale-105">
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
                <div class="shadow-lg p-8 bg-white rounded-lg bg-opacity-50 transition-transform transform hover:scale-105">
                    <p class="text-xl font-semibold text-indigo-700 mb-3">Informasi Anak :</p>
                    <div class="border-t-2 p-3 border-indigo-200">
                        <p class="flex justify-between items-center">Nama Lengkap <span class="w-[60%]">: {{ $siswa->full_name }}</span></p>
                        <p class="flex justify-between items-center">Tempat/Tanggal Lahir <span class="w-[60%]">: {{ $siswa->tempatLahir }}/{{ $siswa->tanggalLahir }}</span></p>
                        <p class="flex justify-between items-center">Asal Sekolah <span class="w-[60%]">: {{ $siswa->sekolah }}</span></p>
                        <p class="flex justify-between items-center">Status <span class="w-[60%]">: {{ $siswa->status }}</span></p>
                    </div>
                </div>
                <div class="shadow-lg p-8 bg-white bg-opacity-50 rounded-lg transition-transform transform hover:scale-105">
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
            <div class="shadow-lg p-8 mt-10 bg-white bg-opacity-50 rounded-lg transition-transform transform hover:scale-105">
                <h1 class="text-center text-xl font-semibold text-indigo-700 border-b-2 pb-1 border-indigo-200"> Nilai dari {{ $siswa->full_name }}</h1>
                    <div class="flex items-center mt-3 justify-center">
                        <div class="relative w-full shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Siswa
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Materi
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nilai
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Catatan
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Tanggal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilai as $nilai)
                                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $nilai->nilaiSiswa->full_name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $nilai->nilaiMateri->title }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $nilai->nilai }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $nilai->catatan }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ date('d F Y', strtotime($nilai->tanggal)) }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <div class="shadow-lg p-8 mt-10 bg-white bg-opacity-50 rounded-lg transition-transform transform hover:scale-105">
                <h1 class="text-center text-xl font-semibold text-indigo-700 border-b-2 pb-2 border-indigo-200"> Daftar Jadwal Mata Pelajaran </h1>
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
