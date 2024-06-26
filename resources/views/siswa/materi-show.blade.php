<x-app-layout>
    <article class="col-span-4 md:col-span-3 mx-auto py-5 w-full">
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Image -->
        <img class="w-full h-64 object-cover" src="{{ asset("storage/".$materi->image) }}" alt="{{ $materi->title }}">

        <!-- Materi Information -->
        <div class="p-6">
          <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $materi->title }}</h1>
          <div class="flex items-center justify-between mb-6">
            <!-- Author Avatar and Name -->
            <div class="flex items-center">
              <img class="w-10 h-10 rounded-full mr-3" src="{{ $materi->author->profile_photo_url }}" alt="{{ $materi->author->name }}">
              <span class="text-sm font-semibold">{{ $materi->author->name }}</span>
            </div>
            <!-- Published Date -->
            <div class="flex items-center text-gray-500">
              <span>{{ $materi->published_at->diffForHumans() }}</span>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3" stroke="currentColor" class="w-5 h-5 ml-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>

          <!-- Materi Content -->
          <div class="text-gray-800 text-lg leading-relaxed text-justify mb-8">
            {!! $materi->body !!}
          </div>

          <!-- Materi Mapel Badges -->
          <div class="flex items-center flex-wrap mt-6 space-x-4">
            @foreach ($materi->materiMapel as $mapel)
              <x-badge :textColor="$mapel->text_color" :bgColor="$mapel->bg_color">{{ $mapel->title }}</x-badge>
            @endforeach
          </div>
        </div>
      </div>

      <!-- Comments Section -->
      <livewire:post-comments :key="'comments'. $materi->id" :$materi/>
    </article>
  </x-app-layout>
