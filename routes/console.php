<?php
// Comentario Nova Tech: Arquivo routes/console.php. Origem: Camada de rotas Laravel. Conteudo: Define comandos e agendamentos de console do Laravel.

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
