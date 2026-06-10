<?php
// Comentario Nova Tech: Arquivo app/Http/Middleware/user.php. Origem: Camada de middleware. Conteudo: Filtra requisicoes antes de chegarem as rotas protegidas.

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class user
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->role != 'user'){
            return redirect('/home');

        }
        return $next($request);
    }
}
