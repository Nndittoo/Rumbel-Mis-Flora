<x-app-layout>
    <div class="container mx-auto mt-10">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold mb-5">Tugas Saya</h2>
            <a wire:navigate class="bg-indigo-600 text-slate-200 hover:text-white hover:bg-indigo-800 transition ease-in-out 300ms p-2 rounded-lg" href="{{ route("tugas.create") }}">New Tugas</a>
        </div>
        <div class="grid grid-cols-1 gap-6 mt-5">
            @foreach ($tugas as $t)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold">{{ $t->title }}</h3>
                    <p class="text-gray-600">{{ $t->description }}</p>
                    <p class="text-gray-500 text-sm">Deadline: {{ $t->deadline }}</p>
                    <a wire:navigate href="{{ route('tugas.show', $t->title) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
