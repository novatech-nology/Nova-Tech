{{-- Comentario Nova Tech: Arquivo resources/views/admin/sales.blade.php. Origem: Views administrativas. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas | Nova Tech Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|instrument-sans:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { background-color: #f4f4f5; color: #18181b; font-family: 'Inter', sans-serif; }
        .sidebar-item { display: flex; align-items: center; gap: 12px; padding: 12px 24px; color: #71717a; font-weight: 600; font-size: 13px; transition: 0.2s; border-left: 4px solid transparent; }
        .sidebar-item.active { color: #18181b; background: #fff; border-left-color: #18181b; }
        .sidebar-item:hover:not(.active) { color: #18181b; background: #fdfdfd; }
        .stat-card { background: #fff; border: 1px solid #e4e4e7; border-radius: 12px; padding: 20px 24px; }
        .stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
    </style>
    <x-admin-theme-styles />
</head>
<body class="admin-theme flex min-h-screen">

@php
    $meses = [
        1  => 'Janeiro',   2  => 'Fevereiro', 3  => 'Março',
        4  => 'Abril',     5  => 'Maio',      6  => 'Junho',
        7  => 'Julho',     8  => 'Agosto',    9  => 'Setembro',
        10 => 'Outubro',   11 => 'Novembro',  12 => 'Dezembro'
    ];
    $mesAtual = $meses[now()->month] . ', ' . now()->year;
@endphp

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
            <a href="{{ route('admin.orders') }}" class="sidebar-item">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                PEDIDOS
            </a>
            <a href="{{ route('admin.sales') }}" class="sidebar-item active">
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
                <h1 class="text-2xl font-bold text-zinc-900">Vendas</h1>
                <p class="text-zinc-500 text-sm">Admin > Vendas</p>
            </div>
            <div class="flex items-center gap-2 text-zinc-500 font-medium bg-white px-4 py-2 rounded-lg border border-zinc-200 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $mesAtual }}
            </div>
        </header>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="stat-card">
                <div class="flex items-center gap-3 mb-3">
                    <div class="stat-icon bg-blue-50">R$</div>
                    <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Total de Vendas</span>
                </div>
                <div class="text-2xl font-bold text-zinc-900" style="font-family:'Instrument Sans',sans-serif;">
                    R$ {{ number_format($totalSales, 2, ',', '.') }}
                </div>
            </div>

            <div class="stat-card">
                <div class="flex items-center gap-3 mb-3">
                    <div class="stat-icon bg-emerald-50">MÊS</div>
                    <span class="text-xs font-bold text-zinc-400 uppercase tracking-wider">Vendas este mês</span>
                </div>
                <div class="text-2xl font-bold text-zinc-900" style="font-family:'Instrument Sans',sans-serif;">
                    R$ {{ number_format($monthlySales, 2, ',', '.') }}
                </div>
                <div class="text-xs text-zinc-400 mt-1">{{ $mesAtual }}</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Grafico de pizza por categoria -->
            <div class="bg-white rounded-xl border border-zinc-200 shadow-sm p-6">
                <h2 class="font-bold text-zinc-800 mb-6">Vendas por Categorias</h2>
                @if($salesByCategory->isEmpty())
                    <div class="flex items-center justify-center h-48 text-zinc-400 text-sm">Nenhuma venda registrada.</div>
                @else
                    <div class="flex items-center justify-center mb-6">
                        <canvas id="categoryChart" width="220" height="220" style="max-width:220px;max-height:220px;"></canvas>
                    </div>
                    <div class="space-y-3">
                        @php
                            $colors = ['#7e0a85','#a52cad','#d400b8','#06b6d4','#10b981','#f59e0b'];
                            $totalRevenue = $salesByCategory->sum('total_revenue');
                        @endphp
                        @foreach($salesByCategory as $i => $cat)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full flex-shrink-0" style="background:{{ $colors[$i % count($colors)] }}"></div>
                                <span class="text-sm font-medium text-zinc-700">{{ $cat->category }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-sm font-bold text-zinc-900">{{ $totalRevenue > 0 ? round(($cat->total_revenue / $totalRevenue) * 100) : 0 }}%</span>
                                <span class="text-xs text-zinc-400 ml-2">R$ {{ number_format($cat->total_revenue, 2, ',', '.') }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Produtos mais vendidos -->
            <div class="bg-white rounded-xl border border-zinc-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-zinc-100">
                    <h2 class="font-bold text-zinc-800">Mais Vendidos</h2>
                </div>
                @if($topProducts->isEmpty())
                    <div class="flex items-center justify-center h-48 text-zinc-400 text-sm">Nenhuma venda registrada.</div>
                @else
                    <div class="divide-y divide-zinc-50">
                        @foreach($topProducts as $i => $product)
                        <div class="flex items-center gap-4 px-6 py-4 hover:bg-zinc-50 transition">
                            <span class="text-xs font-bold text-zinc-300 w-4">{{ $i + 1 }}</span>
                            <div class="w-10 h-10 bg-zinc-100 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden">
                                @if($product->image)
                                    <img
                                        src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-contain"
                                    >
                                @else
                                    <svg class="w-5 h-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-semibold text-zinc-800 truncate">{{ $product->name }}</div>
                                <div class="text-xs text-zinc-400">{{ $product->category }} - {{ $product->total_sold }} vendido(s)</div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <div class="text-sm font-bold text-zinc-900">R$ {{ number_format($product->total_revenue, 2, ',', '.') }}</div>
                                <div class="text-xs text-zinc-400">receita total</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </main>

    @if($salesByCategory->isNotEmpty())
    <script>
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($salesByCategory->pluck('category')) !!},
                datasets: [{
                    data: {!! json_encode($salesByCategory->pluck('total_revenue')->map(fn($v) => round($v, 2))) !!},
                    backgroundColor: ['#7e0a85','#a52cad','#d400b8','#06b6d4','#10b981','#f59e0b'],
                    borderWidth: 0,
                    hoverOffset: 6,
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: (ctx) => ` R$ ${ctx.parsed.toLocaleString('pt-BR', {minimumFractionDigits:2})}`
                        }
                    }
                }
            }
        });
    </script>
    @endif
</body>
</html>
