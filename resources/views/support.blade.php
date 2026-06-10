{{-- Comentario Nova Tech: Arquivo resources/views/support.blade.php. Origem: Views publicas e da loja. Conteudo: Monta uma tela principal do site usando Blade, HTML e estilos da interface. --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Suporte | {{ config('app.name', 'Nova Tech') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|inter:400,500,600,700,800" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-color: #09090b !important;
            color: #ffffff !important;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, .font-heading {
            font-family: 'Instrument Sans', sans-serif;
        }

        .btn-purple {
            background-color: #7e0a85;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 600;
        }

        .btn-purple:hover {
            background-color: #5c0760;
            transform: translateY(-2px);
        }

        .support-hero {
            background:
                radial-gradient(circle at 70% 40%, rgba(126, 10, 133, 0.22) 0%, transparent 42rem),
                linear-gradient(135deg, #09090b 0%, #18111f 52%, #09090b 100%);
            border-bottom: 1px solid rgba(63, 63, 70, 0.55);
        }

        .support-shell {
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            gap: 2rem;
            align-items: start;
        }

        .support-nav {
            position: sticky;
            top: 1.5rem;
            border: 1px solid #27272a;
            border-radius: 1rem;
            background: #121214;
            padding: 0.5rem;
        }

        .support-nav a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.8rem 0.95rem;
            border-radius: 0.75rem;
            color: #a1a1aa;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .support-nav a:hover,
        .support-nav a.active {
            background: rgba(126, 10, 133, 0.14);
            color: #c4b5fd;
        }

        .support-nav span {
            width: 1.85rem;
            height: 1.85rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.05);
            color: #a78bfa;
            font-size: 0.72rem;
            font-weight: 800;
            flex-shrink: 0;
        }

        .support-section {
            border: 1px solid #27272a;
            border-radius: 1rem;
            background: #121214;
            padding: 2rem;
            margin-bottom: 1.5rem;
            scroll-margin-top: 1.5rem;
        }

        .support-section-header {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding-bottom: 1.25rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #27272a;
        }

        .support-section-icon {
            width: 2.75rem;
            height: 2.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            background: rgba(126, 10, 133, 0.14);
            color: #a78bfa;
            font-weight: 800;
            flex-shrink: 0;
        }

        .support-section h2 {
            color: #ffffff;
            font-size: 1.35rem;
            font-weight: 800;
        }

        .support-section h3 {
            margin: 1.4rem 0 0.5rem;
            color: #a78bfa;
            font-size: 1rem;
            font-weight: 800;
        }

        .support-section p,
        .support-section li {
            color: #a1a1aa;
            line-height: 1.75;
        }

        .support-section ul,
        .support-section ol {
            padding-left: 1.35rem;
            margin: 0.75rem 0 1rem;
        }

        .support-section ul {
            list-style: disc;
        }

        .support-section ol {
            list-style: decimal;
        }

        .faq-item {
            border: 1px solid #27272a;
            border-radius: 0.75rem;
            overflow: hidden;
            margin-bottom: 0.7rem;
            background: #18181b;
        }

        .faq-question {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.95rem 1rem;
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 700;
            text-align: left;
        }

        .faq-question .arrow {
            color: #a78bfa;
            transition: transform 0.2s ease;
        }

        .faq-question.open .arrow {
            transform: rotate(180deg);
        }

        .faq-answer {
            display: none;
            padding: 0 1rem 1rem;
            color: #a1a1aa;
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .faq-answer.open {
            display: block;
        }

        .info-box {
            padding: 1rem 1.1rem;
            border-radius: 0.75rem;
            margin: 1rem 0;
            color: #d4d4d8;
            line-height: 1.65;
        }

        .info-box.purple {
            background: rgba(126, 10, 133, 0.1);
            border-left: 3px solid #8b5cf6;
        }

        .info-box.green {
            background: rgba(34, 197, 94, 0.1);
            border-left: 3px solid #22c55e;
        }

        .info-box.yellow {
            background: rgba(234, 179, 8, 0.1);
            border-left: 3px solid #eab308;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .contact-card {
            border: 1px solid #27272a;
            border-radius: 0.85rem;
            background: #18181b;
            padding: 1.5rem;
            text-align: center;
        }

        .contact-card .icon {
            color: #a78bfa;
            font-size: 1.35rem;
            font-weight: 800;
            margin-bottom: 0.65rem;
        }

        .support-form {
            display: grid;
            gap: 1rem;
            margin-top: 1rem;
        }

        .support-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.4rem;
            color: #a1a1aa;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #27272a;
            border-radius: 0.75rem;
            background: #09090b;
            color: #ffffff;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-control:focus {
            border-color: #7e0a85;
            box-shadow: 0 0 0 3px rgba(126, 10, 133, 0.2);
        }

        .support-toast {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            display: none;
            max-width: 22rem;
            padding: 1rem 1.25rem;
            border: 1px solid rgba(34, 197, 94, 0.35);
            border-radius: 0.85rem;
            background: #121214;
            color: #dcfce7;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.35);
            z-index: 60;
        }

        .support-toast.show {
            display: block;
        }

        @media (max-width: 900px) {
            .support-shell,
            .contact-grid,
            .support-form-grid {
                grid-template-columns: 1fr;
            }

            .support-nav {
                position: static;
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 520px) {
            .support-section {
                padding: 1.25rem;
            }

            .support-nav {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center">
    <x-site-header active="support" />

    <main class="w-full">
        <section class="support-hero">
            <div class="max-w-7xl mx-auto px-6 lg:px-12 py-20 lg:py-24">
                <span class="text-purple-500 font-semibold uppercase tracking-widest text-sm">Suporte Nova Tech</span>
                <h1 class="text-5xl lg:text-7xl font-bold leading-tight mt-4 mb-6 font-heading">
                    Como podemos <span class="text-purple-500">ajudar?</span>
                </h1>
                <p class="text-zinc-400 text-lg max-w-2xl">
                    Encontre respostas, políticas de compra e canais de contato para resolver tudo com a nossa equipe.
                </p>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-12">
            <div class="support-shell">
                <nav class="support-nav" aria-label="Secoes de suporte">
                    <a href="#central-ajuda" class="active"><span>?</span> Central de Ajuda</a>
                    <a href="#politica-troca"><span>P</span> Política de Troca</a>
                    <a href="#garantia"><span>G</span> Garantia</a>
                    <a href="#fale-conosco"><span>F</span> Fale Conosco</a>
                    <a href="#termos-de-uso"><span>T</span> Termos de Uso</a>
                </nav>

                <div>
                    <section class="support-section" id="central-ajuda">
                        <div class="support-section-header">
                            <div class="support-section-icon">?</div>
                            <h2>Central de Ajuda</h2>
                        </div>

                        <p>Bem-vindo a Central de Ajuda da <strong>Nova Tech</strong>. Aqui você encontra respostas para dúvidas frequentes sobre pedidos, pagamentos, entregas e acesso a conta.</p>

                        <h3>Meu Pedido</h3>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Como rastrear meu pedido? <span class="arrow">v</span></button>
                            <div class="faq-answer">Após a confirmação do envio, voce receberá um código de rastreio por e-mail. Também é possivel acompanhar o status em Minha Conta / Meus Pedidos.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Qual o prazo de entrega? <span class="arrow">v</span></button>
                            <div class="faq-answer">O pedido é preparado em até 1 dia útil após a confirmação do pagamento. A entrega costuma levar de 3 à 10 dias úteis, dependendo da região.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Posso alterar o endereço após o pedido? <span class="arrow">v</span></button>
                            <div class="faq-answer">Alterações de endereço são possíveis apenas se o pedido ainda não tiver sido despachado. Entre em contato com o suporte o quanto antes.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Como cancelar um pedido? <span class="arrow">v</span></button>
                            <div class="faq-answer">Pedidos podem ser cancelados enquanto estiverem em processamento. Acesse Meus Pedidos ou fale com nossa equipe.</div>
                        </div>

                        <h3>Pagamento</h3>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Quais formas de pagamento são aceitas? <span class="arrow">v</span></button>
                            <div class="faq-answer">Aceitamos PIX, boleto e cartão de crédito. O fluxo de pagamento registra os pedidos no backend do projeto.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Meu pagamento foi recusado. O que fazer? <span class="arrow">v</span></button>
                            <div class="faq-answer">Confira os dados informados, limite disponível e autorização para compras online. Se o problema persistir, tente outro método ou procure o suporte.</div>
                        </div>

                        <h3>Conta e Acesso</h3>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Esqueci minha senha. Como recuperar? <span class="arrow">v</span></button>
                            <div class="faq-answer">Acesse <a href="{{ route('password.request') }}" class="text-purple-400 font-semibold">recuperar senha</a>, informe seu e-mail e siga as instruções enviadas.</div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question" type="button">Como alterar meus dados pessoais? <span class="arrow">v</span></button>
                            <div class="faq-answer">Entre em Minha Conta / Perfil para atualizar nome, e-mail e dados de endereço quando necessário.</div>
                        </div>
                    </section>

                    <section class="support-section" id="politica-troca">
                        <div class="support-section-header">
                            <div class="support-section-icon">TR</div>
                            <h2>Politica de Troca e Devolucao</h2>
                        </div>

                        <div class="info-box purple">Nossa política segue o Código de Defesa do Consumidor, garantindo seus direitos em compras realizadas pela internet.</div>

                        <h3>Prazo para Devolução</h3>
                        <p>Voce tem até <strong>7 dias corridos</strong> após o recebimento para solicitar devolução por arrependimento. Em caso de defeito, smartphones contam com prazo legal de até <strong>90 dias corridos</strong>.</p>

                        <h3>Condicoes do Produto</h3>
                        <ul>
                            <li>Produto na embalagem original, sem danos causados por mau uso.</li>
                            <li>Todos os acessórios, manuais e itens enviados na caixa.</li>
                            <li>Nota fiscal ou comprovante de compra.</li>
                            <li>Sem modificacoes de software, root ou desbloqueio indevido.</li>
                        </ul>

                        <h3>Como Solicitar</h3>
                        <ol>
                            <li>Acesse Meus Pedidos e selecione o pedido.</li>
                            <li>Entre em contato informando o motivo da troca ou devolução.</li>
                            <li>Aguarde a avaliação da equipe em até 2 dias úteis.</li>
                            <li>Receba as orientações de envio e acompanhe o andamento.</li>
                            <li>Após a análise, o reembolso ou troca é processado.</li>
                        </ol>

                        <div class="info-box yellow">Danos físicos causados pelo cliente, queda, líquido ou uso de acessórios inadequados não são cobertos pela política de troca.</div>
                    </section>

                    <section class="support-section" id="garantia">
                        <div class="support-section-header">
                            <div class="support-section-icon">G</div>
                            <h2>Garantia</h2>
                        </div>

                        <div class="info-box green">Todos os produtos vendidos na Nova Tech são originais, com nota fiscal e garantia conforme fabricante e legislação brasileira.</div>

                        <h3>Garantia do Fabricante</h3>
                        <p>A maioria dos smartphones possui garantia adicional do fabricante de até <strong>12 meses</strong>, além da garantia legal prevista para produtos duráveis.</p>
                        <ul>
                            <li><strong>Apple:</strong> garantia limitada e suporte autorizado.</li>
                            <li><strong>Samsung:</strong> assistências autorizadas em todo o Brasil.</li>
                            <li><strong>Xiaomi:</strong> garantia conforme disponibilidade oficial no Brasil.</li>
                            <li><strong>Motorola:</strong> atendimento pela rede autorizada da marca.</li>
                        </ul>

                        <h3>O que a Garantia Cobre</h3>
                        <ul>
                            <li>Defeitos de fabricação em tela, bateria, câmera, botões ou software original.</li>
                            <li>Problemas de hardware que não tenham sido causados por mau uso.</li>
                            <li>Falhas surgidas em uso normal do aparelho.</li>
                        </ul>

                        <h3>Como Acionar</h3>
                        <ol>
                            <li>Entre em contato com foto, vídeo e descrição do defeito.</li>
                            <li>Nossa equipe avalia o caso e indica o melhor caminho.</li>
                            <li>Quando aplicável, você pode procurar a assistência autorizada com a nota fiscal.</li>
                        </ol>
                    </section>

                    <section class="support-section" id="fale-conosco">
                        <div class="support-section-header">
                            <div class="support-section-icon">FC</div>
                            <h2>Fale Conosco</h2>
                        </div>

                        <p>Nossa equipe de suporte esta pronta para ajudar. Escolha o canal mais conveniente:</p>

                        <div class="contact-grid">
                            <div class="contact-card">
                                <div class="icon">@</div>
                                <h4 class="font-bold mb-2">E-mail</h4>
                                <p>Resposta em até 2 dias úteis. Disponível 24h para envio.</p>
                                <a class="btn-purple mt-4 py-2 px-4 text-sm" href="mailto:suporte@novatech.com.br">Enviar E-mail</a>
                            </div>
                            <div class="contact-card">
                                <div class="icon">4002-8922</div>
                                <h4 class="font-bold mb-2">Telefone</h4>
                                <p>Estamos disponíveis de segunda à sexta, das 09h às 18h.</p>
                                <a class="btn-purple mt-4 py-2 px-4 text-sm" href="tel:40028922">Ligar Agora</a>
                            </div>
                        </div>

                        <h3>Formulário de Contato</h3>
                        <p>Prefere escrever? Preencha abaixo e retornaremos em até 1 dia útil.</p>

                        <form class="support-form" data-support-form>
                            <div class="support-form-grid">
                                <div>
                                    <label class="form-label" for="support-name">Nome</label>
                                    <input id="support-name" type="text" class="form-control" name="name" placeholder="Seu nome completo" required>
                                </div>
                                <div>
                                    <label class="form-label" for="support-email">E-mail</label>
                                    <input id="support-email" type="email" class="form-control" name="email" placeholder="seu@email.com" required>
                                </div>
                            </div>
                            <div>
                                <label class="form-label" for="support-subject">Assunto</label>
                                <select id="support-subject" class="form-control" name="subject" required>
                                    <option value="">Selecione o assunto</option>
                                    <option>Dúvida sobre pedido</option>
                                    <option>Troca ou devolução</option>
                                    <option>Problema com pagamento</option>
                                    <option>Garantia ou defeito</option>
                                    <option>Outros</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label" for="support-message">Mensagem</label>
                                <textarea id="support-message" class="form-control" name="message" rows="5" placeholder="Descreva sua dúvida ou problema em detalhes" required></textarea>
                            </div>
                            <button type="submit" class="btn-purple w-fit">Enviar Mensagem</button>
                        </form>

                        <h3>Localização</h3>
                        <p><strong>Nova Tech Ltda.</strong> - Av. Paulista, 1374 - Bela Vista, São Paulo - SP, 01310-100</p>
                        <p>CNPJ: 00.000.000/0001-00 | SAC: 4002-8922 | suporte@novatech.com.br</p>
                    </section>

                    <section class="support-section" id="termos-de-uso">
                        <div class="support-section-header">
                            <div class="support-section-icon">T</div>
                            <h2>Termos de Uso</h2>
                        </div>

                        <p class="text-zinc-500">Última atualização: 21 de maio de 2026</p>

                        <h3>1. Aceitação dos Termos</h3>
                        <p>Ao acessar e utilizar a plataforma Nova Tech, você concorda com estes Termos de Uso. Caso não concorde com alguma disposição, pedimos que não utilize nossos serviços.</p>

                        <h3>2. Cadastro e Conta</h3>
                        <p>Para comprar, é necessário criar uma conta com informações verdadeiras e atualizadas. Você é responsável pela confidencialidade da senha e pelas atividades feitas na conta.</p>

                        <h3>3. Produtos e Preços</h3>
                        <p>Os preços são exibidos em reais e podem ser alterados sem aviso prévio, exceto para pedidos já confirmados.</p>

                        <h3>4. Processo de Compra</h3>
                        <p>A confirmação do pedido ocorre após aprovação ou registro do pagamento. O prazo de entrega começa a contar a partir da confirmação do pagamento.</p>

                        <h3>5. Privacidade e Dados Pessoais</h3>
                        <p>O tratamento de dados pessoais segue a LGPD. Os dados são utilizados para processar pedidos, autenticar usuários e personalizar a experiência.</p>

                        <div class="info-box purple">Dúvidas sobre os Termos de Uso? Envie um e-mail para <strong>juridico@novatech.com.br</strong>.</div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <footer class="w-full border-t border-zinc-800/50 bg-zinc-950/60">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-8 text-center text-sm text-zinc-500">
            <p>2026 Nova Tech - Todos os direitos reservados.</p>
            <p class="mt-1">CNPJ 00.000.000/0001-00 | <a class="text-purple-400" href="#termos-de-uso">Termos de Uso</a></p>
        </div>
    </footer>

    <div class="support-toast" data-support-toast>Mensagem enviada. Retornaremos em até 1 dia útil.</div>

    <script>
        document.querySelectorAll('.faq-question').forEach((button) => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                const isOpen = button.classList.contains('open');

                document.querySelectorAll('.faq-question.open').forEach((openButton) => {
                    openButton.classList.remove('open');
                    openButton.nextElementSibling.classList.remove('open');
                });

                if (!isOpen) {
                    button.classList.add('open');
                    answer.classList.add('open');
                }
            });
        });

        const sections = document.querySelectorAll('.support-section');
        const navLinks = document.querySelectorAll('.support-nav a');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                navLinks.forEach((link) => link.classList.remove('active'));
                const active = document.querySelector(`.support-nav a[href="#${entry.target.id}"]`);
                if (active) active.classList.add('active');
            });
        }, { rootMargin: '-30% 0px -60% 0px' });

        sections.forEach((section) => observer.observe(section));

        document.querySelector('[data-support-form]').addEventListener('submit', (event) => {
            event.preventDefault();
            const toast = document.querySelector('[data-support-toast]');
            toast.classList.add('show');
            event.currentTarget.reset();
            window.setTimeout(() => toast.classList.remove('show'), 3200);
        });
    </script>
</body>
</html>
