{{-- Comentario Nova Tech: Arquivo resources/views/auth/register.blade.php. Origem: Views de autenticacao. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<x-guest-layout>
    <div class="auth-card-header">
        <h2>Criar conta</h2>
        <p>Preencha seus dados para comprar com mais facilidade.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <!-- Nome -->
        <div class="auth-form-group">
            <x-input-label for="name" :value="__('Nome')" class="auth-label" />
            <x-text-input id="name" class="auth-input" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="auth-form-group">
            <x-input-label for="email" :value="__('Email')" class="auth-label" />
            <x-text-input id="email" class="auth-input" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Senha -->
        <div class="auth-form-group">
            <x-input-label for="password" :value="__('Senha')" class="auth-label" />
            <x-text-input id="password" class="auth-input" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar senha -->
        <div class="auth-form-group">
            <x-input-label for="password_confirmation" :value="__('Confirme sua Senha')" class="auth-label" />
            <x-text-input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required />
        </div>

        <!-- Endereco -->
        <div class="auth-form-group">
            <x-input-label for="logradouro" :value="__('Rua')" class="auth-label" />
            <x-text-input id="logradouro" class="auth-input" type="text" name="logradouro" :value="old('logradouro')" required />
        </div>

        <div class="auth-form-grid">
            <div class="auth-form-group">
                <x-input-label for="numero" :value="__('Número')" class="auth-label" />
                <x-text-input id="numero" class="auth-input" type="text" name="numero" :value="old('numero')" required />
            </div>

            <div class="auth-form-group">
                <x-input-label for="cidade" :value="__('Cidade')" class="auth-label" />
                <x-text-input id="cidade" class="auth-input" type="text" name="cidade" :value="old('cidade')" required />
            </div>
        </div>

        <!-- Botoes -->
        <div class="auth-actions auth-actions-split">
            <a href="{{ route('login') }}" class="auth-link">
                Já possui uma conta?
            </a>

            <x-primary-button class="auth-submit">
                Registrar-se
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
