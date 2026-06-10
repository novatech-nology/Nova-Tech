<?php
// Comentario Nova Tech: Arquivo app/Http/Middleware/Admin.php. Origem: Camada de middleware. Conteudo: Filtra requisicoes antes de chegarem as rotas protegidas.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    // Se não estiver logado ou não for admin, manda para o dashboard de cliente
    if (!Auth::check() || Auth::user()->role != 'admin') {
        return redirect('/dashboard')->with('error', 'Acesso restrito ao painel administrativo.');
    }

    return $next($request);
}
}
