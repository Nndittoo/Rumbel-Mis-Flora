<!-- resources/views/livewire/mapel-list.blade.php -->
<div class="grid grid-cols-3 gap-5">
    @foreach ($mapels as $mapel)
        <div
            class="p-4 sm:mb-0 mb-6 shadow border rounded-lg relative cursor-pointer hover:border-slate-300 transition ease-in-out 300ms">
            <div class="rounded-lg h-64 overflow-hidden">
                <img alt="content" class="object-cover object-center h-full w-full"
                    src="{{ asset("storage/".$mapel->image) }}">
            </div>
            <div class="flex flex-col">
                <div class="flex gap-5 mt-3">
                    @foreach($mapel->jadwal as $hari)
                <p class="flex p-2 bg-gradient-to-r from-cyan-300 to-blue-300 bg-opacity-75 text-slate-700 font-mono rounded-xl">{{ $hari }}</p>
                     @endforeach
                </div>
                <div class="flex flex-col gap-2">
                    <a class="text-xl font-medium border-b title-font mt-5">{{ $mapel->title }}</a>
                    <div class="w-full flex justify-end">
                        <a wire:navigate href="{{ route('materi', ['mapel' => $mapel->slug]) }}"
                            class="text-slate-300 w-1/2 bg-indigo-500 text-center items-center p-2 hover:text-slate-50 hover:bg-gradient-to-r from-cyan-500 to-blue-500 transition ease-in-out 300ms cursor-pointer rounded-xl">
                            Start Now
                        </a>
                    </div>
                </div>
            </div>
            </div>
    @endforeach
</div>
