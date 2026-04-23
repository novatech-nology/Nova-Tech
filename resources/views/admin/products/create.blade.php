<x-app-layout>
    <style>
        body { background-color: #09090b !important; color: #fff; }
        .tech-card { background-color: #121214; border: 1px solid #27272a; border-radius: 1rem; }
        .input-dark { background-color: #09090b; border: 1px solid #27272a; color: white; border-radius: 0.5rem; padding: 0.75rem; width: 100%; }
        .input-dark:focus { border-color: #7C3AED; outline: none; }
        select.input-dark option { background-color: #121214; color: white; }
    </style>

    <div class="py-12 bg-[#09090b] min-h-screen">
        <div class="max-w-3xl mx-auto px-6">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-white">Cadastrar Novo <span class="text-purple-500">Produto</span></h2>
                <a href="{{ route('admin.products.index') }}" class="text-zinc-400 hover:text-white text-sm">Voltar para lista</a>
            </div>

            <div class="tech-card p-8 shadow-2xl">
                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf

                    <div class="grid gap-6">
                        <div>
                            <label class="block text-zinc-400 text-sm mb-2">Nome do Smartphone</label>
                            <input type="text" name="name" class="input-dark" placeholder="Ex: iPhone 15 Pro Max" required>
                        </div>

                        <div>
                            <label class="block text-zinc-400 text-sm mb-2">Categoria / Marca</label>
                            <select name="category" class="input-dark" required>
                                <option value="" disabled selected>Selecione uma marca</option>
                                <option value="Apple">Apple</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Xiaomi">Xiaomi</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-zinc-400 text-sm mb-2">Descrição Curta</label>
                            <textarea name="description" class="input-dark" rows="3" placeholder="Detalhes técnicos..." required></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-zinc-400 text-sm mb-2">Preço (R$)</label>
                                <input type="number" step="0.01" name="price" class="input-dark" placeholder="0.00" required>
                            </div>
                            <div>
                                <label class="block text-zinc-400 text-sm mb-2">URL da Imagem</label>
                                <input type="url" name="image" class="input-dark" placeholder="https://...">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-bold py-3 rounded-lg transition mt-4">
                            SALVAR PRODUTO
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
