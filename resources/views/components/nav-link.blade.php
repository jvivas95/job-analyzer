@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#5fb39a] text-sm font-medium leading-5 text-[#edf8f4] focus:outline-none focus:border-[#8fe7c3] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#dfeae7] hover:text-[#edf8f4] hover:border-[#3e665f] focus:outline-none focus:text-[#edf8f4] focus:border-[#5fb39a] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
