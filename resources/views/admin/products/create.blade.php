{{-- Comentario Nova Tech: Arquivo resources/views/admin/products/create.blade.php. Origem: Views administrativas. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos | Nova Tech Admin</title>
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
        .product-list { max-height: calc(100vh - 220px); overflow-y: auto; }
        .product-list::-webkit-scrollbar { width: 3px; }
        .product-list::-webkit-scrollbar-thumb { background: #e4e4e7; border-radius: 4px; }
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
            <a href="{{ route('admin.products.create') }}" class="sidebar-item active">
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
        <header class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-zinc-900">Produtos</h1>
                <p class="text-zinc-500 text-sm">Admin > Produtos</p>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm font-medium mb-6">
                OK - {{ session('success') }}
            </div>
        @endif

        <!-- LAYOUT DUAS COLUNAS -->
        <div class="flex gap-6 items-start">

            <!-- FORMULARIO DE CADASTRO -->
            <div class="flex-1 bg-white border border-zinc-200 rounded-2xl p-8 shadow-sm">
                <h2 class="text-base font-bold text-zinc-800 mb-6">Adicionar Novo Produto</h2>

                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf
                    <div class="grid gap-5">
                        <div>
                            <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Smartphone</label>
                            <input type="text" name="name" class="w-full rounded-lg p-3 text-sm" placeholder="Ex: iPhone 16 Pro Max" required>
                        </div>
                        <div>
                            <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Marca</label>
                            <select name="category" class="w-full rounded-lg p-3 text-sm" required>
                                <option value="" disabled selected>Selecione uma marca</option>
                                <option value="Apple">Apple</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Xiaomi">Xiaomi</option>
                                <option value="Motorola">Motorola</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Descrição</label>
                            <textarea name="description" rows="3" class="w-full rounded-lg p-3 text-sm" placeholder="Detalhes tecnicos..." required></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">Preço (R$)</label>
                                <input type="number" step="0.01" name="price" class="w-full rounded-lg p-3 text-sm" placeholder="0,00" required>
                            </div>
                            <div>
                                <label class="block text-zinc-700 text-xs font-bold uppercase mb-2">URL da Imagem</label>
                                <input type="url" name="image" class="w-full rounded-lg p-3 text-sm" placeholder="https://...">
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-zinc-900 hover:bg-zinc-800 text-white font-bold py-4 rounded-xl transition mt-2 text-xs uppercase tracking-widest shadow-lg shadow-zinc-200">
                            CADASTRAR PRODUTO
                        </button>
                    </div>
                </form>
            </div>

            <!-- LISTA DE PRODUTOS -->
            <div class="w-80 bg-white border border-zinc-200 rounded-2xl shadow-sm flex flex-col">
                <div class="px-5 py-4 border-b border-zinc-100 flex items-center justify-between">
                    <h2 class="text-sm font-bold text-zinc-800">Produtos Cadastrados</h2>
                    <span class="text-xs text-zinc-400 font-medium">{{ $products->count() }}</span>
                </div>

                <div class="product-list divide-y divide-zinc-50">
                    @forelse($products as $product)
                    <div class="flex items-center gap-3 px-5 py-3 hover:bg-zinc-50 transition">
                        {{-- Imagem --}}
                        <div class="w-9 h-9 bg-zinc-100 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                            @else
                                <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="text-xs font-semibold text-zinc-800 truncate">{{ $product->name }}</div>
                            <div class="text-xs text-zinc-400">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                        </div>

                        {{-- Acoes --}}
                        <div class="flex items-center gap-1 flex-shrink-0">
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                               class="p-1.5 rounded-lg hover:bg-zinc-100 text-zinc-400 hover:text-zinc-700 transition"
                               title="Editar">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Apagar {{ addslashes($product->name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-1.5 rounded-lg hover:bg-red-50 text-zinc-400 hover:text-red-500 transition"
                                        title="Apagar">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="px-5 py-8 text-center text-zinc-400 text-xs">
                        Nenhum produto cadastrado ainda.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </main>
</body>
</html>

