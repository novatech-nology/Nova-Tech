<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Nova Tech') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            body {
                background-color: #09090b !important;
                color: #ffffff !important;
                font-family: 'Inter', sans-serif;
            }

            h1, h2, h3, h4, .font-heading {
                font-family: 'Instrument Sans', sans-serif;
            }

            /* Brilho de fundo roxo (Hero Section) */
            .hero-bg {
                background: radial-gradient(circle at 75% 40%, rgba(139, 92, 246, 0.15) 0%, #09090b 50%);
            }

            /* Estilo dos cards escuros com borda sutil */
            .tech-card {
                background-color: #121214;
                border: 1px solid #27272a;
                border-radius: 0.75rem;
                padding: 1.5rem;
                transition: all 0.3s ease;
            }
            .tech-card:hover {
                border-color: #8B5CF6;
                transform: translateY(-2px);
            }

            /* Botões Roxos */
            .btn-purple {
                background-color: #7C3AED;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                transition: background-color 0.3s;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 0.5rem;
                font-weight: 500;
            }
            .btn-purple:hover {
                background-color: #6D28D9;
            }

            /* Pódio dos celulares na imagem */
            .podium-base {
                width: 300px;
                height: 60px;
                background: linear-gradient(180deg, #1f1f22 0%, #09090b 100%);
                border-radius: 50%;
                position: absolute;
                bottom: -20px;
                box-shadow: 0 0 80px 20px rgba(139, 92, 246, 0.3);
            }
        </style>
    </head>

    <body class="min-h-screen flex flex-col items-center">

        <header class="w-full lg:max-w-7xl px-6 lg:px-12 py-6 flex justify-between items-center border-b border-zinc-800/50 relative z-50">
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center font-bold text-white group-hover:bg-purple-500 transition">N</div>
                <div class="leading-tight">
                    <span class="font-bold text-lg tracking-tight block">NOVA</span>
                    <span class="font-bold text-lg tracking-tight block -mt-1">TECH</span>
                </div>
            </a>

            <nav class="hidden lg:flex items-center gap-8 text-sm font-medium text-zinc-400">
                <a href="/" class="text-purple-500">Início</a>
                <a href="/loja" class="hover:text-white transition">Loja</a>
                <a href="#sobre-nos" class="hover:text-white transition">Sobre Nós</a>
                <a href="#suporte" class="hover:text-white transition">Suporte</a>
            </nav>

            <div class="flex items-center gap-6">
                <div class="flex items-center gap-4 text-zinc-400">
                    <button class="hover:text-white transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                    <button class="hover:text-white transition relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="absolute -top-2 -right-2 bg-purple-600 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full font-bold">0</span>
                    </button>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-4 border-l border-zinc-800 pl-6">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-purple-400 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium hover:text-purple-400 transition">Entrar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-purple py-2 px-4 text-sm">Cadastrar</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </header>

        <main class="w-full hero-bg">
            <div class="w-full lg:max-w-7xl mx-auto px-6 lg:px-12">

                <div class="flex flex-col lg:flex-row items-center justify-between py-20 lg:py-32 gap-12">
                    <div class="flex-1 max-w-2xl">
                        <h1 class="text-5xl lg:text-7xl font-bold leading-tight mb-6 font-heading">
                            Tecnologia de <br>
                            <span class="text-purple-500">última geração</span> <br>
                            na sua mão.
                        </h1>
                        <p class="text-zinc-400 text-lg mb-10 max-w-md">
                            Os melhores smartphones com os melhores preços e condições para você.
                        </p>
                        <a href="/loja" class="btn-purple text-lg mb-12">
                            Ver produtos
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>

                        <div class="flex items-center gap-6 text-sm text-zinc-400">
                            <div class="flex items-center gap-2">
                                <span class="text-purple-500">🛡️</span> Garant
