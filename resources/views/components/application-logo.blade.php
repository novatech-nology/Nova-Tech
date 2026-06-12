{{-- Comentario Nova Tech: Arquivo resources/views/components/application-logo.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<img src="{{ asset('images/nova-tech-logo.png') }}" alt="NovaTech" {{ $attributes->merge(['class' => 'h-10 w-auto object-contain']) }}>
