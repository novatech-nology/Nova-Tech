<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrador | Nova Tech</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-color: #09090b;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
        }
        .hero-bg {
            background: radial-gradient(circle at 75% 40%, rgba(139, 92, 246, 0.1) 0%, #09090b 50%);
            min-height: 100vh;
        }
        .tech-card {
            background-color: #121214;
            border: 1px solid #27272a;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }
        .btn-admin {
            background-color: #7C3AED;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-admin:hover { background-color: #6D28D9; transform: translateY(-2px); }
    </style>
</head>
<body class="hero-bg">
    <header class="w-full lg:max-w-7xl mx-auto px-6 py-6 flex justify-between items-center border-b border-zinc-800/50">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center font-bold">N</div>
            <span class="font-bold tracking-tight text-lg">ADMIN <span class="text-purple-500">PANEL</span></span>
        </div>

        <div class="flex items-center gap-6">
            <span class="text-zinc-400 text-sm">Olá, <span class="text-white font-medium">{{ Auth::user()->name }}</span></span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-zinc-500 hover:text-red-500 text-sm transition">Sair</button>
            </form>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-10">
            <h1 class="text-4xl font-bold font-heading mb-2">Dashboard Administrativo</h1>
            <p class="text-zinc-400">Gerencie sua loja e seus produtos de tecnologia.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="tech-card p-8 flex flex-col items-start gap-4">
                <div class="w-12 h-12 bg-purple-600/20 rounded-full flex items-center justify-center text-purple-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-1">Produtos</h3>
                    <p class="text-zinc-400 text-sm mb-6">Adicione novos smartphones ou gerencie os existentes no estoque.</p>
                </div>

                <a href="{{ route('admin.products.create') }}" class="btn-admin w-full justify-center">
                    CADASTRAR PRODUTO
                </a>
                <a href="{{ route('admin.products.index') }}" class="text-zinc-500 hover:text-white text-xs w-full text-center mt-2 underline">
                    Ver todos os produtos
                </a>
            </div>

            <div class="tech-card p-8 flex flex-col items-start gap-4">
                <div class="w-12 h-12 bg-zinc-800 rounded-full flex items-center justify-center text-zinc-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-1">Minha Conta</h3>
                    <p class="text-zinc-400 text-sm mb-6">Atualize suas informações de acesso e segurança.</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="w-full border border-zinc-700 py-3 rounded-lg text-center font-medium hover:bg-zinc-800 transition">
                    EDITAR PERFIL
                </a>
            </div>

        </div>
    </main>
</body>
</html>-------
