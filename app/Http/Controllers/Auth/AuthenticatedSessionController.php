<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/Auth/AuthenticatedSessionController.php. Origem: Camada de autenticacao. Conteudo: Controla o fluxo de autenticacao, validando dados e direcionando views ou redirects.

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Mostrar tela de login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Processar login
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // autentica usuário
        $request->authenticate();

        // evita session fixation attack
        $request->session()->regenerate();

        $user = $request->user();

        // 🔥 REDIRECIONAMENTO POR ROLE
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === 'user') {
            return redirect()->route('dashboard');
        }

        // se não tiver role válida, desloga por segurança
        Auth::logout();

        return redirect()->route('login')
            ->with('error', 'Acesso inválido.');
    }

    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
