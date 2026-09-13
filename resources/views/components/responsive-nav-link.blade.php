@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#5fb39a] text-start text-base font-medium text-[#edf8f4] bg-[#122c29] focus:outline-none focus:text-[#edf8f4] focus:bg-[#143932] focus:border-[#8fe7c3] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-[#dfeae7] hover:text-[#edf8f4] hover:bg-[#112b28] hover:border-[#3e665f] focus:outline-none focus:text-[#edf8f4] focus:bg-[#143932] focus:border-[#5fb39a] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
