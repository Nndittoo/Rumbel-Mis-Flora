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
         document.getElementById('files').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('file-preview');
        previewContainer.innerHTML = ''; // Clear previous previews

        for (const file of files) {
            const fileReader = new FileReader();
            fileReader.onload = function(e) {
                const previewElement = document.createElement('div');
                previewElement.classList.add('file-preview-element');

                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('file-preview-image');
                    previewElement.appendChild(img);
                } else {
                    const fileInfo = document.createElement('p');
                    fileInfo.textContent = file.name;
                    previewElement.appendChild(fileInfo);
                }

                previewContainer.appendChild(previewElement);
            };
            fileReader.readAsDataURL(file);
        }
    });
    </script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
