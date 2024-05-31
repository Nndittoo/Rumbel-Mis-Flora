<nav class="flex items-center justify-between py-3 px-6 border-b border-slate-200 shadow-sm">
    <div id="nav-left" class="flex items-center">
        <div class="text-gray-800 font-semibold">
            <span class="text-indigo-500 text-xl">Rumbel Mis Flora</span>
        </div>
        @if(Auth::user()->role == "ORTU")
            @elseif (Auth::user()->role == "PENGAJAR")
            <div class="top-menu ml-10">
                <ul class="flex space-x-4">
                    <x-nav-link wire:navigate href="{{ route('index') }}" :active="request()->routeIs('index')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link wire:navigate href="{{ route('materi') }}" :active="request()->routeIs('materi', 'mapel.show', 'materi-show')">
                        {{ __('Materi') }}
                    </x-nav-link>
                    <x-nav-link wire:navigate href="{{ route('tugas') }}" :active="request()->routeIs('tugas', 'tugas.show', 'tugas.store', 'tugas.create')">
                        {{ __('Daftar Tugas Murid') }}
                    </x-nav-link>
                </ul>
            </div>
        @else
            <div class="top-menu ml-10">
                <ul class="flex space-x-4">
                    <x-nav-link wire:navigate href="{{ route('index') }}" :active="request()->routeIs('index')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link wire:navigate href="{{ route('materi') }}" :active="request()->routeIs('materi', 'mapel.show', 'materi-show')">
                        {{ __('Materi') }}
                    </x-nav-link>
                    <x-nav-link wire:navigate href="{{ route('tugas') }}" :active="request()->routeIs('tugas', 'tugas.show', 'tugas.store', 'tugas.create', 'tugas.edit', 'tugas.update')">
                        {{ __('Tugas') }}
                    </x-nav-link>
                </ul>
            </div>
        @endif
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
