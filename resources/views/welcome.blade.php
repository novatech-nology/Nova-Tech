{{-- Comentario Nova Tech: Arquivo resources/views/welcome.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Nova Tech') }}</title>
    <meta name="description" content="Nova Tech: celulares top de linha com os melhores precos.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        :root {
            --primary: #7e0a85;
            --primary-dark: #5c0760;
            --primary-light: #a52cad;
            --accent: #d400b8;
            --success: #00c48c;
            --warning: #ffb800;
            --danger: #ff4757;
            --bg: #0a0a0a;
            --surface: #111111;
            --card: #1a1a1a;
            --card-hover: #222222;
            --border: #2a2a2a;
            --border-light: #333333;
            --text: #ffffff;
            --muted: #aaaaaa;
            --soft: #666666;
            --radius: 12px;
            --radius-sm: 8px;
            --radius-lg: 20px;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
            --shadow-primary: 0 4px 24px rgba(126, 10, 133, 0.3);
            --transition: 0.2s ease;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }
        button { font-family: inherit; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            min-height: 70px;
            background: rgba(10, 10, 10, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
        }
        .navbar .container { min-height: 70px; display: flex; align-items: center; gap: 2rem; }
        .brand-logo { width: 148px; max-height: 52px; object-fit: contain; border-radius: 6px; }
        .navbar-nav { display: flex; align-items: center; gap: .25rem; margin-left: auto; }
        .navbar-nav a {
            display: flex;
            align-items: center;
            padding: .5rem .75rem;
            border-radius: var(--radius-sm);
            color: var(--muted);
            font-size: .88rem;
            font-weight: 600;
            transition: all var(--transition);
        }
        .navbar-nav a:hover, .navbar-nav a.active { color: var(--text); background: var(--card); }
        .nav-actions { display: flex; align-items: center; gap: .75rem; margin-left: 1rem; }
        .cart-link {
            position: relative;
            width: 42px;
            height: 42px;
            border-radius: var(--radius-sm);
            background: var(--card);
            border: 1px solid var(--border);
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition);
        }
        .cart-link:hover { background: var(--primary); color: #fff; border-color: var(--primary); }
        .cart-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--danger);
            color: #fff;
            font-size: .65rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--bg);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .7rem 1.5rem;
            border-radius: var(--radius-sm);
            border: 0;
            font-size: .9rem;
            font-weight: 700;
            white-space: nowrap;
            cursor: pointer;
            transition: all var(--transition);
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); box-shadow: var(--shadow-primary); transform: translateY(-1px); }
        .btn-outline { background: transparent; border: 1px solid var(--border-light); color: var(--text); }
        .btn-outline:hover { border-color: var(--primary); color: var(--primary-light); }
        .btn-ghost { background: transparent; color: var(--muted); }
        .btn-ghost:hover { color: var(--text); background: var(--card); }
        .btn-sm { padding: .45rem 1rem; font-size: .82rem; }
        .btn-lg { padding: .9rem 2rem; font-size: 1rem; }
        .hero {
            position: relative;
            min-height: 520px;
            overflow: hidden;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a0320 60%, #0a0a0a 100%);
        }
        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(126, 10, 133, .15), transparent 60%);
            pointer-events: none;
        }
        .hero-content { position: relative; z-index: 1; max-width: 560px; padding: 5rem 0; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(126, 10, 133, .15);
            border: 1px solid rgba(126, 10, 133, .3);
            border-radius: 999px;
            padding: .35rem 1rem;
            color: var(--primary-light);
            font-size: .78rem;
            font-weight: 800;
            margin-bottom: 1.25rem;
        }
        .hero h1 { font-size: clamp(2.25rem, 5vw, 4.4rem); line-height: 1.05; font-weight: 800; margin-bottom: 1rem; }
        .hero h1 span {
            background: linear-gradient(135deg, var(--primary-light), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .hero p { color: var(--muted); font-size: 1.05rem; max-width: 440px; margin-bottom: 2rem; }
        .hero-btns { display: flex; gap: 1rem; flex-wrap: wrap; }
        .hero-image {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }
        .hero-product-shadow { position: relative; width: min(68%, 360px); display: flex; align-items: center; justify-content: center; }
        .hero-product-shadow::before {
            content: "";
            position: absolute;
            inset: 11% 8% 4%;
            border-radius: 42%;
            background:
                radial-gradient(circle at 42% 45%, rgba(0, 196, 255, .26), transparent 54%),
                radial-gradient(circle at 62% 58%, rgba(126, 10, 133, .32), transparent 58%),
                rgba(0, 0, 0, .22);
            filter: blur(34px);
            transform: translate(14px, 20px) scale(.9);
        }
        .hero-product-shadow img {
            position: relative;
            z-index: 1;
            width: 100%;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 22px 36px rgba(0, 0, 0, .52));
        }
        .stats-bar { background: var(--card); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); padding: 1.25rem 0; }
        .stats-bar .container { display: flex; align-items: center; justify-content: space-around; gap: 1rem; flex-wrap: wrap; }
        .stat-item { text-align: center; }
        .stat-item .value { color: var(--primary-light); font-size: 1.5rem; font-weight: 800; }
        .stat-item .label { color: var(--soft); font-size: .78rem; }
        .section { padding: 4rem 0; }
        .section-title { display: flex; align-items: center; gap: .75rem; margin-bottom: 2rem; }
        .section-title h2 { font-size: 1.5rem; font-weight: 800; }
        .accent-line { width: 40px; height: 3px; background: var(--primary); border-radius: 2px; }
        .category-grid, .feature-grid { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; }
        .category-card, .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.25rem 1rem;
            transition: all var(--transition);
        }
        .category-card { text-align: center; }
        .category-card:hover, .card:hover { border-color: var(--primary); background: rgba(126, 10, 133, .08); transform: translateY(-2px); }
        .brand-cat-icon { height: 54px; display: flex; align-items: center; justify-content: center; margin-bottom: .5rem; }
        .brand-cat-icon img { width: 82px; height: 46px; object-fit: contain; }
        .category-card[href*="Samsung"] .brand-cat-icon img { width: 112px; }
        .cat-name { color: var(--text); font-size: .9rem; font-weight: 800; }
        .cat-count { color: var(--soft); font-size: .75rem; margin-top: .2rem; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 1.25rem; }
        .product-card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; transition: all var(--transition); }
        .product-card:hover { border-color: var(--primary); transform: translateY(-4px); box-shadow: 0 8px 32px rgba(126, 10, 133, .15); }
        .product-image { height: 190px; background: var(--surface); display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .product-image img { width: 100%; height: 100%; object-fit: contain; padding: 1rem; }
        .product-body { padding: 1rem; }
        .product-brand { color: var(--primary-light); font-size: .72rem; font-weight: 800; text-transform: uppercase; }
        .product-name { font-size: .95rem; font-weight: 700; margin: .25rem 0; min-height: 2.8rem; }
        .product-price { color: var(--text); font-size: 1.2rem; font-weight: 800; margin-top: .75rem; }
        .product-installment { color: var(--soft); font-size: .72rem; }
        .promo-banner {
            background: linear-gradient(135deg, #1a0320, #3d0545);
            border: 1px solid rgba(126, 10, 133, .3);
            border-radius: var(--radius-lg);
            padding: 3rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }
        .badge { display: inline-flex; padding: .2rem .6rem; border-radius: 999px; font-size: .72rem; font-weight: 800; background: rgba(126, 10, 133, .15); color: var(--primary-light); margin-bottom: .75rem; }
        .feature-card { text-align: center; }
        .feature-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(126, 10, 133, .16);
            border: 1px solid rgba(126, 10, 133, .32);
            color: var(--primary-light);
            font-weight: 800;
        }
        .feature-card h4 { font-weight: 800; margin-bottom: .5rem; }
        .feature-card p { color: var(--muted); font-size: .85rem; }
        .footer { background: var(--surface); border-top: 1px solid var(--border); padding: 3rem 0 1.5rem; margin-top: 2rem; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 2.5rem; margin-bottom: 2.5rem; }
        .footer-logo img { width: 180px; max-height: 72px; object-fit: contain; border-radius: 6px; }
        .footer-brand p, .footer-col a, .footer-bottom p, .footer-payment { color: var(--soft); font-size: .86rem; }
        .footer-brand p { margin-top: .75rem; max-width: 280px; }
        .footer-col h4 { color: var(--muted); font-size: .82rem; font-weight: 800; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 1rem; }
        .footer-col li { list-style: none; margin-bottom: .5rem; }
        .footer-col a:hover { color: var(--text); }
        .footer-bottom { border-top: 1px solid var(--border); padding-top: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .payment-badge { background: var(--card); border: 1px solid var(--border); padding: .2rem .5rem; border-radius: 4px; color: var(--text); font-size: .7rem; font-weight: 800; }
        @media (max-width: 900px) {
            .navbar .container { flex-wrap: wrap; padding-top: .75rem; padding-bottom: .75rem; }
            .navbar-nav { order: 3; width: 100%; justify-content: center; margin-left: 0; }
            .hero-image { display: none; }
            .hero-content { max-width: 100%; }
            .category-grid, .feature-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 560px) {
            .container { padding: 0 1rem; }
            .nav-actions { width: 100%; justify-content: center; }
            .category-grid, .feature-grid, .footer-grid { grid-template-columns: 1fr; }
            .hero-btns { flex-direction: column; align-items: stretch; }
            .promo-banner { padding: 2rem 1.25rem; }
        }
    </style>
</head>
<body>
@php
    $homeProducts = isset($products) ? $products->take(4) : \App\Models\Product::query()->latest()->take(4)->get();
@endphp

<x-site-header active="home" />

<main>
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                
                <h1>O futuro que cabe <br><span>na sua mão</span></h1>
                <p>Os melhores smartphones do mercado com os melhores preços. Parcele em ate 12x sem juros.</p>
                <div class="hero-btns">
                    <a href="{{ route('loja') }}" class="btn btn-primary btn-lg">Ver Produtos</a>
                    <a href="{{ route('support') }}" class="btn btn-outline btn-lg">Falar com suporte</a>
                </div>
            </div>
        </div>
        <div class="hero-image">
            <div class="hero-product-shadow">
                <img src="{{ asset('images/hero-phone.png') }}" alt="Smartphones em destaque">
            </div>
        </div>
    </section>

    <div class="stats-bar">
        <div class="container">
            <div class="stat-item"><div class="value">+10k</div><div class="label">Clientes satisfeitos</div></div>
            <div class="stat-item"><div class="value">12x</div><div class="label">Sem juros no cartão</div></div>
            <div class="stat-item"><div class="value">24h</div><div class="label">Suporte disponível</div></div>
            <div class="stat-item"><div class="value">PIX</div><div class="label">5% de desconto</div></div>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="section-title"><div class="accent-line"></div><h2>Marcas & Categorias</h2></div>
            <div class="category-grid">
                <a class="category-card" href="{{ route('loja') }}?brand=Apple">
                    <div class="brand-cat-icon"><img src="{{ asset('images/brands/apple-transparent.png') }}" alt="Apple"></div>
                    <div class="cat-name">Apple</div><div class="cat-count">iPhone</div>
                </a>
                <a class="category-card" href="{{ route('loja') }}?brand=Samsung">
                    <div class="brand-cat-icon"><img src="{{ asset('images/brands/samsung-transparent.png') }}" alt="Samsung"></div>
                    <div class="cat-name">Samsung</div><div class="cat-count">Galaxy</div>
                </a>
                <a class="category-card" href="{{ route('loja') }}?brand=Xiaomi">
                    <div class="brand-cat-icon"><img src="{{ asset('images/brands/xiaomi-transparent.png') }}" alt="Xiaomi"></div>
                    <div class="cat-name">Xiaomi</div><div class="cat-count">Redmi, Poco</div>
                </a>
                <a class="category-card" href="{{ route('loja') }}?brand=Motorola">
                    <div class="brand-cat-icon"><img src="{{ asset('images/brands/motorola-transparent.png') }}" alt="Motorola"></div>
                    <div class="cat-name">Motorola</div><div class="cat-count">Moto G, Edge</div>
                </a>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="section-title">
                <div class="accent-line"></div>
                <h2>Destaques da Semana</h2>
                <a href="{{ route('loja') }}" class="btn btn-ghost btn-sm" style="margin-left:auto">Ver todos</a>
            </div>
            <div class="products-grid">
                @forelse($homeProducts as $product)
                    <a class="product-card" href="{{ route('product.show', $product->id) }}">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <svg width="54" height="54" fill="none" stroke="#3f3f46" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            @endif
                        </div>
                        <div class="product-body">
                            <div class="product-brand">{{ $product->category ?? 'Nova Tech' }}</div>
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">R$ {{ number_format($product->price, 2, ',', '.') }}</div>
                            <div class="product-installment">ou 12x no cartão</div>
                        </div>
                    </a>
                @empty
                    <div class="card">
                        <h3>Produtos em breve</h3>
                        <p style="color:var(--muted)">Cadastre produtos no painel para eles aparecerem aqui.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="promo-banner">
                <div>
                    <div class="badge">Oferta Limitada</div>
                    <h2 style="font-size:1.8rem; margin-bottom:.5rem">PIX com 5% de desconto</h2>
                    <p style="color:var(--muted)">Pague com PIX e economize em todos os produtos. Promoção válida por tempo limitado.</p>
                </div>
                <a href="{{ route('loja') }}" class="btn btn-primary btn-lg">Aproveitar Agora</a>
            </div>
        </div>
    </section>

    <section class="section" style="padding-top:0">
        <div class="container">
            <div class="section-title"><div class="accent-line"></div><h2>Por que escolher a Nova Tech?</h2></div>
            <div class="feature-grid">
                <div class="card feature-card"><div class="feature-icon">01</div><h4>Entrega Rápida</h4><p>Frete grátis para todo o Brasil em compras acima de R$ 500.</p></div>
                <div class="card feature-card"><div class="feature-icon">02</div><h4>Compra Segura</h4><p>Ambiente seguro com autenticação e pedidos registrados no backend.</p></div>
                <div class="card feature-card"><div class="feature-icon">03</div><h4>Garantia</h4><p>Atendimento claro para troca, suporte e acompanhamento dos pedidos.</p></div>
                <div class="card feature-card"><div class="feature-icon">04</div><h4>Suporte 24h</h4><p>Equipe disponível para ajudar antes, durante e depois da compra.</p></div>
            </div>
        </div>
    </section>
</main>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a class="footer-logo" href="{{ route('home', Auth::check() ? ['site' => 1] : []) }}">
                    <img src="{{ asset('images/nova-tech-logo.png') }}" alt="Nova Tech">
                </a>
                <p>Os melhores celulares do mercado com os melhores preços. Tecnologia ao seu alcance.</p>
            </div>
            <div class="footer-col">
                <h4>Produtos</h4>
                <ul>
                    <li><a href="{{ route('loja') }}?brand=Apple">iPhone</a></li>
                    <li><a href="{{ route('loja') }}?brand=Samsung">Samsung Galaxy</a></li>
                    <li><a href="{{ route('loja') }}?brand=Xiaomi">Xiaomi</a></li>
                    <li><a href="{{ route('loja') }}?brand=Motorola">Motorola</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Conta</h4>
                <ul>
                    @auth
                        <li><a href="{{ route('profile.edit') }}">Meu Perfil</a></li>
                        <li><a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('orders.index') }}">{{ Auth::user()->role === 'admin' ? 'Painel Admin' : 'Meus Pedidos' }}</a></li>
                        <li><a href="{{ route('cart.index') }}">Carrinho</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Fazer Login</a></li>
                        <li><a href="{{ route('register') }}">Criar Conta</a></li>
                    @endauth
                </ul>
            </div>
            <div class="footer-col">
                <h4>Suporte</h4>
                <ul>
                    <li><a href="{{ route('support') }}">Central de Ajuda</a></li>
                    <li><a href="{{ route('support') }}#politica-troca">Política de Troca</a></li>
                    <li><a href="{{ route('support') }}#garantia">Garantia</a></li>
                    <li><a href="{{ route('support') }}#fale-conosco">Fale Conosco</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>2026 Nova Tech. Todos os direitos reservados.</p>
            <div class="footer-payment">
                <span>Pagamentos seguros:</span>
                <span class="payment-badge">PIX</span>
                <span class="payment-badge">VISA</span>
                <span class="payment-badge">MASTER</span>
                <span class="payment-badge">ELO</span>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
