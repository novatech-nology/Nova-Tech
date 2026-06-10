{{-- Comentario Nova Tech: Arquivo resources/views/components/input-label.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>
