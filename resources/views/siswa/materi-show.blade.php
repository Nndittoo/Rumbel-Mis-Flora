<x-app-layout>
    <article class="col-span-4 md:col-span-3 mt-10 mx-auto py-5 w-full" style="max-width:700px">
        <img class="w-full my-2 rounded-lg" src="{{ asset("storage/".$materi->image) }}" alt="">
        <h1 class="text-4xl font-bold text-left text-gray-800">
            {{ $materi->title }}
        </h1>
        <div class="mt-2 flex justify-between items-center">
            <div class="flex py-5 text-base items-center">
                <img class="w-10 h-10 rounded-full mr-3" src="{{ $materi->author->profile_photo_url }}"
                    alt="avatar">
                <span class="mr-1">{{ $materi->author->name }}</span>
            </div>
            <div class="flex items-center">
                <span class="text-gray-500 mr-2">{{ $materi->published_at->diffForHumans() }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                    stroke="currentColor" class="w-5 h-5 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="article-content py-3 text-gray-800 text-lg text-justify">

           {!! $materi->body  !!}
        </div>

        <div class="flex items-center space-x-4 mt-10">
            @foreach ($materi->materiMapel as $mapel)
                    <x-badge :textColor="$mapel->text_color" :bgColor="$mapel->bg_color">
                        {{ $mapel->title }}
                    </x-badge>
                    @endforeach
        </div>

        <livewire:post-comments :key="'comments'. $materi->id" :$materi/>
    </article>
        </x-app-layout>
