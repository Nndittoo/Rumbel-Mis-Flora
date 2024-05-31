<x-app-layout>
    <div class="p-5 flex flex-col gap-5 w-full">
        <div class="flex items-center justify-between gap-5">
            <div class="flex items-center gap-5 bg-gradient-to-r from-cyan-500 to-blue-500 w-1/2 p-5 rounded-xl shadow-lg">
                <div class="">
                    <img class="h-15 w-15 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                        alt="{{ Auth::user()->name }}" />
                </div>
                <div>
                    <p class="text-sm">Hi, {{ Auth::user()->name }}</p>
                    <p class="font-semibold text-xl font-mono">Glad To See You!</p>
                </div>
            </div>
            <div class="flex items-center gap-5 bg-gradient-to-r from-blue-500 to-cyan-500 w-1/2 p-5 rounded-xl shadow-lg">
                <div class="flex flex-col">
                    <h1 class="text-white font-mono font-semibold text-2xl"> Mau belajar apa sekarang ?</h1>
                    <a href="{{ route("materi") }}" class="flex items-center hover:bg-gradient-to-r hover:from-cyan-500 hover:to-blue-500 transition ease-in-out 300ms animate-bounce gap-5 text-white text-lg shadow bg-indigo-500 p-2 mt-3 rounded-md bg-opacity-50 justify-between"> Langsung ke materi <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                      </a>
                </div>
            </div>
        </div>
        <div class="mt-10 h-max">
            <p class="font-semibold text-2xl font-mono mb-5 border-b pb-2">Semua mata pelajaran.</p>
            <livewire:mapel-list />
        </div>
    </div>
</x-app-layout>
