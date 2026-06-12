<?php
// Comentario Nova Tech: Arquivo tests/Feature/Auth/RegistrationTest.php. Origem: Testes automatizados. Conteudo: Testa automaticamente uma parte do comportamento da aplicacao.

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'logradouro' => 'Rua Teste',
        'numero' => '123',
        'cidade' => 'Sao Paulo',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
