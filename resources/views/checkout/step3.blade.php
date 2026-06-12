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
    {{-- QR Code gerado via biblioteca JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        :root {
            --bg: #09090b; --surface: #111113; --surface2: #18181b;
            --border: #27272a; --purple: #7e0a85; --purple-lo: rgba(126,10,133,0.12);
            --accent: #a78bfa; --muted: #71717a; --text: #ffffff;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: var(--bg); color: var(--text); font-family: 'Inter', sans-serif; min-height: 100vh; }
        h1,h2,h3 { font-family: 'Instrument Sans', sans-serif; }

        /* ── Top bar ── */
        .top-bar { background: rgba(9,9,11,0.9); backdrop-filter: blur(14px); border-bottom: 1px solid var(--border); padding: 0 2rem; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .logo { display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .logo img { height: 44px; width: auto; max-width: 150px; border-radius: 6px; object-fit: contain; }

        /* ── Steps ── */
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

        /* ── Layout ── */
        .checkout-wrap { max-width: 680px; margin: 2.5rem auto; padding: 0 1.5rem 4rem; }
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; margin-bottom: 12px; }
        .card-header { padding: 16px 20px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 10px; }
        .card-header h3 { font-size: 15px; font-weight: 700; color: #e4e4e7; }

        /* ── Endereço ── */
        .address-info { padding: 16px 20px; }
        .address-info p { font-size: 13px; color: #a1a1aa; margin-top: 4px; }

        /* ── Opções de pagamento ── */
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

        /* ── Painel de detalhes (PIX / Cartão) ── */
        .payment-detail { display: none; margin-top: 4px; border-radius: 12px; overflow: hidden; border: 1px solid var(--border); background: var(--surface2); animation: fadeIn .25s ease; }
        .payment-detail.visible { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: none; } }

        /* ── PIX QR Code ── */
        .pix-panel { padding: 24px 20px; display: flex; flex-direction: column; align-items: center; gap: 16px; }
        .pix-qr-wrap { background: #fff; border-radius: 12px; padding: 14px; display: inline-flex; }
        .pix-key-box { width: 100%; background: var(--surface); border: 1px solid var(--border); border-radius: 10px; padding: 12px 16px; display: flex; align-items: center; justify-content: space-between; gap: 8px; }
        .pix-key-text { font-size: 12px; color: #a1a1aa; word-break: break-all; }
        .btn-copy { background: var(--purple); color: #fff; border: none; border-radius: 8px; padding: 8px 14px; font-size: 12px; font-weight: 700; cursor: pointer; white-space: nowrap; transition: background .2s; }
        .btn-copy:hover { background: #5c0760; }
        .pix-info { font-size: 12px; color: var(--muted); text-align: center; line-height: 1.6; }
        .pix-timer { display: flex; align-items: center; gap: 6px; font-size: 13px; color: var(--accent); font-weight: 600; }

        /* ── Cartão de Crédito ── */
        .card-form { padding: 20px; display: flex; flex-direction: column; gap: 14px; }
        .field-row { display: flex; gap: 12px; }
        .field { display: flex; flex-direction: column; gap: 6px; flex: 1; }
        .field label { font-size: 11px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }
        .field input, .field select {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 10px; padding: 12px 14px; color: var(--text);
            font-size: 14px; font-family: 'Inter', sans-serif;
            outline: none; transition: border-color .2s; width: 100%;
            -webkit-appearance: none; appearance: none;
        }
        .field input::placeholder { color: var(--muted); }
        .field input:focus, .field select:focus { border-color: var(--purple); }
        .field select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2371717a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; background-size: 16px; padding-right: 36px; cursor: pointer; }
        .field select option { background: var(--surface2); color: var(--text); }

        /* Highlight da parcela selecionada */
        .installment-highlight { font-size: 12px; color: var(--accent); font-weight: 600; margin-top: 4px; min-height: 16px; }

        /* ── Ações ── */
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

    {{-- Endereço resumido --}}
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
    <form action="{{ route('checkout.confirm') }}" method="POST" id="payment-form">
        @csrf

        {{-- Campos ocultos preenchidos via JS --}}
        <input type="hidden" name="payment_method" id="hidden_payment_method">
        <input type="hidden" name="installments"    id="hidden_installments" value="1">

        <div class="card">
            <div class="card-header">
                <span style="color:var(--accent);font-size:16px;">💳</span>
                <h3>Pagamento</h3>
            </div>
            <div class="payment-options">
                <div class="payment-section-label">Selecione uma forma de pagamento</div>

                {{-- PIX --}}
                <div>
                    <input type="radio" name="_payment_ui" id="pix" value="pix" class="payment-option">
                    <label for="pix" class="payment-label">
                        <div class="payment-icon">⚡</div>
                        <div class="payment-text">
                            <div class="payment-name">PIX</div>
                            <div class="payment-desc">Aprovação imediata · sem taxas</div>
                        </div>
                        <div class="payment-check"></div>
                    </label>
                </div>

                {{-- Painel PIX --}}
                <div class="payment-detail" id="detail-pix">
                    <div class="pix-panel">
                        <div class="pix-timer">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path stroke-linecap="round" d="M12 6v6l4 2"/></svg>
                            <span id="pix-countdown">15:00</span> para pagar
                        </div>
                        <div class="pix-qr-wrap" id="pix-qrcode"></div>
                        <div class="pix-key-box">
                            <span class="pix-key-text" id="pix-key-display">{{ config('checkout.pix_key', '00020126580014br.gov.bcb.pix0136exemplo@novatech.com.br') }}</span>
                            <button type="button" class="btn-copy" onclick="copyPixKey()">Copiar</button>
                        </div>
                        <p class="pix-info">
                            Abra o app do seu banco, escolha pagar via PIX,<br>
                            escaneie o QR Code ou cole a chave acima.
                        </p>
                    </div>
                </div>

                {{-- Cartão de Crédito --}}
                <div>
                    <input type="radio" name="_payment_ui" id="credit_card" value="credit_card" class="payment-option">
                    <label for="credit_card" class="payment-label">
                        <div class="payment-icon">💳</div>
                        <div class="payment-text">
                            <div class="payment-name">Cartão de Crédito</div>
                            <div class="payment-desc">Em até 12x sem juros</div>
                        </div>
                        <div class="payment-check"></div>
                    </label>
                </div>

                {{-- Painel Cartão --}}
                <div class="payment-detail" id="detail-credit_card">
                    <div class="card-form">
                        <div class="field">
                            <label>Número do Cartão</label>
                            <input type="text" name="card_number" id="card_number" placeholder="0000 0000 0000 0000" maxlength="19" autocomplete="cc-number">
                        </div>
                        <div class="field">
                            <label>Nome no Cartão</label>
                            <input type="text" name="card_name" placeholder="Como está impresso" autocomplete="cc-name">
                        </div>
                        <div class="field-row">
                            <div class="field">
                                <label>Validade</label>
                                <input type="text" name="card_expiry" placeholder="MM/AA" maxlength="5" autocomplete="cc-exp">
                            </div>
                            <div class="field">
                                <label>CVV</label>
                                <input type="text" name="card_cvv" placeholder="000" maxlength="4" autocomplete="cc-csc">
                            </div>
                        </div>
                        <div class="field">
                            <label>Parcelas</label>
                            <select name="installments_select" id="installments_select" onchange="updateInstallment(this)">
                                {{-- As opções são geradas via Blade com base no total do pedido --}}
                                @php
                                    $total = session('checkout_total', 0);
                                    $options = [
                                        1 => 'À vista',
                                        2 => '2x', 3 => '3x', 4 => '4x', 5 => '5x', 6 => '6x',
                                        7 => '7x', 8 => '8x', 9 => '9x', 10 => '10x',
                                        11 => '11x', 12 => '12x',
                                    ];
                                @endphp
                                @foreach($options as $n => $label)
                                    @php
                                        $installmentValue = $total > 0 ? $total / $n : 0;
                                        $suffix = $total > 0
                                            ? ' — R$ ' . number_format($installmentValue, 2, ',', '.')
                                            : '';
                                        $prefix = $n === 1 ? 'À vista' : "{$n}x sem juros";
                                    @endphp
                                    <option value="{{ $n }}" data-value="{{ number_format($installmentValue, 2, ',', '.') }}">
                                        {{ $prefix }}{{ $suffix }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="installment-highlight" id="installment-highlight"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="actions">
            <a href="{{ route('checkout.delivery') }}" class="btn-back">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                Voltar
            </a>
            <button type="submit" class="btn-next" id="btn-submit" disabled style="opacity:.5;cursor:not-allowed;">
                Continuar
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </form>

</div>

<script>
// ── PIX key (pode vir do backend via Blade) ──────────────────────────────────
const PIX_KEY = document.getElementById('pix-key-display').textContent.trim();

// ── QR Code (gerado client-side) ─────────────────────────────────────────────
let qrGenerated = false;
function generateQR() {
    if (qrGenerated) return;
    const el = document.getElementById('pix-qrcode');
    el.innerHTML = '';
    new QRCode(el, {
        text: PIX_KEY,
        width: 180, height: 180,
        colorDark: '#000000', colorLight: '#ffffff',
        correctLevel: QRCode.CorrectLevel.M
    });
    qrGenerated = true;
}

// ── Contador regressivo PIX ───────────────────────────────────────────────────
let pixTimerInterval = null;
function startPixTimer() {
    clearInterval(pixTimerInterval);
    let secs = 15 * 60;
    const el = document.getElementById('pix-countdown');
    pixTimerInterval = setInterval(() => {
        if (secs <= 0) { clearInterval(pixTimerInterval); el.textContent = '00:00'; return; }
        secs--;
        const m = String(Math.floor(secs / 60)).padStart(2, '0');
        const s = String(secs % 60).padStart(2, '0');
        el.textContent = `${m}:${s}`;
    }, 1000);
}

// ── Copiar chave PIX ─────────────────────────────────────────────────────────
function copyPixKey() {
    navigator.clipboard.writeText(PIX_KEY).then(() => {
        const btn = document.querySelector('.btn-copy');
        btn.textContent = 'Copiado ✓';
        setTimeout(() => btn.textContent = 'Copiar', 2000);
    });
}

// ── Alternar painéis de pagamento ────────────────────────────────────────────
document.querySelectorAll('.payment-option').forEach(radio => {
    radio.addEventListener('change', function () {
        // Fecha todos os painéis
        document.querySelectorAll('.payment-detail').forEach(d => d.classList.remove('visible'));

        const method = this.value;
        document.getElementById('hidden_payment_method').value = method;

        // Abre o painel correspondente
        const panel = document.getElementById('detail-' + method);
        if (panel) panel.classList.add('visible');

        // Ações específicas por método
        if (method === 'pix') {
            generateQR();
            startPixTimer();
            document.getElementById('hidden_installments').value = 1;
        }

        // Habilita o botão de continuar
        const btn = document.getElementById('btn-submit');
        btn.disabled = false;
        btn.style.opacity = '1';
        btn.style.cursor = 'pointer';
    });
});

// ── Formatação automática do número do cartão ────────────────────────────────
document.getElementById('card_number').addEventListener('input', function () {
    let v = this.value.replace(/\D/g, '').substring(0, 16);
    this.value = v.replace(/(.{4})/g, '$1 ').trim();
});

// ── Parcelas ─────────────────────────────────────────────────────────────────
function updateInstallment(sel) {
    const n = parseInt(sel.value);
    const opt = sel.options[sel.selectedIndex];
    const val = opt.getAttribute('data-value');
    document.getElementById('hidden_installments').value = n;

    const hl = document.getElementById('installment-highlight');
    if (val && parseFloat(val.replace(',', '.')) > 0) {
        hl.textContent = n === 1
            ? 'Pagamento único · sem juros'
            : `${n}x de R$ ${val} · sem juros`;
    } else {
        hl.textContent = '';
    }
}
// Dispara ao carregar para preencher o highlight inicial
window.addEventListener('DOMContentLoaded', () => {
    const sel = document.getElementById('installments_select');
    if (sel) updateInstallment(sel);
});

// ── Validação mínima antes de enviar ─────────────────────────────────────────
document.getElementById('payment-form').addEventListener('submit', function (e) {
    const method = document.getElementById('hidden_payment_method').value;
    if (!method) { e.preventDefault(); alert('Selecione uma forma de pagamento.'); return; }

    if (method === 'credit_card') {
        const num = document.getElementById('card_number').value.replace(/\s/g, '');
        if (num.length < 13) { e.preventDefault(); alert('Informe um número de cartão válido.'); }
    }
});
</script>
</body>
</html>
