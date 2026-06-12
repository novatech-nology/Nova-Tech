{{-- Comentario Nova Tech: Arquivo resources/views/admin/products/edit.blade.php. Origem: Views administrativas. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto | Nova Tech Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f4f4f5; color: #18181b; font-family: 'Inter', sans-serif; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 24px; color: #71717a; font-weight: 600; font-size: 13px; transition: 0.2s; border-left: 4px solid transparent; text-decoration: none; }
        .sidebar-item.active { color: #18181b; background: #fff; border-left-color: #18181b; }
        .sidebar-item:hover:not(.active) { color: #18181b; background: #fdfdfd; }
        input, select, textarea { background: #ffffff !important; border: 1px solid #e4e4e7 !important; color: #18181b !important; }
        input:focus, select:focus, textarea:focus { border-color: #18181b !important; outline: none; }
    </style>
    <x-admin-theme-styles />
</head>
<body class="admin-theme flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-zinc-200 flex flex-col fixed h-full">
        <div class="p-6 mb-4">
            <div class="flex items-center">
                <img src="{{ asset('images/nova-tech-logo.png') }}" alt="Nova Tech" class="h-10 w-auto max-w-[150px] object-contain">
            </div>
        </div>
        <nav class="flex-1">
            <a href="{{ route('home', ['site' => 1]) }}" class="sidebar-item">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                HOME
            </a>
            <a href="{{ route('admin.products.index') }}" class="sidebar-item active">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                PRODUTOS
            </a>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                PEDIDOS
            </a>
            <a href="{{ route('admin.sales') }}" class="sidebar-item">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                VENDAS
            </a>
        </nav>
        <div class="p-6 border-t border-zinc-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-zinc-400 hover:text-red-500 text-xs font-bold transition">SAIR</button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 ml-64 p-10">

        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Editar Produto</h1>
                <p class="text-zinc-500 text-sm">Admin > Produtos >
                    <span class="text-zinc-700 font-medium">{{ $product->name }}</span>
                </p>
            </div>
            <a href="{{ route('admin.products.index') }}"
               class="inline-flex items-center gap-2 border border-zinc-200 hover:border-zinc-400 text-zinc-600 hover:text-zinc-900 text-xs font-bold px-4 py-2.5 rounded-lg transition">
                Voltar
            </a>
        </header>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm mb-6">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex gap-6 items-start">

            <!-- FORMULARIO -->
            <div class="flex-1 bg-white border border-zinc-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-base font-bold text-zinc-800 mb-6">Dados do Produto</h2>

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-5">
                        <div>
                            <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Nome do Smartphone</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                   class="w-full rounded-lg p-3 text-sm" required>
                        </div>
                        <div>
                            <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Marca</label>
                            <select name="category" class="w-full rounded-lg p-3 text-sm" required>
                                <option value="Apple"   {{ $product->category === 'Apple'   ? 'selected' : '' }}>Apple</option>
                                <option value="Samsung" {{ $product->category === 'Samsung' ? 'selected' : '' }}>Samsung</option>
                                <option value="Xiaomi"  {{ $product->category === 'Xiaomi'  ? 'selected' : '' }}>Xiaomi</option>
                                <option value="Motorola" {{ $product->category === 'Motorola' ? 'selected' : '' }}>Motorola</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Descricao</label>
                            <textarea name="description" rows="3" class="w-full rounded-lg p-3 text-sm" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Preco (R$)</label>
                                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                                       class="w-full rounded-lg p-3 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">URL da Imagem</label>
                                <input type="url" name="image" value="{{ old('image', $product->image) }}"
                                       class="w-full rounded-lg p-3 text-sm" placeholder="https://...">
                            </div>
                        </div>
                        <button type="submit"
                                class="w-full bg-zinc-900 hover:bg-zinc-800 text-white font-bold py-4 rounded-xl transition mt-2 text-xs uppercase tracking-widest shadow-lg shadow-zinc-200">
                            SALVAR ALTERACOES
                        </button>
                    </div>
                </form>
            </div>

            <!-- PREVIEW -->
            <div class="w-72 bg-white border border-zinc-200 rounded-2xl p-6 shadow-sm sticky top-10">
                <h2 class="text-xs font-bold text-zinc-500 uppercase tracking-wider mb-4">Preview</h2>
                <div class="w-full h-48 bg-zinc-100 rounded-xl flex items-center justify-center overflow-hidden mb-4">
                    @if($product->image)
                        <img id="preview-img" src="{{ $product->image }}" alt="{{ $product->name }}"
                             class="max-w-full max-h-full object-contain">
                    @else
                        <svg id="preview-placeholder" class="w-10 h-10 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    @endif
                </div>
                <p class="font-bold text-zinc-800 text-sm" id="preview-name">{{ $product->name }}</p>
                <p class="text-xs text-zinc-400 mt-1" id="preview-brand">{{ $product->category }}</p>
                <p class="text-lg font-bold text-zinc-900 mt-3" id="preview-price">
                    R$ {{ number_format($product->price, 2, ',', '.') }}
                </p>
            </div>

        </div>
    </main>

    <script>
        // Atualiza o preview em tempo real
        document.querySelector('[name=name]').addEventListener('input', function() {
            document.getElementById('preview-name').textContent = this.value || '-';
        });
        document.querySelector('[name=category]').addEventListener('change', function() {
            document.getElementById('preview-brand').textContent = this.value;
        });
        document.querySelector('[name=price]').addEventListener('input', function() {
            const val = parseFloat(this.value);
            document.getElementById('preview-price').textContent = isNaN(val)
                ? 'R$ -'
                : 'R$ ' + val.toFixed(2).replace('.', ',');
        });
        document.querySelector('[name=image]').addEventListener('input', function() {
            const img = document.getElementById('preview-img');
            if (this.value) {
                if (!img) {
                    const placeholder = document.getElementById('preview-placeholder');
                    const newImg = document.createElement('img');
                    newImg.id = 'preview-img';
                    newImg.className = 'max-w-full max-h-full object-contain';
                    placeholder?.replaceWith(newImg);
                }
                document.getElementById('preview-img').src = this.value;
            }
        });
    </script>
</body>
</html>

