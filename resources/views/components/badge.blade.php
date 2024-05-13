@props(['textColor', 'bgColor'])

@php
    $textColor = match ($textColor){
        'green' => 'text-green-800',
        'blue' => 'text-blue-800',
        'yellow' => 'text-yellow-800',
        'red' => 'text-red-800',
        default => 'text-gray-800',
    };
    $bgColor = match ($bgColor){
        'green' => 'bg-green-100',
        'blue' => 'bg-blue-100',
        'yellow' => 'bg-yellow-100',
        'red' => 'bg-red-100',
        default => 'bg-gray-100',
    };
@endphp

<button {{ $attributes }} class="{{ $textColor }} {{ $bgColor }} rounded-xl px-3 py-1 text-base">
    {{ $slot }}
</button>