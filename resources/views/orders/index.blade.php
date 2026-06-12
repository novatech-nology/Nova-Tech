{{-- Comentario Nova Tech: Arquivo resources/views/orders/index.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos | Nova Tech</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #09090b; color: #ffffff; font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-heading { font-family: 'Instrument Sans', sans-serif; }
        .order-card { background-color: #121214; border: 1px solid #27272a; border-radius: 0.75rem; transition: border-color 0.2s, transform 0.2s; }
        .order-card:hover { border-color: #3f3f46; }
        .btn-purple { background-color: #7e0a85; color: white; transition: background-color 0.2s, transform 0.2s; }
        .btn-purple:hover { background-color: #5c0760; transform: translateY(-1px); }
        .btn-outline { background-color: transparent; border: 1px solid #3f3f46; color: #a1a1aa; transition: all 0.2s; }
        .btn-outline:hover { border-color: #7e0a85; color: #ffffff; }
        .empty-state { background: radial-gradient(circle at 50% 50%, rgba(139, 92, 246, 0.08) 0%, transparent 70%); }
        .status-pill { border: 1px solid rgba(126, 10, 133, .35); background: rgba(126, 10, 133, .12); color: #d400b8; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <x-site-header />

    <main class="flex-1 w-full lg:max-w-7xl mx-auto px-6 lg:px-12 py-12">
        <div class="mb-8">
            <div>
                <h1 class="text-3xl font-bold font-heading">Meus Pedidos</h1>
                <p class="text-zinc-500 text-sm mt-1">
                    {{ $orders->count() }} {{ $orders->count() === 1 ? 'pedido realizado' : 'pedidos realizados' }} 
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-950 border border-green-800 text-green-400 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="empty-state flex flex-col items-center justify-center py-32 text-center">
                <div class="w-20 h-20 bg-zinc-900 border border-zinc-800 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold font-heading text-zinc-300 mb-2">Voce ainda não realizou pedidos</h2>
                <p class="text-zinc-500 text-sm mb-8">Explore nossa loja e acompanhe suas compras por aqui.</p>
                <a href="{{ route('loja') }}" class="btn-purple px-6 py-3 rounded-xl font-semibold text-sm">
                    Ver produtos
                </a>
            </div>
        @else
            <div class="flex flex-col gap-5">
                @foreach($orders as $order)
                    @php
                        $itemsCount = $order->items->sum('quantity');
                        $paymentLabel = match ($order->payment_method) {
                            'pix' => 'PIX',
                            'credit_card' => 'Cartão',
                            default => $order->payment_method ? ucfirst(str_replace('_', ' ', $order->payment_method)) : 'Pagamento',
                        };
                    @endphp

                    <article class="order-card overflow-hidden">
                        <div class="p-5 sm:p-6 border-b border-zinc-800 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                            <div class="flex items-start gap-4">
                                <div class="w-14 h-14 bg-zinc-900 border border-zinc-800 rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>

                                <div>
                                    <div class="flex items-center gap-3 flex-wrap">
                                        <h2 class="font-heading text-lg font-bold">Pedido #{{ $order->id }}</h2>
                                        <span class="status-pill px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
                                            {{ $order->status ?? 'confirmado' }}
                                        </span>
                                    </div>
                                    <p class="text-zinc-500 text-sm mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-zinc-500 text-xs mt-2">
                                        {{ $itemsCount }} {{ $itemsCount === 1 ? 'item' : 'itens' }} • {{ $paymentLabel }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center gap-4 lg:text-right">
                                <div>
                                    <p class="text-xs text-zinc-500">Total</p>
                                    <p class="font-bold text-xl text-purple-400">
                                        R$ {{ number_format($order->total, 2, ',', '.') }}
                                    </p>
                                </div>

                                
                            </div>
                        </div>

                        <div class="p-5 sm:p-6 space-y-4">
                            @foreach($order->items as $item)
                                @php
                                    $product = $item->product;
                                    $itemName = $product->name ?? $item->name ?? 'Produto removido';
                                    $image = $product->image ?? null;
                                    $subtotal = $item->subtotal ?? ($item->price * $item->quantity);
                                @endphp

                                <div class="flex items-center gap-5">
                                    <div class="w-20 h-20 bg-zinc-900 rounded-xl flex items-center justify-center shrink-0 overflow-hidden border border-zinc-800">
                                        @if($image)
                                            <img
                                                src="{{ str_starts_with($image, 'http') ? $image : asset('storage/' . $image) }}"
                                                alt="{{ $itemName }}"
                                                class="w-full h-full object-contain p-2"
                                            >
                                        @else
                                            <svg class="w-8 h-8 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-white truncate">{{ $itemName }}</p>
                                        <p class="text-zinc-500 text-xs mt-0.5">{{ $product->category ?? 'Produto' }}</p>
                                        <p class="text-purple-400 font-bold mt-1 text-sm">
                                            R$ {{ number_format($item->price, 2, ',', '.') }}
                                        </p>
                                    </div>

                                    <div class="hidden sm:flex items-center gap-2 shrink-0">
                                        <span class="text-zinc-400 text-xs">Qtd:</span>
                                        <span class="bg-zinc-900 border border-zinc-700 text-white text-sm font-bold w-8 h-8 flex items-center justify-center rounded-lg">
                                            {{ $item->quantity }}
                                        </span>
                                    </div>

                                    <div class="text-right shrink-0 w-28 hidden md:block">
                                        <p class="text-xs text-zinc-500">Subtotal</p>
                                        <p class="font-bold text-white">
                                            R$ {{ number_format($subtotal, 2, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>
