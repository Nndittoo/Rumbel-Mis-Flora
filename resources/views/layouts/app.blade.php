<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Filepont --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gradient-to-r from-blue-50 to-indigo-50">
    <x-banner />

    @include('layouts.partials.header')
        <main class="container mx-auto px-5 flex flex-grow">
            {{ $slot }}
        </main>
    @include('layouts.partials.footer')

    @stack('modals') @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toast = document.getElementById('toast');
            if (toast) {
                console.log('Toast element found:', toast);
                setTimeout(() => {
                    toast.classList.add('fade-out');
                    setTimeout(() => {
                        toast.classList.add('hidden');
                    }, 1000); // Tambahkan sedikit penundaan untuk menghindari penghapusan elemen sebelum animasi selesai
                }, 3000); // Menyembunyikan setelah 3 detik
            } else {
                console.log('Toast element not found');
            }
        });
    </script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
