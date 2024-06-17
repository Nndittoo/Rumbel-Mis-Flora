<!-- resources/views/tugas/create.blade.php -->
<x-app-layout>
    <div class="container mx-auto py-10">
        <div class="flex justify-between mb-12 items-center bg-white p-5 rounded-xl shadow-lg">
            <div>
                <p class="text-2xl font-semibold text-indigo-700"> Selamat datang di Halaman <span class="text-cyan-500 font-mono">{{ $juduk }}</span> Tugas.</p>
                <span> Di sini kamu bisa menambahkan tugas yang diberikan dari sekolah, dan juga kamu bisa mengubah nya. </span>
            </div>
            <div>
                <img src="{{ asset('img/child-world.jpg') }}" alt="" width="250px" height="250px">
            </div>
        </div>
        <div class="flex mb-3 items-center bg-gradient-to-r from-cyan-500 to-blue-500 p-5 rounded-xl shadow-lg">
            <div class="w-full">
                <p class="text-xl text-center font-semibold text-slate-100"> Silahkan isi form di bawah 😀</p>
            </div>
        </div>
        <div class="mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-5 text-indigo-600">{{ isset($tugas) ? 'Edit Tugas' : 'Tambah Tugas Baru' }}</h2>
            <form action="{{ isset($tugas) ? route('tugas.update', $tugas) : route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($tugas))
                    @method('PUT')
                @endif
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title Tugas</label>
                    <input type="text" required placeholder="Masukkan judul tugas baru" name="title" id="title" value="{{ old('title', $tugas->title ?? '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>
                </div>
                <div class="mb-4">
                    <label for="mapel_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>
                        @foreach ($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ (isset($tugas) && $tugas->mapel_id == $mapel->id) ? 'selected' : '' }}>{{ $mapel->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description"
                        
                        placeholder="Berikan deskripsi mengenai tugas anda"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>{{ old('description', $tugas->description ?? '') }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
                    <input type="datetime-local" name="deadline" id="deadline" value="{{ old('deadline', isset($tugas) ? $tugas->deadline->format('Y-m-d\TH:i') : '') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        required>
                </div>
                <div class="mb-4">
                    <label for="files" class="block text-sm font-medium text-gray-700">Masukkan File</label>
                    <input type="file" name="file" id="files" multiple
                        class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                        file:bg-gray-50 file:border-0
                        file:me-4
                        file:py-2 file:px-4
                        dark:file:bg-neutral-700 dark:file:text-neutral-400" value="{{ old('file', $tugas->file_path ?? '') }}">
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-blue-500 text-white rounded-md shadow-md hover:from-indigo-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition ease-in-out duration-300">{{ isset($tugas) ? 'Update' : 'Simpan' }}</button>
                </div>
            </form>
            <div id="file-preview" class="mt-4"></div>
        </div>
    </div>
</x-app-layout>
