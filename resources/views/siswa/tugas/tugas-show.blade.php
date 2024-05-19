<x-app-layout>
    <div class="container h-max mx-auto mt-10">
        <div class="flex flex-wrap -mx-4">
            <!-- Section pertama -->
            <div class="w-full lg:w-1/2 px-4 mb-10 lg:mb-0">
                <div class="max-w-2xl h-max mx-auto bg-white p-5 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold mb-5">{{ $tugas->title }}</h2>
                    <p class="text-sm text-gray-600 mb-5">Deadline: {{ $tugas->deadline->format('d-m-Y H:i') }}</p>
                    <p class="mb-5">{{ $tugas->description }}</p>

                    <img src="{{ asset('storage/'.$tugas->file_path) }}" alt="gambar tugas" class="mb-5">

                    <div class="flex justify-between mt-5">
                        <a href="{{ route('tugas') }}" class="px-4 py-2 bg-indigo-500 text-white rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Kembali</a>
                        <a href="{{ route('tugas.edit', $tugas) }}" class="px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 ml-2">Edit</a>
                    </div>

                    <!-- Balasan Guru -->
                    <div class="mt-10 bg-gray-100 p-5 rounded-lg">
                        <h3 class="text-xl font-semibold mb-2">Balasan dari Guru:</h3>
                        <p class="text-sm text-gray-600 mb-2">"Tugas Anda sangat baik, namun perlu diperhatikan pada bagian analisis agar lebih mendetail."</p>
                        <img src="https://storage.tally.so/16111692-af89-4d0a-b621-7a53ed4a0871/BANNER-GOOGLE-CLASSROOM-Banner-Google-Classroom-dan-Form-2-1-.jpg" alt="gambar balasan guru" class="mt-5 rounded-lg shadow-md">
                    </div>
                </div>
            </div>

            <!-- Section kedua -->
            <div class="w-full lg:w-1/2 px-4">
                <div class="max-w-2xl h-max mx-auto bg-white p-5 rounded-lg shadow-md overflow-y-auto sticky top-0">
                    <h2 class="text-2xl font-bold mb-5">Komentar dan Balasan</h2>

                    <!-- Komentar dan Balasan -->
                    <div class="mb-5">
                        <h3 class="text-xl font-semibold mb-2">Siswa A:</h3>
                        <p class="text-sm text-gray-600 mb-2">"Saya setuju dengan feedback dari guru, bagian analisis perlu diperbaiki."</p>

                        <!-- Balasan komentar -->
                        <div class="ml-5 bg-gray-100 p-3 rounded-lg">
                            <h4 class="text-lg font-semibold mb-2">Guru:</h4>
                            <p class="text-sm text-gray-600 mb-2">"Terima kasih atas masukannya, Siswa A. Saya harap Anda dapat memperbaikinya pada tugas berikutnya."</p>
                        </div>
                    </div>

                    <!-- Komentar lain -->
                    <div class="mb-5">
                        <h3 class="text-xl font-semibold mb-2">Siswa B:</h3>
                        <p class="text-sm text-gray-600 mb-2">"Saya mengalami kesulitan di bagian teori. Apakah ada sumber tambahan yang bisa direkomendasikan?"</p>

                        <!-- Balasan komentar -->
                        <div class="ml-5 bg-gray-100 p-3 rounded-lg">
                            <h4 class="text-lg font-semibold mb-2">Guru:</h4>
                            <p class="text-sm text-gray-600 mb-2">"Anda bisa melihat buku XYZ untuk pemahaman yang lebih baik mengenai teori tersebut."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
