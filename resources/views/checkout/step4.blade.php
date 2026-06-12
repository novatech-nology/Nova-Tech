{{-- Comentario Nova Tech: Arquivo resources/views/checkout/step4.blade.php. Origem: Views do checkout. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout — Confirmação | Nova Tech</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --bg: #09090b; --surface: #111113; --surface2: #18181b;
            --border: #27272a; --purple: #7e0a85; --purple-lo: rgba(126,10,133,0.12);
            --accent: #a78bfa; --muted: #71717a; --text: #ffffff;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; min-height: 100vh; }
        h1,h2,h3 { font-family: 'Instrument Sans', sans-serif; }

        .top-bar { background: rgba(9,9,11,0.9); backdrop-filter: blur(14px); border-bottom: 1px solid var(--border); padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .logo img { height: 44px; width: auto; max-width: 150px; border-radius: 6px; object-fit: contain; }

        .steps { display: flex; align-items: center; justify-content: center; gap: 0; padding: 2rem 1rem 0; }
        .step { display: flex; flex-direction: column; align-items: center; gap: 6px; position: relative; flex: 1; max-width: 140px; }
        .step:not(:last-child)::after { content: ''; position: absolute; top: 18px; left: calc(50% + 20px); right: calc(-50% + 20px); height: 1px; background: var(--border); }
        .step.active:not(:last-child)::after, .step.done:not(:last-child)::after { background: var(--purple); }
        .step-icon { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid var(--border); background: var(--surface2); color: var(--muted); font-size: 15px; position: relative; z-index: 1; }
        .step.active .step-icon { border-color: var(--purple); background: var(--purple-lo); color: var(--accent); }
        .step.done .step-icon { border-color: var(--purple); background: var(--purple); color: #fff; }
        .step-label { font-size: 11px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }
        .step.active .step-label { color: var(--accent); }
        .step.done .step-label { color: #a1a1aa; }

        .checkout-wrap { max-width: 680px; margin: 2.5rem auto; padding: 0 1.5rem 4rem; }

        /* Confirmed banner */
        .confirmed-banner { text-align: center; padding: 2rem 1rem 1.5rem; }
        .confirmed-icon { width: 64px; height: 64px; background: rgba(34,197,94,0.12); border: 2px solid rgba(34,197,94,0.4); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 28px; }
        .confirmed-title { font-size: 1.6rem; font-weight: 700; color: #fff; margin-bottom: 6px; }
        .confirmed-sub { font-size: 13px; color: var(--muted); }

        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 12px; }
        .card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
        .card-header h3 { font-size: 15px; font-weight: 700; color: #e4e4e7; }

        .address-info { padding: 16px 20px; }
        .address-info p { font-size: 13px; color: #a1a1aa; margin-top: 4px; }

        .item-row { display: flex; align-items: center; gap: 16px; padding: 16px 20px; }
        .item-row + .item-row { border-top: 1px solid var(--border); }
        .item-img { width: 64px; height: 64px; background: #0f0f11; border: 1px solid var(--border); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .item-img img { max-width: 52px; max-height: 52px; object-fit: contain; }
        .item-info { flex: 1; }
        .item-name { font-size: 14px; font-weight: 600; color: #e4e4e7; }
        .item-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }
        .item-price { text-align: right; }
        .item-price .price { font-family: 'Instrument Sans', sans-serif; font-size: 15px; font-weight: 700; color: var(--accent); }
        .item-price .installment { font-size: 11px; color: var(--muted); margin-top: 2px; }

        .total-row { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-top: 1px solid var(--border); }
        .total-label { font-size: 13px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .05em; }
        .total-value { font-family: 'Instrument Sans', sans-serif; font-size: 20px; font-weight: 700; color: var(--accent); }
        .total-installment { font-size: 12px; color: var(--muted); text-align: right; margin-top: 2px; }

        /* Payment badge */
        .payment-badge { display: inline-flex; align-items: center; gap: 6px; background: var(--purple-lo); border: 1px solid rgba(126,10,133,.3); color: var(--accent); font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 99px; }

        .actions { display: flex; justify-content: flex-end; margin-top: 1.5rem; }
        .btn-finish { background: var(--purple); color: #fff; border: none; border-radius: 12px; padding: 14px 36px; font-size: 13px; font-weight: 700; cursor: pointer; letter-spacing: .08em; text-transform: uppercase; transition: all .2s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-finish:hover { background: #5c0760; box-shadow: 0 0 24px rgba(126,10,133,.35); transform: translateY(-1px); }
    </style>
</head>
<body>

<div class="top-bar">
    <a href="/" class="logo">
        <img src="{{ asset('images/nova-tech-logo.png') }}" alt="Nova Tech">
    </a>
    <span style="font-size:12px;color:var(--muted);">Checkout seguro 🔒</span>
</div>

<div class="steps">
    <div class="step done"><div class="step-icon">✓</div><span class="step-label">Carrinho</span></div>
    <div class="step done"><div class="step-icon">✓</div><span class="step-label">Entrega</span></div>
    <div class="step done"><div class="step-icon">✓</div><span class="step-label">Pagamento</span></div>
    <div class="step active"><div class="step-icon">✓</div><span class="step-label">Confirmação</span></div>
</div>

<div class="checkout-wrap">

    <div class="confirmed-banner">
        <div class="confirmed-icon">✓</div>
        <div class="confirmed-title">Pedido Confirmado!</div>
        <div class="confirmed-sub">Revise os detalhes e finalize seu pedido</div>
    </div>

    @php
        $address      = session('checkout_address');
        $payment      = session('checkout_payment');        // 'pix' | 'credit_card'
        $installments = (int) session('checkout_installments', 1);

        // Label do método de pagamento com parcelamento real
        if ($payment === 'pix') {
            $paymentLabel = '⚡ PIX — Aprovação imediata';
        } elseif ($installments <= 1) {
            $paymentLabel = '💳 Cartão de Crédito — À vista';
        } else {
            $installmentValue = $total / $installments;
            $paymentLabel = '💳 Cartão de Crédito — '
                . $installments . 'x de R$ '
                . number_format($installmentValue, 2, ',', '.')
                . ' sem juros';
        }
    @endphp

    {{-- Endereço --}}
    @if($address)
    <div class="card">
        <div class="card-header">
            <span style="color:var(--accent);font-size:16px;">📍</span>
            <h3>Entrega</h3>
        </div>
        <div class="address-info">
            <p>{{ $address['address'] }} — {{ $address['city'] }}/{{ $address['state'] }} · {{ $address['zipcode'] }}</p>
        </div>
    </div>
    @endif

    {{-- Pagamento --}}
    @if($payment)
    <div class="card">
        <div class="card-header">
            <span style="color:var(--accent);font-size:16px;">💳</span>
            <h3>Pagamento</h3>
        </div>
        <div style="padding:16px 20px;">
            <span class="payment-badge">{{ $paymentLabel }}</span>
        </div>
    </div>
    @endif

    {{-- Itens --}}
    <div class="card">
        @foreach($cartItems as $item)
        @php
            $itemTotal = $item->product->price * $item->quantity;

            // Mostra parcela por item somente se for cartão com mais de 1x
            $showItemInstallment = ($payment === 'credit_card' && $installments > 1);
            $itemInstallmentValue = $showItemInstallment
                ? number_format($itemTotal / $installments, 2, ',', '.')
                : null;
        @endphp
        <div class="item-row">
            <div class="item-img">
                @if($item->product->image)
                    <img
                        src="{{ str_starts_with($item->product->image, 'http') ? $item->product->image : asset('storage/' . $item->product->image) }}"
                        alt="{{ $item->product->name }}"
                    >
                @else
                    <svg width="28" height="28" fill="none" stroke="#3f3f46" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                @endif
            </div>
            <div class="item-info">
                <div class="item-name">{{ $item->product->name }}</div>
                <div class="item-sub">{{ $item->product->category }} · Qtd: {{ $item->quantity }}</div>
            </div>
            <div class="item-price">
                <div class="price">R$ {{ number_format($itemTotal, 2, ',', '.') }}</div>
                @if($showItemInstallment)
                    <div class="installment">{{ $installments }}x de R$ {{ $itemInstallmentValue }}</div>
                @endif
            </div>
        </div>
        @endforeach

        <div class="total-row">
            <div>
                <span class="total-label">Total</span>
                @if($payment === 'credit_card' && $installments > 1)
                    <div class="total-installment">
                        {{ $installments }}x de R$ {{ number_format($total / $installments, 2, ',', '.') }} sem juros
                    </div>
                @endif
            </div>
            <span class="total-value">R$ {{ number_format($total, 2, ',', '.') }}</span>
        </div>
    </div>

    {{-- Finalizar --}}
    <div class="actions">
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn-finish">
                Finalizar Pedido
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </form>
    </div>

</div>
</body>
</html>
