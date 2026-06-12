<?php
// Comentario Nova Tech: Arquivo tests/Feature/Auth/PasswordResetTest.php. Origem: Testes automatizados. Conteudo: Testa automaticamente uma parte do comportamento da aplicacao.

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

function passwordResetCodeFor(string $email): ?string
{
    return Cache::get('password_reset_code:' . sha1(strtolower($email)))['code'] ?? null;
}

test('reset password code request screen can be rendered', function () {
    $this->get('/forgot-password')->assertStatus(200);
});

test('reset password code can be requested', function () {
    Mail::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email])
        ->assertRedirect(route('password.code'));

    expect(passwordResetCodeFor($user->email))
        ->toMatch('/^\d{6}$/');
});

test('reset password code screen can be rendered after requesting code', function () {
    Mail::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    $this->get('/forgot-password/code')->assertStatus(200);
});

test('password can be reset with valid code', function () {
    Mail::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    $this->post('/forgot-password/code', [
        'email' => $user->email,
        'code' => passwordResetCodeFor($user->email),
    ])->assertRedirect(route('password.reset'));

    $this->post('/reset-password', [
        'email' => $user->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('login'));

    expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
});
