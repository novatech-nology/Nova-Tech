{{-- Comentario Nova Tech: Arquivo resources/views/auth/forgot-password.blade.php. Origem: Views de autenticacao. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<x-guest-layout>
    <div class="auth-card-header">
        <span class="auth-eyebrow">Recuperação de senha</span>
        <h2>Receba um código no e-mail</h2>
        <p>Informe o e-mail da sua conta Nova Tech. Enviaremos um código de 6 digitos para confirmar sua identidade.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="auth-form" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="auth-form-group">
            <label class="auth-label" for="email">E-mail</label>
            <input
                id="email"
                class="auth-input"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="seu@email.com"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-actions">
            <button class="auth-submit" type="submit">
                Enviar código
            </button>
        </div>

        <p class="auth-footer-text">
            Lembrou sua senha? <a href="{{ route('login') }}">Voltar para login</a>
        </p>
    </form>
</x-guest-layout>
