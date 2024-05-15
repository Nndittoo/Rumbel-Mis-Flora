<x-app-layout>
    <div class="p-5 flex flex-col gap-5 w-full">
        <div class="flex items-center gap-5">
            <div class="">
                <img class="h-15 w-15 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
            </div>
            <div>
                <p class="text-sm">Hi, {{ Auth::user()->name }}</p>
                <p class="font-semibold text-xl font-mono">Glad To See You!</p>
            </div>
        </div>
        <div class="mt-10 h-max">
            <p class="font-semibold text-xl font-mono mb-5">Your Today's Plan</p>
            <livewire:mapel-list />
        </div>
    </div>
</x-app-layout>
