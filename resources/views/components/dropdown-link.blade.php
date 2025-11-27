@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full text-start px-4 py-2 text-sm leading-5 text-gray-700 bg-gray-100 focus:outline-none focus:bg-gray-100 transition'
            : 'block w-full text-start px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
