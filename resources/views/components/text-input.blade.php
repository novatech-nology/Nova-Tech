{{-- Comentario Nova Tech: Arquivo resources/views/components/text-input.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#7e0a85] focus:ring-[#7e0a85] rounded-md shadow-sm']) }}>
