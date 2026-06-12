{{-- Comentario Nova Tech: Arquivo resources/views/loja.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Loja {{ config('app.name', 'Nova Tech') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
<style>
    :root {
    --bg: #09090b;
    --surface: #111113;
    --surface2: #18181b;
    --border: #27272a;
    --border-hi: #7e0a85;
    --purple: #7e0a85;
    --purple-lo: rgba(126,10,133,0.12);
    --text: #ffffff;
    --muted: #71717a;
    --accent: #a78bfa;

    /* Main area - slightly lighter than global bg */
    --main-bg: #0f0f12;
    --card-bg: #17171c;
    --card-bg-hover: #1c1c22;
    --col-bg: #13131a;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background: var(--bg);
    color: var(--text);
    font-family:'Inter',sans-serif;
    min-height:100vh;
}

/* HEADER */

header{
    position: sticky;
    top: 0;
    z-index: 50;
    background: rgba(9,9,11,.92);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--border);
}

.header-inner{
    max-width: 1600px;
    margin: 0 auto;
    height: 72px;
    padding: 0 2rem;
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.logo{
    display:flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
}

nav{
    display:flex;
    gap:2rem;
}

nav a{
    color:#a1a1aa;
    text-decoration:none;
    font-size:14px;
    font-weight:500;
    transition:.2s;
}

nav a:hover{ color:white; }
nav a.active{ color: var(--accent); }

/* =========================
   STORE WRAPPER — mais claro
========================= */

.store-wrapper{
    max-width: 1600px;
    margin: 0 auto;
    padding: 1.5rem 2rem 2.5rem;
    flex: 1;
    /* Fundo ligeiramente mais claro que o body */
    background: var(--main-bg);
    border-radius: 0 0 24px 24px;
}

/* =========================
   FILTRO — compacto, em linha
========================= */

.filter-bar{
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: .6rem;
    flex-wrap: wrap;
}

/* badge de contagem — integrado à filter-bar */
.store-count-badge{
    display: inline-flex;
    align-items: center;
    border: 1px solid rgba(126,10,133,.3);
    border-radius: 999px;
    background: rgba(126,10,133,.1);
    color: #c4b5fd;
    padding: 0 .75rem;
    height: 34px;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .06em;
    white-space: nowrap;
    margin-right: .4rem;
}

.filter-bar select{
    height: 34px;
    border: 1px solid #2f2f35;
    border-radius: 8px;
    outline: 0;
    background: #0c0c0f;
    color: #d4d4d8;
    padding: 0 .65rem;
    font: inherit;
    font-size: 12px;
    cursor: pointer;
    transition: .2s ease;
    min-width: 140px;
}

.filter-bar select:focus{
    border-color: rgba(167,139,250,.6);
    box-shadow: 0 0 0 3px rgba(126,10,133,.12);
}

.filter-button,
.filter-clear{
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: .4rem;
    border-radius: 8px;
    padding: 0 .85rem;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
    transition: .2s ease;
}

.filter-button{
    border: 0;
    background: linear-gradient(135deg, #7e0a85, #5c0760);
    color: #fff;
}

.filter-button:hover{ transform: translateY(-1px); }

.filter-clear{
    border: 1px solid #3f3f46;
    background: transparent;
    color: #a1a1aa;
}

.filter-clear:hover{
    border-color: #7e0a85;
    color: #fff;
    transform: translateY(-1px);
}

.active-filters{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: .4rem;
    margin-bottom: .9rem;
}

.filter-chip{
    min-height: 24px;
    display: inline-flex;
    align-items: center;
    border: 1px solid rgba(167,139,250,.3);
    border-radius: 999px;
    background: rgba(126,10,133,.11);
    color: #ddd6fe;
    padding: 0 .6rem;
    font-size: 11px;
    font-weight: 700;
}

/* =========================
   BRANDS GRID
========================= */

.brands-grid{
    display: flex;
    gap: 20px;
    overflow-x: auto;
    padding-bottom: 10px;
    justify-content: center;
}

.brands-grid::-webkit-scrollbar{ height: 5px; }
.brands-grid::-webkit-scrollbar-thumb{
    background: var(--purple);
    border-radius: 999px;
}

/* =========================
   BRAND COLUMN — mais larga e luminosa
========================= */

.brand-col{
    min-width: 400px;
    width: 400px;
    height: 82vh;
    background: linear-gradient(180deg, var(--col-bg) 0%, #111118 100%);
    border: 1px solid #252530;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.04),
        0 8px 32px rgba(0,0,0,.28);
}

/* =========================
   BRAND HEADER
========================= */

.brand-header{
    padding: 18px 20px;
    border-bottom: 1px solid #202028;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(126,10,133,.05);
}

.brand-name{
    font-size: 13px;
    letter-spacing: .18em;
    font-weight: 700;
    color: var(--accent);
    text-transform: uppercase;
}

.brand-count{
    width: 26px;
    height: 26px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #1a1a22;
    border: 1px solid #2c2c38;
    color: #a1a1aa;
    font-size: 11px;
}

/* =========================
   PRODUCT LIST
========================= */

.product-list-inner{
    overflow-y: auto;
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.product-list-inner::-webkit-scrollbar{ width: 4px; }
.product-list-inner::-webkit-scrollbar-thumb{
    background: var(--purple);
    border-radius: 999px;
}

/* =========================
   PRODUCT CARD — mais claro e destacado
========================= */

.product-card{
    background: var(--card-bg);
    border: 1px solid #28283a;
    border-radius: 16px;
    padding: 16px;
    transition: .25s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.product-card:hover{
    transform: translateY(-3px);
    border-color: rgba(126,10,133,.55);
    background: var(--card-bg-hover);
    box-shadow:
        0 0 0 1px rgba(126,10,133,.12),
        0 14px 36px rgba(126,10,133,.16);
}

/* =========================
   IMAGE — zona generosa
========================= */

.card-img-link{
    width: 100%;
    height: 210px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #0c0c0f;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 14px;
    flex-shrink: 0;
}

.card-img-link img{
    max-width: 88%;
    max-height: 190px;
    object-fit: contain;
    transition: .35s ease;
}

.product-card:hover img{ transform: scale(1.05); }

/* =========================
   CARD BODY
========================= */

.card-body{
    width: 100%;
    display: flex;
    flex-direction: column;
    flex: 1;
    gap: 10px;
}

.card-name-link{ text-decoration: none; }

.card-name{
    font-size: 13.5px;
    line-height: 1.5;
    color: #e4e4e7;
    font-weight: 600;
    min-height: 40px;
}

.card-price{
    font-size: 20px;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
}

.card-price small{
    display: block;
    margin-top: 2px;
    font-size: 11px;
    color: #71717a;
    font-weight: 400;
}

.btn-add{
    width: 100%;
    height: 40px;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #7e0a85, #5c0760);
    color: white;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: .25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    text-decoration: none;
    margin-top: auto;
}

.btn-add:hover{
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(126,10,133,.35);
}

/* =========================
   EMPTY STATE
========================= */

.empty-state{
    text-align: center;
    padding: 4rem 1rem;
    color: var(--muted);
}

.empty-state h3{
    font-size: 1.1rem;
    color: #a1a1aa;
    margin-bottom: .5rem;
}

/* =========================
   FOOTER
========================= */

.store-footer{
    margin-top: 3rem;
    padding: 3rem 0 1.5rem;
    background: #111113;
    border-top: 1px solid var(--border);
}

.store-footer-inner{
    width: min(1200px, calc(100% - 32px));
    margin: 0 auto;
}

.store-footer-grid{
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 2.5rem;
    margin-bottom: 2.25rem;
}

.store-footer-logo img{
    width: 180px;
    max-height: 72px;
    border-radius: 6px;
    object-fit: contain;
}

.store-footer-brand p{
    max-width: 300px;
    margin-top: .8rem;
    color: #71717a;
    font-size: .88rem;
    line-height: 1.65;
}

.store-footer-col h4{
    margin-bottom: 1rem;
    color: #a1a1aa;
    font-size: .78rem;
    font-weight: 800;
    letter-spacing: .08em;
    text-transform: uppercase;
}

.store-footer-col ul{ list-style: none; }
.store-footer-col li{ margin-bottom: .55rem; }
.store-footer-col a{
    color: #71717a;
    font-size: .88rem;
    text-decoration: none;
    transition: .2s ease;
}
.store-footer-col a:hover{ color: #fff; }

.store-footer-bottom{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
    color: #71717a;
    font-size: .86rem;
}

.store-footer-payment{
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: .5rem;
}

.payment-badge{
    display: inline-flex;
    align-items: center;
    min-height: 24px;
    padding: 0 .55rem;
    border: 1px solid var(--border);
    border-radius: 4px;
    background: #18181b;
    color: #fff;
    font-size: .7rem;
    font-weight: 800;
}

/* =========================
   RESPONSIVO
========================= */

@media(max-width: 768px){
    .store-wrapper{ padding: 1rem; }
    .brand-col{ min-width: 300px; width: 300px; }
    .card-img-link{ height: 190px; }
    .store-footer-grid{ grid-template-columns: 1fr 1fr; }
    .filter-bar{ gap: .4rem; }
    .filter-bar select{ min-width: 120px; }
}

@media(max-width: 560px){
    .store-footer-grid{ grid-template-columns: 1fr; gap: 1.5rem; }
    .store-footer-bottom{ align-items: flex-start; flex-direction: column; }
}
</style>
</head>
<body>

    @if(session('success'))
        <div class="flash"><span class="check">✓</span> {{ session('success') }}</div>
    @endif

    <x-site-header active="loja" />

    <div class="store-wrapper">

        {{-- FILTRO COMPACTO em linha única --}}
        <div>
            <form class="filter-bar" method="GET" action="{{ route('loja') }}">

                <span class="store-count-badge">
                    {{ $productsByBrand->flatten(1)->count() }}
                    {{ $productsByBrand->flatten(1)->count() === 1 ? 'produto' : 'produtos' }}
                </span>

                <select id="brand" name="brand" aria-label="Marca">
                    <option value="">Todas as marcas</option>
                    @foreach($brands as $brandOption)
                        <option value="{{ $brandOption }}" @selected($selectedBrand === $brandOption)>
                            {{ $brandOption }}
                        </option>
                    @endforeach
                </select>

                <select id="price_range" name="price_range" aria-label="Faixa de preço">
                    <option value="">Todos os preços</option>
                    <option value="0-1500"    @selected($selectedPriceRange === '0-1500')>Até R$ 1.500</option>
                    <option value="1500-3000" @selected($selectedPriceRange === '1500-3000')>R$ 1.500 – R$ 3.000</option>
                    <option value="3000-5000" @selected($selectedPriceRange === '3000-5000')>R$ 3.000 – R$ 5.000</option>
                    <option value="5000-plus" @selected($selectedPriceRange === '5000-plus')>Acima de R$ 5.000</option>
                </select>

                <button class="filter-button" type="submit">Filtrar</button>

                <a class="filter-clear" href="{{ route('loja') }}">Limpar</a>

            </form>

            @if($selectedBrand || $selectedPriceRange)
                <div class="active-filters" aria-label="Filtros ativos">
                    @if($selectedBrand)
                        <span class="filter-chip">Marca: {{ $selectedBrand }}</span>
                    @endif
                    @if($selectedPriceRange)
                        <span class="filter-chip">
                            Preço:
                            @switch($selectedPriceRange)
                                @case('0-1500') até R$ 1.500 @break
                                @case('1500-3000') R$ 1.500 a R$ 3.000 @break
                                @case('3000-5000') R$ 3.000 a R$ 5.000 @break
                                @case('5000-plus') acima de R$ 5.000 @break
                            @endswitch
                        </span>
                    @endif
                </div>
            @endif
        </div>

        {{-- GRID DE MARCAS --}}
        @if(isset($productsByBrand) && $productsByBrand->isNotEmpty())
            <div class="brands-grid">
                @foreach($productsByBrand as $brand => $products)
                <div class="brand-col">
                    <div class="brand-header">
                        <span class="brand-name">{{ $brand }}</span>
                        <span class="brand-count">{{ $products->count() }}</span>
                    </div>
                    <div class="product-list-inner">
                        @foreach($products as $product)
                        <div class="product-card">
                            <a href="{{ route('product.show', $product->id) }}" class="card-img-link">
                                @if($product->image)
                                    @if(str_starts_with($product->image, 'http'))
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                                    @else
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @endif
                                @else
                                    <svg width="40" height="40" fill="none" stroke="#3f3f46" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                @endif
                            </a>
                            <div class="card-body">
                                <a href="{{ route('product.show', $product->id) }}" class="card-name-link">
                                    <div class="card-name">{{ $product->name }}</div>
                                </a>
                                <div class="card-price">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                    <small>ou 12x no cartão</small>
                                </div>
                                @auth
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-add">
                                            <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                            Adicionar ao Carrinho
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn-add">Entrar para comprar</a>
                                @endauth
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <svg width="56" height="56" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#3f3f46;margin:0 auto 1rem;display:block;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                @if($selectedBrand || $selectedPriceRange)
                    <p>Não encontramos produtos para os filtros selecionados.</p>
                    <a class="filter-clear" href="{{ route('loja') }}" style="margin-top:1rem;">Limpar filtros</a>
                @else
                    <h3>Nenhum produto cadastrado</h3>
                    <p>Os produtos aparecerao aqui assim que forem adicionados pelo administrador.</p>
                @endif
            </div>
        @endif
    </div>

    <footer class="store-footer">
        <div class="store-footer-inner">
            <div class="store-footer-grid">
                <div class="store-footer-brand">
                    <a class="store-footer-logo" href="{{ route('home', Auth::check() ? ['site' => 1] : []) }}" aria-label="Nova Tech">
                        <img src="{{ asset('images/nova-tech-logo.png') }}" alt="Nova Tech">
                    </a>
                    <p>Os melhores celulares do mercado com atendimento, garantia e compra segura.</p>
                </div>

                <div class="store-footer-col">
                    <h4>Produtos</h4>
                    <ul>
                        <li><a href="{{ route('loja') }}?brand=Apple">iPhone</a></li>
                        <li><a href="{{ route('loja') }}?brand=Samsung">Samsung Galaxy</a></li>
                        <li><a href="{{ route('loja') }}?brand=Xiaomi">Xiaomi</a></li>
                    </ul>
                </div>

                <div class="store-footer-col">
                    <h4>Conta</h4>
                    <ul>
                        @auth
                            <li><a href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                            <li><a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('orders.index') }}">{{ Auth::user()->role === 'admin' ? 'Painel Admin' : 'Meus Pedidos' }}</a></li>
                            <li><a href="{{ route('cart.index') }}">Carrinho</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Entrar</a></li>
                            <li><a href="{{ route('register') }}">Criar Conta</a></li>
                        @endauth
                    </ul>
                </div>

                <div class="store-footer-col">
                    <h4>Suporte</h4>
                    <ul>
                        <li><a href="{{ route('support') }}">Central de Ajuda</a></li>
                        <li><a href="{{ route('support') }}#politica-troca">Politica de Troca</a></li>
                        <li><a href="{{ route('support') }}#garantia">Garantia</a></li>
                        <li><a href="{{ route('support') }}#fale-conosco">Fale Conosco</a></li>
                    </ul>
                </div>
            </div>

            <div class="store-footer-bottom">
                <p>{{ date('Y') }} Nova Tech. Todos os direitos reservados.</p>
                <div class="store-footer-payment">
                    <span>Pagamentos seguros:</span>
                    <span class="payment-badge">PIX</span>
                    <span class="payment-badge">VISA</span>
                    <span class="payment-badge">MASTER</span>
                    <span class="payment-badge">ELO</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        setTimeout(() => { const f = document.querySelector('.flash'); if (f) f.style.display = 'none'; }, 4000);
    </script>
</body>
</html>
