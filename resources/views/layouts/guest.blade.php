{{-- Comentario Nova Tech: Arquivo resources/views/layouts/guest.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'NovaTech') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-wrapper">
            <aside class="auth-sidebar" aria-label="NovaTech">
                <a class="auth-sidebar-brand" href="/">
                    <img class="auth-brand-logo" src="{{ asset('images/nova-tech-logo.png') }}" alt="NovaTech">
                </a>

                <div class="auth-sidebar-content">
                    <span class="auth-eyebrow">Tecnologia com praticidade</span>
                    <h1>Seu acesso a uma experiência <span>NovaTech</span>.</h1>
                    <p>Entre na sua conta para acompanhar pedidos, finalizar compras e acessar ofertas selecionadas.</p>

                    <div class="auth-features" aria-label="Beneficios">
                        <div class="auth-feature">
                            <span class="auth-feature-icon">&check;</span>
                            <span>Compra segura e atendimento rápido</span>
                        </div>
                        <div class="auth-feature">
                            <span class="auth-feature-icon">&check;</span>
                            <span>Histórico de pedidos em um só lugar</span>
                        </div>
                        <div class="auth-feature">
                            <span class="auth-feature-icon">&check;</span>
                            <span>Produtos selecionados para o seu perfil</span>
                        </div>
                    </div>
                </div>
            </aside>

            <main class="auth-main">
                <div class="auth-card">
                    <a class="auth-mobile-logo" href="/">
                        <img class="auth-brand-logo" src="{{ asset('images/nova-tech-logo.png') }}" alt="NovaTech">
                    </a>

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
