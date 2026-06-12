{{-- Comentario Nova Tech: Arquivo resources/views/dashboard.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
@include('welcome', ['products' => \App\Models\Product::query()->latest()->take(4)->get()])
