{{-- Comentario Nova Tech: Arquivo resources/views/auth/reset-password.blade.php. Origem: Views de autenticacao. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<x-guest-layout>
    <div class="auth-card-header">
        <span class="auth-eyebrow">Nova senha</span>
        <h2>Redefina sua senha</h2>
        <p>Codigo validado. Agora crie uma nova senha para acessar sua conta Nova Tech.</p>
    </div>

    <form class="auth-form" method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="email" value="{{ old('email', $email) }}">

        <div class="auth-form-group">
            <label class="auth-label" for="email_visible">E-mail</label>
            <input
                id="email_visible"
                class="auth-input"
                type="email"
                value="{{ old('email', $email) }}"
                disabled
            >
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="auth-form-group">
            <label class="auth-label" for="password">Nova senha</label>
            <input
                id="password"
                class="auth-input"
                type="password"
                name="password"
                required
                autofocus
                autocomplete="new-password"
                placeholder="Minimo 8 caracteres"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="auth-form-group">
            <label class="auth-label" for="password_confirmation">Confirmar nova senha</label>
            <input
                id="password_confirmation"
                class="auth-input"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Repita a nova senha"
            >
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="auth-actions">
            <button class="auth-submit" type="submit">
                Redefinir senha
            </button>
        </div>
    </form>
</x-guest-layout>
