{{-- Comentario Nova Tech: Arquivo resources/views/auth/password-code.blade.php. Origem: Views de autenticacao. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<x-guest-layout>
    <div class="auth-card-header">
        <span class="auth-eyebrow">Codigo enviado</span>
        <h2>Confirme o codigo</h2>
        <p>Digite o codigo de 6 digitos enviado para <strong>{{ $email }}</strong>. Ele expira em 15 minutos.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="auth-form" method="POST" action="{{ route('password.code.verify') }}">
        @csrf

        <input type="hidden" name="email" value="{{ old('email', $email) }}">

        <div class="auth-form-group">
            <label class="auth-label" for="code">Codigo</label>
            <input
                id="code"
                class="auth-input"
                type="text"
                name="code"
                value="{{ old('code') }}"
                required
                autofocus
                inputmode="numeric"
                pattern="[0-9]{6}"
                maxlength="6"
                placeholder="000000"
            >
            <x-input-error :messages="$errors->get('code')" class="mt-2" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-actions">
            <button class="auth-submit" type="submit">
                Validar codigo
            </button>
        </div>
    </form>

    <form class="auth-form" method="POST" action="{{ route('password.email') }}" style="margin-top: 1rem;">
        @csrf
        <input type="hidden" name="email" value="{{ old('email', $email) }}">
        <button class="auth-link" type="submit" style="background: transparent; border: 0; cursor: pointer;">
            Reenviar codigo
        </button>
    </form>
</x-guest-layout>
