{{-- Comentario Nova Tech: Arquivo resources/views/profile/edit.blade.php. Origem: Views de perfil do usuario. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Perfil | Nova Tech</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600,700" rel="stylesheet"/>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        :root {
            --bg: #050506;
            --panel: #111113;
            --panel-soft: #17171a;
            --panel-line: rgba(255, 255, 255, .09);
            --text: #f6f6f7;
            --muted: #a1a1aa;
            --soft: #71717a;
            --brand: #7e0a85;
            --brand-2: #a78bfa;
            --danger: #ef4444;
            --success: #22c55e;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background:
                radial-gradient(circle at 18% 5%, rgba(126, 10, 133, .16), transparent 30rem),
                radial-gradient(circle at 86% 12%, rgba(14, 165, 233, .1), transparent 28rem),
                var(--bg);
            color: var(--text);
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 30;
            border-bottom: 1px solid var(--panel-line);
            background: rgba(5, 5, 6, .84);
            backdrop-filter: blur(18px);
        }

        .nav {
            width: min(1180px, calc(100% - 32px));
            min-height: 76px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            min-width: max-content;
        }

        .brand img {
            width: auto;
            height: 48px;
            max-width: 170px;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        .nav-links a {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            padding: 0 14px;
            border-radius: 8px;
            transition: .18s ease;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #fff;
            background: rgba(255, 255, 255, .06);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 0;
            border-radius: 8px;
            padding: 0 16px;
            color: #fff;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .18s ease, background .18s ease, border-color .18s ease, color .18s ease;
            white-space: nowrap;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--brand), #5b21b6);
            box-shadow: 0 14px 30px rgba(126, 10, 133, .22);
        }

        .btn-secondary {
            border: 1px solid var(--panel-line);
            background: rgba(255, 255, 255, .05);
        }

        .btn-secondary:hover {
            border-color: rgba(255, 255, 255, .24);
            background: rgba(255, 255, 255, .09);
        }

        .btn-danger {
            border: 1px solid rgba(239, 68, 68, .55);
            background: rgba(239, 68, 68, .1);
            color: #fecaca;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, .18);
            border-color: rgba(239, 68, 68, .85);
        }

        .page-shell {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
            padding: 44px 0 72px;
        }

        .profile-hero {
            min-height: 240px;
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
            align-items: stretch;
            margin-bottom: 24px;
        }

        .hero-copy,
        .hero-panel,
        .profile-card {
            border: 1px solid var(--panel-line);
            border-radius: 8px;
            background: linear-gradient(180deg, rgba(255, 255, 255, .06), rgba(255, 255, 255, .025));
            box-shadow: 0 24px 60px rgba(0, 0, 0, .32);
        }

        .hero-copy {
            position: relative;
            overflow: hidden;
            padding: clamp(28px, 5vw, 48px);
        }

        .hero-copy::after {
            content: "";
            position: absolute;
            inset: auto -40px -100px auto;
            width: 280px;
            height: 280px;
            border-radius: 999px;
            background: rgba(126, 10, 133, .2);
            filter: blur(44px);
            pointer-events: none;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            min-height: 28px;
            padding: 0 10px;
            border: 1px solid rgba(167, 139, 250, .28);
            border-radius: 999px;
            background: rgba(126, 10, 133, .1);
            color: #ddd6fe;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        h1,
        h2,
        h3 {
            margin: 0;
            font-family: "Instrument Sans", Inter, sans-serif;
            letter-spacing: 0;
        }

        h1 {
            max-width: 780px;
            margin-top: 18px;
            font-size: clamp(36px, 6vw, 68px);
            line-height: .96;
        }

        h1 span,
        .accent {
            color: var(--brand-2);
        }

        .hero-copy p {
            max-width: 680px;
            margin: 18px 0 0;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.7;
        }

        .hero-panel {
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
            background:
                linear-gradient(145deg, rgba(126, 10, 133, .16), transparent 58%),
                rgba(17, 17, 19, .86);
        }

        .account-chip {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .avatar {
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--brand), #0ea5e9);
            color: #fff;
            font-size: 22px;
            font-weight: 900;
        }

        .account-chip strong {
            display: block;
            font-size: 17px;
        }

        .account-chip span {
            display: block;
            margin-top: 5px;
            color: var(--muted);
            font-size: 13px;
        }

        .hero-metrics {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .metric {
            min-height: 84px;
            border: 1px solid var(--panel-line);
            border-radius: 8px;
            padding: 14px;
            background: rgba(0, 0, 0, .18);
        }

        .metric strong {
            display: block;
            font-size: 20px;
        }

        .metric span {
            display: block;
            margin-top: 6px;
            color: var(--soft);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .profile-layout {
            display: grid;
            grid-template-columns: 300px minmax(0, 1fr);
            gap: 24px;
            align-items: start;
        }

        .profile-sidebar {
            position: sticky;
            top: 100px;
            display: grid;
            gap: 14px;
        }

        .sidebar-card {
            border: 1px solid var(--panel-line);
            border-radius: 8px;
            background: rgba(17, 17, 19, .82);
            padding: 20px;
        }

        .sidebar-card img {
            width: 150px;
            height: auto;
            display: block;
            margin-bottom: 18px;
            object-fit: contain;
        }

        .sidebar-title {
            color: #fff;
            font-size: 15px;
            font-weight: 900;
        }

        .sidebar-text {
            margin: 6px 0 0;
            color: var(--soft);
            font-size: 13px;
            line-height: 1.55;
        }

        .side-nav {
            display: grid;
            gap: 8px;
            margin-top: 16px;
        }

        .side-nav a,
        .side-nav button {
            width: 100%;
            min-height: 42px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid var(--panel-line);
            border-radius: 8px;
            background: rgba(255, 255, 255, .035);
            color: var(--muted);
            padding: 0 12px;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
        }

        .side-nav a:hover,
        .side-nav button:hover,
        .side-nav a.active {
            color: #fff;
            border-color: rgba(167, 139, 250, .36);
            background: rgba(126, 10, 133, .13);
        }

        .content-stack {
            display: grid;
            gap: 18px;
        }

        .profile-card {
            padding: clamp(22px, 4vw, 34px);
            background: rgba(17, 17, 19, .88);
        }

        .card-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 24px;
        }

        .card-head h2 {
            font-size: clamp(21px, 3vw, 30px);
        }

        .card-head p {
            max-width: 560px;
            margin: 8px 0 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.65;
        }

        .status-pill {
            min-height: 32px;
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            padding: 0 11px;
            background: rgba(34, 197, 94, .1);
            border: 1px solid rgba(34, 197, 94, .28);
            color: #bbf7d0;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            color: #d4d4d8;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        input {
            width: 100%;
            min-height: 48px;
            border: 1px solid var(--panel-line);
            border-radius: 8px;
            outline: 0;
            background: rgba(5, 5, 6, .72);
            color: #fff;
            padding: 0 14px;
            transition: border-color .18s ease, box-shadow .18s ease, background .18s ease;
        }

        input::placeholder {
            color: #52525b;
        }

        input:focus {
            border-color: rgba(167, 139, 250, .78);
            box-shadow: 0 0 0 4px rgba(126, 10, 133, .14);
            background: rgba(11, 11, 13, .92);
        }

        .form-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .success-msg,
        .error-msg {
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
        }

        .success-msg {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid rgba(34, 197, 94, .25);
            background: rgba(34, 197, 94, .09);
            color: #bbf7d0;
        }

        .error-msg {
            color: #fecaca;
        }

        .danger-card {
            border-color: rgba(239, 68, 68, .24);
            background:
                linear-gradient(135deg, rgba(239, 68, 68, .12), transparent 46%),
                rgba(17, 17, 19, .88);
        }

        .modal {
            position: fixed;
            inset: 0;
            z-index: 60;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: rgba(0, 0, 0, .72);
            backdrop-filter: blur(10px);
        }

        .modal.is-open {
            display: flex;
        }

        .modal-panel {
            width: min(460px, 100%);
            border: 1px solid var(--panel-line);
            border-radius: 8px;
            background: #111113;
            padding: 26px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .54);
        }

        .modal-panel h3 {
            font-size: 24px;
        }

        .modal-panel p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        @media (max-width: 900px) {
            .nav {
                min-height: auto;
                padding: 14px 0;
                align-items: flex-start;
                flex-direction: column;
            }

            .nav-links,
            .nav-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .profile-hero,
            .profile-layout {
                grid-template-columns: 1fr;
            }

            .profile-sidebar {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .page-shell,
            .nav {
                width: min(100% - 24px, 1180px);
            }

            .form-grid,
            .hero-metrics {
                grid-template-columns: 1fr;
            }

            .card-head {
                display: block;
            }

            .status-pill {
                margin-top: 14px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @php
        $user = Auth::user();
    @endphp

    <x-site-header />

    <main class="page-shell">
        <section class="profile-hero" aria-labelledby="profile-title">
            <div class="hero-copy">
                <span class="eyebrow">Conta Nova Tech</span>
                <h1 id="profile-title">Editar <span>perfil</span></h1>
                <p>Gerencie suas informações pessoais, segurança e preferências de conta. Mantenha seus dados atualizados para uma melhor experiência de compra.</p>
            </div>
        </section>

        <section class="profile-layout">
            <aside class="profile-sidebar" aria-label="Atalhos do perfil">
                <div class="sidebar-card">
                    <img src="{{ asset('images/nova-tech-logo.png') }}" alt="Nova Tech">
                    <div class="sidebar-title">Central da conta</div>
                   

                    <div class="side-nav">
                        <a class="active" href="#dados">Dados pessoais <span></span></a>
                        <a href="#seguranca">Segurança <span></span></a>
                        @if(($user->role ?? null) === 'admin')
                            <a href="{{ route('admin.dashboard') }}">Painel admin <span></span></a>
                        @else
                            <a href="{{ route('orders.index') }}">Meus pedidos <span></span></a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Sair da conta <span></span></button>
                        </form>
                    </div>
                </div>
            </aside>

            <div class="content-stack">
                <article class="profile-card" id="dados">
                    <div class="card-head">
                        <div>
                            <h2>Informações pessoais</h2>
                            
                        </div>
                        @if(session('status') === 'profile-updated')
                            <span class="status-pill">Perfil salvo</span>
                        @endif
                    </div>

                    @if(session('status') === 'profile-updated')
                        <div class="success-msg">Perfil atualizado com sucesso.</div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-grid">
                            <div class="field">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" placeholder="Seu nome completo">
                                @error('name')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" placeholder="seu@email.com">
                                @error('email')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field full">
                                <label for="logradouro">Rua</label>
                                <input type="text" id="logradouro" name="logradouro" value="{{ old('logradouro', $user->logradouro) }}" autocomplete="street-address" placeholder="Nome da rua">
                                @error('logradouro')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field">
                                <label for="numero">Numero</label>
                                <input type="text" id="numero" name="numero" value="{{ old('numero', $user->numero) }}" placeholder="N. da residencia">
                                @error('numero')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field">
                                <label for="cidade">Cidade</label>
                                <input type="text" id="cidade" name="cidade" value="{{ old('cidade', $user->cidade) }}" autocomplete="address-level2" placeholder="Sua cidade">
                                @error('cidade')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Salvar alterações</button>
                           
                        </div>
                    </form>
                </article>

                <article class="profile-card" id="seguranca">
                    <div class="card-head">
                        <div>
                            <h2>Segurança</h2>
                            
                        </div>
                        @if(session('status') === 'password-updated')
                            <span class="status-pill">Senha salva</span>
                        @endif
                    </div>

                    @if(session('status') === 'password-updated')
                        <div class="success-msg">Senha atualizada com sucesso.</div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-grid">
                            <div class="field full">
                                <label for="current_password">Senha atual</label>
                                <input type="password" id="current_password" name="current_password" autocomplete="current-password" placeholder="Digite sua senha atual">
                                @error('current_password', 'updatePassword')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field">
                                <label for="password">Nova senha</label>
                                <input type="password" id="password" name="password" autocomplete="new-password" placeholder="Minimo 8 caracteres">
                                @error('password', 'updatePassword')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>

                            <div class="field">
                                <label for="password_confirmation">Confirmar senha</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" placeholder="Repita a nova senha">
                                @error('password_confirmation', 'updatePassword')<span class="error-msg">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Atualizar senha</button>
                        </div>
                    </form>
                </article>

                <article class="profile-card danger-card">
                    <div class="card-head">
                        <div>
                            <h2>Zona de perigo</h2>
                            <p>Ao excluir a conta, os dados são removidos de forma permanente.</p>
                        </div>
                    </div>

                    <button type="button" class="btn btn-danger" data-open-delete>Deletar minha conta</button>
                </article>
            </div>
        </section>
    </main>

    <div class="modal {{ $errors->userDeletion->any() ? 'is-open' : '' }}" id="delete-modal" role="dialog" aria-modal="true" aria-labelledby="delete-title">
        <form class="modal-panel" method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <h3 id="delete-title">Confirmar exclusão</h3>
            <p>Digite sua senha para confirmar. Depois disso, sua conta não poderá ser recuperada.</p>

            <div class="field">
                <label for="delete_password">Senha</label>
                <input type="password" id="delete_password" name="password" autocomplete="current-password" placeholder="Confirme sua senha">
                @error('password', 'userDeletion')<span class="error-msg">{{ $message }}</span>@enderror
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" data-close-delete>Cancelar</button>
                <button type="submit" class="btn btn-danger">Sim, deletar conta</button>
            </div>
        </form>
    </div>

    <script>
        const deleteModal = document.getElementById('delete-modal');
        const openDeleteButtons = document.querySelectorAll('[data-open-delete]');
        const closeDeleteButtons = document.querySelectorAll('[data-close-delete]');

        openDeleteButtons.forEach((button) => {
            button.addEventListener('click', () => deleteModal.classList.add('is-open'));
        });

        closeDeleteButtons.forEach((button) => {
            button.addEventListener('click', () => deleteModal.classList.remove('is-open'));
        });

        deleteModal.addEventListener('click', (event) => {
            if (event.target === deleteModal) {
                deleteModal.classList.remove('is-open');
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                deleteModal.classList.remove('is-open');
            }
        });
    </script>
</body>
</html>
