// Comentario Nova Tech: Arquivo vite.config.js. Origem: Arquivo raiz do projeto. Conteudo: Arquivo de configuracao ou script JavaScript do projeto.
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
