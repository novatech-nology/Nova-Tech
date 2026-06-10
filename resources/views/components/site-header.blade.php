{{-- Comentario Nova Tech: Arquivo resources/views/components/site-header.blade.php. Origem: Componentes visuais Blade. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
@props(['active' => ''])

@php
    $isAdmin = Auth::check() && (Auth::user()->role ?? null) === 'admin';
    $homeUrl = route('home', Auth::check() ? ['site' => 1] : []);
    $cartCount = Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') : 0;
@endphp

<style>
    .nt-header {
        position: sticky;
        top: 0;
        z-index: 80;
        width: 100%;
        border-bottom: 1px solid rgba(63, 63, 70, .72);
        background: rgba(9, 9, 11, .92);
        backdrop-filter: blur(18px);
    }

    .nt-header-shell {
        width: min(1180px, calc(100% - 32px));
        min-height: 74px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: minmax(150px, 1fr) auto minmax(150px, 1fr);
        align-items: center;
        gap: 18px;
    }

    .nt-brand {
        display: inline-flex;
        align-items: center;
        justify-self: start;
    }

    .nt-brand img {
        width: auto;
        height: 48px;
        max-width: 168px;
        object-fit: contain;
        border-radius: 6px;
    }

    .nt-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .nt-nav a,
    .nt-account-summary,
    .nt-auth-link {
        min-height: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        color: #a1a1aa;
        padding: 0 14px;
        font-size: 14px;
        font-weight: 800;
        text-decoration: none;
        transition: background .18s ease, color .18s ease, border-color .18s ease;
        white-space: nowrap;
    }

    .nt-nav a:hover,
    .nt-nav a.is-active,
    .nt-auth-link:hover,
    .nt-account[open] .nt-account-summary,
    .nt-account-summary:hover {
        color: #fff;
        background: rgba(255, 255, 255, .07);
    }

    .nt-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        justify-self: end;
    }

    .nt-account {
        position: relative;
    }

    .nt-account-summary {
        border: 1px solid rgba(126, 10, 133, .38);
        background: rgba(126, 10, 133, .12);
        color: #f5f3ff;
        cursor: pointer;
        list-style: none;
    }

    .nt-account-summary::-webkit-details-marker {
        display: none;
    }

    .nt-account-summary svg {
        width: 15px;
        height: 15px;
        transition: transform .18s ease;
    }

    .nt-account[open] .nt-account-summary svg {
        transform: rotate(180deg);
    }

    .nt-menu {
        position: absolute;
        top: calc(100% + 10px);
        right: 0;
        width: 220px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 8px;
        background: #111113;
        box-shadow: 0 24px 54px rgba(0, 0, 0, .45);
    }

    .nt-menu a,
    .nt-menu button {
        width: 100%;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border: 0;
        background: transparent;
        color: #d4d4d8;
        padding: 0 14px;
        font: inherit;
        font-size: 13px;
        font-weight: 800;
        text-align: left;
        text-decoration: none;
        cursor: pointer;
    }

    .nt-menu a:hover,
    .nt-menu button:hover {
        background: rgba(126, 10, 133, .14);
        color: #fff;
    }

    .nt-menu .nt-danger {
        color: #fca5a5;
    }

    .nt-count {
        min-width: 20px;
        height: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: #7e0a85;
        color: #fff;
        padding: 0 6px;
        font-size: 11px;
        font-weight: 900;
    }

    .nt-auth-link.nt-primary {
        background: #7e0a85;
        color: #fff;
    }

    .nt-auth-link.nt-primary:hover {
        background: #5c0760;
    }

    @media (max-width: 820px) {
        .nt-header-shell {
            min-height: auto;
            padding: 12px 0;
            grid-template-columns: 1fr;
            justify-items: center;
        }

        .nt-brand,
        .nt-actions {
            justify-self: center;
        }

        .nt-nav {
            width: 100%;
            flex-wrap: wrap;
        }

        .nt-actions {
            width: 100%;
            flex-wrap: wrap;
            justify-content: center;
        }

        .nt-menu {
            left: 50%;
            right: auto;
            transform: translateX(-50%);
        }
    }
</style>

<header class="nt-header">
    <div class="nt-header-shell">
        <a class="nt-brand" href="{{ $homeUrl }}" aria-label="Nova Tech">
            <img src="{{ asset('images/nova-tech-logo.png') }}" alt="Nova Tech">
        </a>

        <nav class="nt-nav" aria-label="Navegacao principal">
            <a class="{{ $active === 'home' ? 'is-active' : '' }}" href="{{ $homeUrl }}">Inicio</a>
            <a class="{{ $active === 'loja' ? 'is-active' : '' }}" href="{{ route('loja') }}">Loja</a>
            <a class="{{ $active === 'support' ? 'is-active' : '' }}" href="{{ route('support') }}">Suporte</a>
        </nav>

        <div class="nt-actions">
            @auth
                <details class="nt-account">
                    <summary class="nt-account-summary">
                        {{ $isAdmin ? 'Admin' : 'Perfil' }}
                        <svg fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </summary>

                    <div class="nt-menu">
                        @if($isAdmin)
                            <a href="{{ route('admin.dashboard') }}">Painel Admin</a>
                        @endif
                        <a href="{{ route('profile.edit') }}">Editar Perfil</a>
                        <a href="{{ route('cart.index') }}">
                            Ver Carrinho
                            @if($cartCount > 0)
                                <span class="nt-count">{{ $cartCount }}</span>
                            @endif
                        </a>
                        @unless($isAdmin)
                            <a href="{{ route('orders.index') }}">Meus Pedidos</a>
                        @endunless
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nt-danger" type="submit">Sair</button>
                        </form>
                    </div>
                </details>
            @else
                <a class="nt-auth-link" href="{{ route('login') }}">Entrar</a>
                <a class="nt-auth-link nt-primary" href="{{ route('register') }}">Cadastrar</a>
            @endauth
        </div>
    </div>
</header>
