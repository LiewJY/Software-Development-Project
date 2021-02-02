@props(['active'])

@php
$classes = ($active ?? false)
            ? 'px-3 py-3 border-b-4 border-white text-sm font-medium text-white hover:bg-gray-700 transition duration-150 ease-in-out'
            : 'px-3 py-3 text-sm font-medium text-white hover:bg-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
