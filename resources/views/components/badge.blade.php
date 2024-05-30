@props(['textColor', 'bgColor'])

@php
    $textColor = match ($textColor){
        'green' => 'text-green-800',
        'blue' => 'text-blue-800',
        'yellow' => 'text-yellow-800',
        'red' => 'text-red-800',
        default => 'text-slate-700',
    };
    $bgColor = match ($bgColor){
        'green' => 'bg-green-100',
        'yellow' => 'bg-yellow-100',
        'red' => 'bg-red-100',
        default => 'bg-blue-100',
    };
@endphp

<button {{ $attributes }} class="{{ $textColor }} {{ $bgColor }} rounded-xl px-3 py-1 text-base">
    {{ $slot }}
</button>
