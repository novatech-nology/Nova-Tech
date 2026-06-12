{{-- Comentario Nova Tech: Arquivo resources/views/auth/login.blade.php. Origem: Views de autenticacao. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="auth-card-header">
        <h2>Entrar</h2>
        <p>Acesse sua conta NovaTech para continuar.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <!-- Email Address -->
        <div class="auth-form-group">
            <x-input-label for="email" :value="__('Email')" class="auth-label" />
            <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="auth-form-group">
            <x-input-label for="password" :value="__('Senha')" class="auth-label" />

            <x-text-input id="password" class="auth-input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="auth-options">
            <label for="remember_me" class="auth-checkbox">
                <input id="remember_me" type="checkbox" name="remember">
                <span>{{ __('Lembre-se') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('Esqueceu a Senha?') }}
                </a>
            @endif
        </div>

        <div class="auth-actions">
            <x-primary-button class="auth-submit">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>

        <p class="auth-footer-text">
            Ainda não tem uma conta?
            <a href="{{ route('register') }}">Cadastrar</a>
        </p>
    </form>
</x-guest-layout>
