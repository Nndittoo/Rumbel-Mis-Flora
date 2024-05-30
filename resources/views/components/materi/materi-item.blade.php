<article class="[&:not(:last-child)]:border-b border-gray-200 pb-10 transition-transform transform hover:scale-100 ease-in-out 300ms hover:bg-white hover:shadow-lg rounded-lg p-5">
    <div class="article-body grid grid-cols-12 gap-5 mt-5 items-start">
        <div class="article-thumbnail col-span-4 flex items-center">
            <a wire:navigate href="{{ route('materi-show', $materi->slug) }}">
                <img class="w-full rounded-xl transition-transform transform hover:scale-105"
                    src="{{ asset("storage/".$materi->image) }}"
                    alt="thumbnail">
            </a>
        </div>
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center">
                <img class="w-8 h-8 rounded-full mr-3"
                    src="{{ $materi->author->profile_photo_url }}"
                    alt="avatar">
                <span class="mr-1 text-xs font-semibold text-indigo-700">{{ $materi->author->name }}</span>
                <span class="text-gray-500 text-xs">. {{ $materi->published_at->diffForHumans() }}</span>
            </div>
            <h2 class="text-2xl font-bold text-indigo-800 hover:text-indigo-600 transition-colors">
                <a wire:navigate href="{{ route('materi-show', $materi->slug) }}">
                    {{ $materi->title }}
                </a>
            </h2>
            <p class="mt-3 text-base text-gray-700">
                {!! $materi->getExcerpt() !!}
            </p>
            <div class="article-actions-bar mt-6 flex items-center justify-between">
                <div class="flex gap-2">
                    @foreach ($materi->materiMapel as $mapel)
                        <x-badge :textColor="$mapel->text_color" :bgColor="$mapel->bg_color">
                            {{ $mapel->title }}
                        </x-badge>
                    @endforeach
                </div>
                <div class="flex items-center text-gray-600">
                    <div class="text-indigo-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                    </div>
                    <span class="ml-2">
                        {{ $materi->comments->count() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</article>
