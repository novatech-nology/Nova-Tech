{{-- Comentario Nova Tech: Arquivo resources/views/components/responsive-nav-link.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#7e0a85] text-start text-base font-medium text-[#7e0a85] bg-[#7e0a85]/10 focus:outline-none focus:text-[#5c0760] focus:bg-[#7e0a85]/15 focus:border-[#5c0760] transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
