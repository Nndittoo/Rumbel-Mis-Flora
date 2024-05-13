<div>
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Recommended Topics</h3>
    <div class="topics flex flex-wrap justify-start gap-3">
        @foreach ($mapel as $mapel)
            <x-badge wire:navigate href="{{ route('home', ['mapel' => $mapel->slug]) }}" :textColor="$mapel->text_color" :bgColor="$mapel->bg_color">
                {{ $mapel->title }}
            </x-badge>
        @endforeach
    </div>
</div>
