<nav class="flex items-center justify-between py-3 px-6 border-b border-gray-100">
    <div id="nav-left" class="flex items-center">
        <div class="text-gray-800 font-semibold">
            <span class="text-yellow-500 text-xl">&lt;YELO&gt;</span> Code
        </div>
        <div class="top-menu ml-10">
            <ul class="flex space-x-4">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Home') }}
                </x-nav-link>
                <x-nav-link href="{{ route('materi') }}" :active="request()->routeIs('materi')">
                    {{ __('Materi') }}
                </x-nav-link>
            </ul>
        </div>
    </div>
    <div id="nav-right" class="flex items-center md:space-x-6">
        <div class="flex space-x-5">
            @auth
                    @include('layouts.partials.nav-right-auth')
                @else
                    @include('layouts.partials.nav-right-guest')
            @endauth
        </div>
    </div>
</nav>