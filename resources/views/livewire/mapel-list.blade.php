<!-- resources/views/livewire/mapel-list.blade.php -->
<div class="grid grid-cols-3 gap-5">
    @foreach ($mapels as $mapel)
        <div
            class="p-4 sm:mb-0 mb-6 shadow border rounded-lg relative cursor-pointer hover:border-slate-300 transition ease-in-out 300ms">
            <div class="rounded-lg h-64 overflow-hidden">
                <img alt="content" class="object-cover object-center h-full w-full"
                    src="{{ asset("storage/".$mapel->image) }}">
            </div>
            <div class="flex flex-col gap-2">
                <a class="text-xl font-medium title-font mt-5">{{ $mapel->title }}</a>
                <a wire:navigate href="{{ route('materi', ['mapel' => $mapel->slug]) }}"
                    class="text-slate-300 bg-indigo-500 text-center items-center p-2 hover:text-slate-50 hover:bg-indigo-700 transition ease-in-out 300ms cursor-pointer rounded-xl">
                    Start Now
                </a>
            </div>
            <p class="absolute top-1 right-1 p-3 bg-indigo-700 bg-opacity-70 text-slate-200 font-semibold font-mono rounded-xl">{{ $mapel->jadwal}}</p>
        </div>
    @endforeach
</div>
