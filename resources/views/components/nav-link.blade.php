@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center border-b-2 border-transparent font-medium leading-5 bg-gray-700 !text-white transition duration-150 ease-in-out'
            : 'inline-flex items-center border-b-2 border-transparent font-medium leading-5 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
