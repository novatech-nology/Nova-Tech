{{-- Comentario Nova Tech: Arquivo resources/views/cart/index.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho | Nova Tech</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #09090b; color: #ffffff; font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-heading { font-family: 'Instrument Sans', sans-serif; }
        .cart-card { background-color: #121214; border: 1px solid #27272a; border-radius: 0.75rem; transition: border-color 0.2s; }
        .cart-card:hover { border-color: #3f3f46; }
        .btn-purple { background-color: #7e0a85; color: white; transition: background-color 0.2s; }
        .btn-purple:hover { background-color: #5c0760; }
        .btn-danger { background-color: transparent; border: 1px solid #3f3f46; color: #71717a; transition: all 0.2s; }
        .btn-danger:hover { border-color: #ef4444; color: #ef4444; }
        .empty-state { background: radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.08) 0%, transparent 70%); }

        /* Controles de quantidade */
        .qty-btn {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            border: 1px solid #3f3f46;
            background: transparent;
            color: #a1a1aa;
            font-size: 16px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .18s ease;
            flex-shrink: 0;
        }
        .qty-btn:hover { border-color: #7e0a85; color: #fff; background: rgba(126,10,133,.15); }
        .qty-btn:disabled { opacity: .35; cursor: not-allowed; pointer-events: none; }
        .qty-display {
            min-width: 32px;
            height: 28px;
            border-radius: 8px;
            background: #1a1a1f;
            border: 1px solid #2f2f35;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    {{-- HEADER --}}
    <x-site-header />

    {{-- CONTEÚDO PRINCIPAL --}}
    <main class="flex-1 w-full lg:max-w-7xl mx-auto px-6 lg:px-12 py-12">

        <div class="mb-8">
            <h1 class="text-3xl font-bold font-heading">Meu Carrinho</h1>
            <p class="text-zinc-500 text-sm mt-1">
                {{ $cartItems->count() }} {{ $cartItems->count() === 1 ? 'item' : 'itens' }} no carrinho
            </p>
        </div>

        {{-- ALERTAS --}}
        @if(session('success'))
            <div class="mb-6 bg-green-950 border border-green-800 text-green-400 px-4 py-3 rounded-lg text-sm">
                ✓ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 bg-red-950 border border-red-800 text-red-400 px-4 py-3 rounded-lg text-sm">
                ✕ {{ session('error') }}
            </div>
        @endif

        @if($cartItems->isEmpty())
            {{-- CARRINHO VAZIO --}}
            <div class="empty-state flex flex-col items-center justify-center py-32 text-center">
                <div class="w-20 h-20 bg-zinc-900 border border-zinc-800 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold font-heading text-zinc-300 mb-2">Seu carrinho está vazio</h2>
                <p class="text-zinc-500 text-sm mb-8">Explore nossa loja e adicione produtos ao carrinho.</p>
                <a href="{{ route('loja') }}" class="btn-purple px-6 py-3 rounded-xl font-semibold text-sm">
                    Ver produtos
                </a>
            </div>

        @else
            <div class="flex flex-col lg:flex-row gap-8">

                {{-- LISTA DE ITENS --}}
                <div class="flex-1 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="cart-card p-5 flex items-center gap-5">

                            {{-- Imagem do produto --}}
                            <div class="w-20 h-20 bg-zinc-900 rounded-xl flex items-center justify-center shrink-0 overflow-hidden border border-zinc-800">
                                @if($item->product->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-xl">
                                @else
                                    <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-white truncate">{{ $item->product->name }}</p>
                                <p class="text-zinc-500 text-xs mt-0.5">{{ $item->product->category }}</p>
                                <p class="text-purple-400 font-bold mt-1 text-sm">
                                    R$ {{ number_format($item->product->price, 2, ',', '.') }}
                                </p>
                            </div>

                            {{-- Controle de quantidade --}}
                            <div class="flex items-center gap-2 shrink-0">
                                {{-- Botão − : se qty = 1, remove o item; se > 1, decrementa --}}
                                @if($item->quantity > 1)
                                    <form method="POST" action="{{ route('cart.update', $item->product_id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                        <button type="submit" class="qty-btn" title="Diminuir quantidade">−</button>
                                    </form>
                                @else
                                    {{-- qty = 1: − remove o item --}}
                                    <form method="POST" action="{{ route('cart.remove', $item->product_id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="qty-btn" title="Remover item">−</button>
                                    </form>
                                @endif

                                <span class="qty-display">{{ $item->quantity }}</span>

                                {{-- Botão + : incrementa --}}
                                <form method="POST" action="{{ route('cart.update', $item->product_id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit" class="qty-btn" title="Aumentar quantidade">+</button>
                                </form>
                            </div>

                            {{-- Subtotal --}}
                            <div class="text-right shrink-0 w-28 hidden sm:block">
                                <p class="text-xs text-zinc-500">Subtotal</p>
                                <p class="font-bold text-white">
                                    R$ {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}
                                </p>
                            </div>

                            {{-- Remover --}}
                            <form method="POST" action="{{ route('cart.remove', $item->product_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger p-2 rounded-lg" title="Remover">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- RESUMO DO PEDIDO --}}
                <div class="lg:w-80 shrink-0">
                    <div class="cart-card p-6 sticky top-6">
                        <h2 class="font-bold font-heading text-lg mb-6">Resumo do Pedido</h2>

                        <div class="space-y-3 mb-6">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-zinc-400 truncate max-w-[160px]">{{ $item->product->name }} x{{ $item->quantity }}</span>
                                    <span class="text-zinc-300 font-medium shrink-0">
                                        R$ {{ number_format($item->product->price * $item->quantity, 2, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-zinc-800 pt-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-zinc-400 text-sm">Frete</span>
                                <span class="text-green-400 text-sm font-semibold">Grátis</span>
                            </div>
                            <div class="flex justify-between items-center mt-3">
                                <span class="font-bold text-lg">Total</span>
                                <span class="font-bold text-xl text-purple-400">
                                    R$ {{ number_format($total, 2, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('cart.checkout') }}">
                            @csrf
                            <button type="submit" class="btn-purple w-full py-4 rounded-xl font-bold text-sm uppercase tracking-widest">
                                Finalizar Pedido
                            </button>
                        </form>

                        <a href="{{ route('loja') }}" class="block text-center text-zinc-500 hover:text-zinc-300 text-xs mt-4 transition">
                            ← Continuar comprando
                        </a>
                    </div>
                </div>

            </div>
        @endif
    </main>

</body>
</html>
