<?php
// Comentario Nova Tech: Arquivo app/Http/Controllers/Auth/NewPasswordController.php. Origem: Camada de autenticacao. Conteudo: Controla o fluxo de autenticacao, validando dados e direcionando views ou redirects.

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View|RedirectResponse
    {
        $email = $request->session()->get('password_reset_verified_email');

        if (! $email || ! Cache::get($this->verifiedCacheKey($email))) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password', ['email' => $email]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = strtolower((string) $request->string('email')->trim());

        if (
            $request->session()->get('password_reset_verified_email') !== $email ||
            ! Cache::get($this->verifiedCacheKey($email))
        ) {
            throw ValidationException::withMessages([
                'email' => 'Valide o código enviado por e-mail antes de redefinir a senha.',
            ]);
        }

        $user = User::where('email', $email)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'Não encontramos nenhuma conta com este e-mail.',
            ]);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        Cache::forget($this->verifiedCacheKey($email));
        Cache::forget($this->codeCacheKey($email));

        $request->session()->forget([
            'password_reset_email',
            'password_reset_verified_email',
        ]);

        return redirect()
            ->route('login')
            ->with('status', 'Senha redefinida com sucesso. Entre com sua nova senha.');
    }

    private function codeCacheKey(string $email): string
    {
        return 'password_reset_code:' . sha1($email);
    }

    private function verifiedCacheKey(string $email): string
    {
        return 'password_reset_verified:' . sha1($email);
    }
}
