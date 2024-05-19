<!-- resources/views/tugas/create.blade.php -->
<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white p-5 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-5">{{ isset($tugas) ? 'Edit Tugas' : 'Tambah Tugas Baru' }}</h2>
            <form action="{{ isset($tugas) ? route('tugas.update', $tugas) : route('tugas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($tugas))
                    @method('PUT')
                @endif
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title Tugas</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $tugas->title ?? '') }}"
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
                        class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                        file:bg-gray-50 file:border-0
                        file:me-4
                        file:py-2 file:px-4
                        dark:file:bg-neutral-700 dark:file:text-neutral-400">
                </div>
                <div id="file-previews" class="mt-4">
                    @if (isset($tugas) && $tugas->file_paths)
                        @php
                            $file_paths = json_decode($tugas->file_paths, true);
                        @endphp
                        @foreach ($file_paths as $file_path)
                            <div class="file-preview mt-2 p-2 border border-gray-200 rounded-lg shadow-sm">
                                <p class="text-sm font-medium text-gray-700">{{ basename($file_path) }}</p>
                                @if (Str::endsWith($file_path, ['jpg', 'jpeg', 'png', 'gif']))
                                    <img src="{{ Storage::url($file_path) }}" class="mt-2 max-w-full h-auto" />
                                @elseif (Str::endsWith($file_path, ['pdf']))
                                    <embed src="{{ Storage::url($file_path) }}" type="application/pdf" class="mt-2 max-w-full h-auto" />
                                @else
                                    <a href="{{ Storage::url($file_path) }}" class="text-blue-500 hover:underline">Download File</a>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-500 text-white rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ isset($tugas) ? 'Update' : 'Simpan' }}</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
