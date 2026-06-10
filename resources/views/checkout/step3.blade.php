{{-- Comentario Nova Tech: Arquivo resources/views/checkout/step3.blade.php. Origem: Views do checkout. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout — Pagamento | Nova Tech</title>
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
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 12px; }
        .card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
        .card-header h3 { font-size: 15px; font-weight: 700; color: #e4e4e7; }

        /* Address display */
        .address-info { padding: 16px 20px; }
        .address-info p { font-size: 13px; color: #a1a1aa; margin-top: 4px; }

        /* Payment options */
        .payment-options { padding: 16px 20px; display: flex; flex-direction: column; gap: 10px; }
        .payment-section-label { font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; margin-bottom: 4px; }

        .payment-option { display: none; }
        .payment-label {
            display: flex; align-items: center; gap: 14px;
            background: var(--surface2); border: 2px solid var(--border);
            border-radius: 12px; padding: 16px 18px;
            cursor: pointer; transition: all .2s;
        }
        .payment-label:hover { border-color: #3f3f46; }
        .payment-option:checked + .payment-label { border-color: var(--purple); background: var(--purple-lo); }

        .payment-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; background: var(--surface); border: 1px solid var(--border); flex-shrink: 0; }
        .payment-text { flex: 1; }
        .payment-name { font-size: 14px; font-weight: 700; color: #e4e4e7; }
        .payment-desc { font-size: 12px; color: var(--muted); margin-top: 2px; }
        .payment-check { width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--border); transition: all .2s; flex-shrink: 0; }
        .payment-option:checked + .payment-label .payment-check { border-color: var(--purple); background: var(--purple); }

        .actions { display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; }
        .btn-back { color: var(--muted); font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color .2s; }
        .btn-back:hover { color: #fff; }
        .btn-next { background: var(--purple); color: #fff; border: none; border-radius: 12px; padding: 14px 36px; font-size: 13px; font-weight: 700; cursor: pointer; letter-spacing: .08em; text-transform: uppercase; transition: all .2s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-next:hover { background: #5c0760; box-shadow: 0 0 24px rgba(126,10,133,.35); transform: translateY(-1px); }
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
    <div class="step active"><div class="step-icon">💳</div><span class="step-label">Pagamento</span></div>
    <div class="step"><div class="step-icon">✓</div><span class="step-label">Confirmação</span></div>
</div>

<div class="checkout-wrap">

    @php $address = session('checkout_address'); @endphp

    <!-- Endereço resumido -->
    @if($address)
    <div class="card">
        <div class="card-header">
            <span style="color:var(--accent);font-size:16px;"></span>
            <h3>Entrega</h3>
        </div>
        <div class="address-info">
            <p>{{ $address['address'] }} — {{ $address['city'] }}/{{ $address['state'] }} · {{ $address['zipcode'] }}</p>
        </div>
    </div>
    @endif

    <!-- Pagamento -->
    <form action="{{ route('checkout.confirm') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-header">
                <span style="color:var(--accent);font-size:16px;"></span>
                <h3>Pagamento</h3>
            </div>
            <div class="payment-options">
                <div class="payment-section-label">Selecione uma forma de pagamento</div>

                <div>
                    <input type="radio" name="payment_method" id="pix" value="pix" class="payment-option" required>
                    <label for="pix" class="payment-label">
                        
                        <div class="payment-text">
                            <div class="payment-name">PIX</div>
                            <div class="payment-desc">Aprovação imediata</div>
                        </div>
                        <div class="payment-check"></div>
                    </label>
                </div>

                <div>
                    <input type="radio" name="payment_method" id="credit_card" value="credit_card" class="payment-option">
                    <label for="credit_card" class="payment-label">
                        
                        <div class="payment-text">
                            <div class="payment-name">Cartão de Crédito</div>
                            <div class="payment-desc">Em até 12x sem juros</div>
                        </div>
                        <div class="payment-check"></div>
                    </label>
                </div>

            </div>
        </div>

        <div class="actions">
            <a href="{{ route('checkout.delivery') }}" class="btn-back">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
            <button type="submit" class="btn-next">
                Continuar
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </form>

</div>
</body>
</html>
