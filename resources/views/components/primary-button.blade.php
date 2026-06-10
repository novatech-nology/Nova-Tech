{{-- Comentario Nova Tech: Arquivo resources/views/components/primary-button.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#7e0a85] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#5c0760] focus:bg-[#5c0760] active:bg-[#4b064f] focus:outline-none focus:ring-2 focus:ring-[#a52cad] focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
