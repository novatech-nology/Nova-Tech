<?php
// Comentario Nova Tech: Arquivo tests/Feature/ExampleTest.php. Origem: Testes automatizados. Conteudo: Testa automaticamente uma parte do comportamento da aplicacao.

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
