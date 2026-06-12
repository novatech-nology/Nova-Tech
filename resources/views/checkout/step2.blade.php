{{-- Comentario Nova Tech: Arquivo resources/views/checkout/step2.blade.php. Origem: Views do checkout. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout — Entrega | Nova Tech</title>
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

        .top-bar {
            background: rgba(9,9,11,0.9); backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
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
        .card-header { padding: 18px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
        .card-header h3 { font-size: 15px; font-weight: 700; color: #e4e4e7; }
        .card-body { padding: 20px; }

        /* Form */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-grid.full { grid-template-columns: 1fr; }
        .form-group { display: flex; flex-direction: column; gap: 6px; }
        .form-group.span2 { grid-column: span 2; }
        label { font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }
        input[type="text"] {
            background: var(--surface2); border: 1px solid var(--border);
            color: var(--text); border-radius: 10px;
            padding: 12px 14px; font-size: 13px; font-family: 'Inter', sans-serif;
            transition: border-color .2s; width: 100%;
        }
        input[type="text"]:focus { outline: none; border-color: var(--purple); }
        input[type="text"]::placeholder { color: #3f3f46; }

        /* Item mini */
        .item-mini { display: flex; align-items: center; gap: 14px; padding: 16px 20px; }
        .item-mini + .item-mini { border-top: 1px solid var(--border); }
        .item-mini-img { width: 56px; height: 56px; background: #0f0f11; border: 1px solid var(--border); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; overflow: hidden; }
        .item-mini-img img { max-width: 46px; max-height: 46px; object-fit: contain; }
        .item-mini-info { flex: 1; }
        .item-mini-name { font-size: 13px; font-weight: 600; color: #e4e4e7; }
        .item-mini-sub { font-size: 11px; color: var(--muted); margin-top: 2px; }
        .delivery-badge { font-size: 11px; color: var(--accent); font-weight: 600; }
        .delivery-eta { font-size: 11px; color: var(--muted); }

        .actions { display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; }
        .btn-back { color: var(--muted); font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 6px; transition: color .2s; }
        .btn-back:hover { color: #fff; }
        .btn-next { background: var(--purple); color: #fff; border: none; border-radius: 12px; padding: 14px 36px; font-size: 13px; font-weight: 700; cursor: pointer; letter-spacing: .08em; text-transform: uppercase; transition: all .2s; display: inline-flex; align-items: center; gap: 8px; }
        .btn-next:hover { background: #5c0760; box-shadow: 0 0 24px rgba(126,10,133,.35); transform: translateY(-1px); }

        @media (max-width: 600px) { .form-grid { grid-template-columns: 1fr; } .form-group.span2 { grid-column: span 1; } }
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
    <div class="step done">
        <div class="step-icon">✓</div>
        <span class="step-label">Carrinho</span>
    </div>
    <div class="step active">
        <div class="step-icon">🚚</div>
        <span class="step-label">Entrega</span>
    </div>
    <div class="step">
        <div class="step-icon">💳</div>
        <span class="step-label">Pagamento</span>
    </div>
    <div class="step">
        <div class="step-icon">✓</div>
        <span class="step-label">Confirmação</span>
    </div>
</div>

<div class="checkout-wrap">

    @if ($errors->any())
        <div style="background:#2d1515;border:1px solid #7f1d1d;color:#fca5a5;padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:16px;">
            @foreach ($errors->all() as $error) <div>{{ $error }}</div> @endforeach
        </div>
    @endif

    <!-- Endereço -->
    <form action="{{ route('checkout.payment') }}" method="POST">
        @csrf

        <div class="card" style="margin-bottom:12px;">
            <div class="card-header">
                <span style="color:var(--accent);font-size:16px;"></span>
                <h3>Endereço de Entrega</h3>
            </div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" name="zipcode" id="zipcode" placeholder="00000-000" maxlength="9" value="{{ old('zipcode', Auth::user()->cep ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <input type="text" name="state" id="state" placeholder="SP" maxlength="2" value="{{ old('state', Auth::user()->estado ?? '') }}" required>
                    </div>
                    <div class="form-group span2">
                        <label>Endereço</label>
                        <input type="text" name="address" id="address" placeholder="Rua, número, complemento" value="{{ old('address', Auth::user()->logradouro ?? '') }}" required>
                    </div>
                    <div class="form-group span2">
                        <label>Cidade</label>
                        <input type="text" name="city" id="city" placeholder="São Paulo" value="{{ old('city', Auth::user()->cidade ?? '') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produtos / entrega -->
        <div class="card">
            @foreach($cartItems as $item)
            <div class="item-mini">
                <div class="item-mini-img">
                    @if($item->product->image)
@if(str_starts_with($item->product->image, 'http'))
    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
@else
    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
@endif
                    @else
                        <svg width="28" height="28" fill="none" stroke="#3f3f46" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    @endif
                </div>
                <div class="item-mini-info">
                    <div class="item-mini-name">{{ $item->product->name }}</div>
                    <div class="item-mini-sub">Qtd: {{ $item->quantity }}</div>
                </div>
                <div style="text-align:right;">
                    <div class="delivery-badge">Frete Grátis </div>
                    <div class="delivery-eta">3 à 4 dias úteis</div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="actions">
            <a href="{{ route('checkout.index') }}" class="btn-back">
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

<script>
// Auto-formata CEP
document.getElementById('zipcode').addEventListener('input', function(e) {
    let v = e.target.value.replace(/\D/g, '');
    if (v.length > 5) v = v.slice(0,5) + '-' + v.slice(5,8);
    e.target.value = v;
});
</script>
</body>
</html>
