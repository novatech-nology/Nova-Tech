{{-- Comentario Nova Tech: Arquivo resources/views/components/nav-link.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#7e0a85] text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-[#5c0760] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
