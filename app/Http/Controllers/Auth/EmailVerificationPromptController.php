<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/Auth/EmailVerificationPromptController.php. Origem: Camada de autenticacao. Conteudo: Controla o fluxo de autenticacao, validando dados e direcionando views ou redirects.

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended(route('dashboard', absolute: false))
                    : view('auth.verify-email');
    }
}
