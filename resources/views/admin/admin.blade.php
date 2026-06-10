{{-- Comentario Nova Tech: Arquivo resources/views/admin/admin.blade.php. Origem: Views administrativas. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador | Nova Tech</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { background-color: #f4f4f5; color: #18181b; font-family: 'Inter', sans-serif; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 24px; color: #71717a; font-weight: 600; font-size: 13px; transition: 0.2s; border-left: 4px solid transparent; text-decoration: none; }
        .sidebar-item.active { color: #18181b; background: #fff; border-left-color: #18181b; }
        .sidebar-item:hover:not(.active) { color: #18181b; background: #fdfdfd; }
        .status-badge { display: inline-flex; align-items: center; gap: 4px; padding: 3px 10px; border-radius: 99px; font-size: 11px; font-weight: 600; }
        .status-confirmado { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }
        .status-pendente { background: #fefce8; color: #a16207; border: 1px solid #fef08a; }
        .status-enviado { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
        .status-entregue { background: #f0fdf4; color: #166534; border: 1px solid #86efac; }
        .status-cancelado { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
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
            <a href="{{ route('admin.products.create') }}" class="sidebar-item">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                PRODUTOS
            </a>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item active">
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
                <h1 class="text-2xl font-bold text-zinc-900">Pedidos</h1>
                <p class="text-zinc-500 text-sm">Admin > Pedidos</p>
            </div>
            <div class="flex items-center gap-2 text-zinc-500 font-medium bg-white px-4 py-2 rounded-lg border border-zinc-200 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ now()->format('F, Y') }}
            </div>
        </header>

        <div class="bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
            <div class="p-6 flex justify-between items-center border-b border-zinc-100">
                <h2 class="font-bold text-zinc-800">Pedidos Recentes</h2>
                <span class="text-xs text-zinc-400 font-medium">{{ $orders->total() }} pedidos no total</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-zinc-400 text-xs uppercase tracking-wider border-b border-zinc-100 bg-zinc-50">
                            <th class="px-6 py-4 font-semibold">Pedido</th>
                            <th class="px-6 py-4 font-semibold">Produto(s)</th>
                            <th class="px-6 py-4 font-semibold">Data</th>
                            <th class="px-6 py-4 font-semibold">Pagamento</th>
                            <th class="px-6 py-4 font-semibold">Cliente</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                            <th class="px-6 py-4 font-semibold">Valor</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-zinc-700 divide-y divide-zinc-50">
                        @forelse($orders as $order)
                        <tr class="hover:bg-zinc-50 transition">
                            <td class="px-6 py-4 text-zinc-400 font-mono font-medium">
                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="max-w-[200px]">
                                    @foreach($order->items->take(2) as $item)
                                        <div class="font-medium text-zinc-800 truncate">{{ $item->product->name ?? 'Produto removido' }}</div>
                                    @endforeach
                                    @if($order->items->count() > 2)
                                        <div class="text-zinc-400 text-xs">+{{ $order->items->count() - 2 }} item(s)</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-zinc-500">
                                {{ $order->created_at->format('d/m/Y') }}<br>
                                <span class="text-xs text-zinc-400">{{ $order->created_at->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($order->payment_method === 'pix')
                                    <span class="text-xs font-semibold text-emerald-700">PIX</span>
                                @elseif($order->payment_method === 'credit_card')
                                    <span class="text-xs font-semibold text-blue-700">Cartão</span>
                                @else
                                    <span class="text-xs text-zinc-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-zinc-200 flex items-center justify-center text-zinc-500 font-bold text-xs">
                                        {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-zinc-800">{{ $order->user->name ?? 'Usuario removido' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-zinc-900">
                                R$ {{ number_format($order->total, 2, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center text-zinc-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                Nenhum pedido encontrado.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginacao -->
            @if($orders->hasPages())
            <div class="p-6 flex items-center gap-2 border-t border-zinc-100">
                @if($orders->onFirstPage())
                    <button disabled class="px-3 h-8 flex items-center justify-center rounded border border-zinc-200 text-xs text-zinc-300">Anterior</button>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="px-3 h-8 flex items-center justify-center rounded border border-zinc-200 text-xs hover:bg-zinc-50">Anterior</a>
                @endif

                @for($i = 1; $i <= $orders->lastPage(); $i++)
                    @if($i == $orders->currentPage())
                        <button class="w-8 h-8 flex items-center justify-center rounded bg-zinc-900 text-white text-xs font-bold">{{ $i }}</button>
                    @else
                        <a href="{{ $orders->url($i) }}" class="w-8 h-8 flex items-center justify-center rounded border border-zinc-200 text-xs hover:bg-zinc-50">{{ $i }}</a>
                    @endif
                @endfor

                @if($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" class="px-4 h-8 flex items-center justify-center rounded border border-zinc-200 text-xs font-bold hover:bg-zinc-50 ml-2">PROXIMO</a>
                @else
                    <button disabled class="px-4 h-8 flex items-center justify-center rounded border border-zinc-200 text-xs font-bold text-zinc-300 ml-2">PROXIMO</button>
                @endif
            </div>
            @endif
        </div>
    </main>
</body>
</html>

