<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/Auth/PasswordResetLinkController.php. Origem: Camada de autenticacao. Conteudo: Controla o fluxo de autenticacao, validando dados e direcionando views ou redirects.

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower((string) $request->string('email')->trim());
        $user = User::where('email', $email)->first();

        if ($user) {
            $code = (string) random_int(100000, 999999);

            Cache::put($this->codeCacheKey($email), [
                'email' => $email,
                'code' => $code,
                'attempts' => 0,
            ], now()->addMinutes(15));

            Cache::forget($this->verifiedCacheKey($email));

            try {
                Mail::raw($this->resetCodeMessage($code), function ($message) use ($email) {
                    $message
                        ->to($email)
                        ->subject('ódigo de recuperação de senha - Nova Tech');
                });
            } catch (Throwable $exception) {
                report($exception);

                Cache::forget($this->codeCacheKey($email));

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Não foi possivel enviar o código. Tente novamente mais tarde.',
                    ]);
            }
        }

        $request->session()->put('password_reset_email', $email);
        $request->session()->forget('password_reset_verified_email');

        return redirect()
            ->route('password.code')
            ->with('status', 'Enviamos um código de 6 digitos para o e-mail informado.');
    }

    public function code(Request $request): View|RedirectResponse
    {
        if (! $request->session()->has('password_reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.password-code', [
            'email' => $request->session()->get('password_reset_email'),
        ]);
    }

    public function verifyCode(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'code' => ['required', 'digits:6'],
        ]);

        $email = strtolower((string) $request->string('email')->trim());
        $payload = Cache::get($this->codeCacheKey($email));

        if (! $payload) {
            throw ValidationException::withMessages([
                'code' => 'Código expirado ou inexistente. Solicite um novo código.',
            ]);
        }

        if (($payload['attempts'] ?? 0) >= 5) {
            Cache::forget($this->codeCacheKey($email));

            throw ValidationException::withMessages([
                'code' => 'Muitas tentativas incorretas. Solicite um novo código.',
            ]);
        }

        if (! hash_equals($payload['code'], $request->code)) {
            $payload['attempts'] = ($payload['attempts'] ?? 0) + 1;
            Cache::put($this->codeCacheKey($email), $payload, now()->addMinutes(15));

            throw ValidationException::withMessages([
                'code' => 'Código invalido. Confira o e-mail e tente novamente.',
            ]);
        }

        Cache::put($this->verifiedCacheKey($email), true, now()->addMinutes(15));

        $request->session()->put('password_reset_email', $email);
        $request->session()->put('password_reset_verified_email', $email);

        return redirect()->route('password.reset');
    }

    private function codeCacheKey(string $email): string
    {
        return 'password_reset_code:' . sha1($email);
    }

    private function verifiedCacheKey(string $email): string
    {
        return 'password_reset_verified:' . sha1($email);
    }

    private function resetCodeMessage(string $code): string
    {
        return "Nova Tech\n\n"
            . "Seu código de recuperação de senha é: {$code}\n\n"
            . "Esse código expira em 15 minutos.\n"
            . "Se você não solicitou a recuperação, ignore este e-mail.";
    }
}
