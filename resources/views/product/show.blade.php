{{-- Comentario Nova Tech: Arquivo resources/views/product/show.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->name }} â€” {{ config('app.name', 'Nova Tech') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --bg:        #09090b;
            --surface:   #111113;
            --surface2:  #18181b;
            --border:    #27272a;
            --border-hi: #7e0a85;
            --purple:    #7e0a85;
            --purple-lo: rgba(126,10,133,0.12);
            --text:      #ffffff;
            --muted:     #71717a;
            --accent:    #a78bfa;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            background:var(--bg);
            color:var(--text);
            font-family:'Inter',sans-serif;
            min-height:100vh;
        }

        h1,h2,h3,h4 { font-family:'Instrument Sans',sans-serif; }

        .page {
            max-width:1400px;
            margin:0 auto;
            padding:3rem 2rem;
        }

        .product-wrapper {
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:40px;
            align-items:flex-start;
        }

        /* ===== IMAGE BOX ===== */
        .image-box {
            background:var(--surface);
            border:1px solid var(--border);
            border-radius:22px;
            padding:40px;
            display:flex;
            justify-content:center;
            align-items:center;
            height:680px;
            position:relative;
            overflow:hidden;
        }

        .image-box::after {
            content:'';
            position:absolute;
            inset:0;
            background:radial-gradient(circle at center, rgba(126,10,133,.15), transparent 70%);
            pointer-events:none;
        }

        .image-box img {
            width:100%;
            height:100%;
            object-fit:contain;
            position:relative;
            z-index:1;
        }

        /* ===== PRODUCT INFO ===== */
        .product-info { padding-top:20px; }

        .brand {
            color:var(--accent);
            font-size:13px;
            font-weight:700;
            letter-spacing:.12em;
            text-transform:uppercase;
            margin-bottom:12px;
        }

        .product-title {
            font-size:3rem;
            font-weight:700;
            line-height:1.05;
            margin-bottom:20px;
        }

        .description {
            color:#a1a1aa;
            line-height:1.8;
            font-size:15px;
            margin-bottom:32px;
        }

        .price {
            font-size:3rem;
            font-weight:700;
            color:var(--accent);
            margin-bottom:10px;
        }

        .installments {
            color:var(--muted);
            font-size:13px;
            margin-bottom:36px;
        }

        .memory-title { font-size:14px; font-weight:600; margin-bottom:16px; }

        .memory-options { display:flex; gap:12px; margin-bottom:40px; }

        .memory-btn {
            background:var(--surface2);
            border:1px solid var(--border);
            color:#d4d4d8;
            padding:14px 24px;
            border-radius:12px;
            cursor:pointer;
            transition:.2s;
            font-size:14px;
            font-weight:600;
        }

        .memory-btn.active, .memory-btn:hover {
            border-color:var(--border-hi);
            background:rgba(126,10,133,.12);
            color:#fff;
        }

        .actions { display:flex; gap:16px; margin-top:30px; }

        .btn-buy {
            flex:1;
            width:100%;
            background:var(--purple);
            color:#fff;
            border:none;
            border-radius:12px;
            padding:16px 24px;
            font-size:15px;
            font-weight:700;
            cursor:pointer;
            transition:.2s;
        }

        .btn-buy:hover { background:#5c0760; }

        .btn-cart {
            flex:1;
            width:100%;
            background:var(--purple-lo);
            border:1px solid rgba(126,10,133,.35);
            color:var(--accent);
            border-radius:12px;
            padding:16px 24px;
            font-size:15px;
            font-weight:700;
            cursor:pointer;
            transition:.2s;
        }

        .btn-cart:hover { background:var(--purple); color:#fff; }

        .specs {
            margin-top:40px;
            padding-top:30px;
            border-top:1px solid var(--border);
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:20px;
        }

        .spec {
            background:var(--surface);
            border:1px solid var(--border);
            border-radius:14px;
            padding:20px;
        }

        .spec span { display:block; color:var(--muted); font-size:12px; margin-bottom:8px; }
        .spec strong { font-size:15px; color:#fff; }

        @media(max-width:980px) {
            .product-wrapper { grid-template-columns:1fr; }
            .product-title { font-size:2.2rem; }
            .specs { grid-template-columns:1fr; }
            .actions { flex-direction:column; }
        }
    </style>
</head>

<body>

{{-- HEADER --}}
<x-site-header active="loja" />

<div class="page">
    <div class="product-wrapper">

        {{-- IMAGEM --}}
        <div class="image-box">
            @if($product->image)
                @if(str_starts_with($product->image, 'http'))
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                @else
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @endif
            @endif
        </div>

        {{-- INFO --}}
        <div class="product-info">

            <div class="brand">{{ $product->category }}</div>

            <h1 class="product-title">{{ $product->name }}</h1>

            <p class="description">{{ $product->description }}</p>

            <div class="price">R$ {{ number_format($product->price, 2, ',', '.') }}</div>

            <div class="installments">ou em até 12x sem juros</div>

            <div class="memory-title">Escolha a cor</div>

            <div class="memory-options">
                <button class="memory-btn active">Preto</button>
                <button class="memory-btn">Azul</button>
                <button class="memory-btn">Branco</button>
            </div>

            <div class="actions">
                <form action="{{ route('cart.checkout.direct') }}" method="POST" style="flex:1;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-buy">Comprar Agora</button>
                </form>

                <form action="{{ route('cart.add',
