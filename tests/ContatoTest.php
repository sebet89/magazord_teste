<?php

use PHPUnit\Framework\TestCase;
use Controllers\ContatoController;
use Models\Pessoa;
use Models\Contato;

class ContatoTest extends TestCase
{
    private $entityManager;
    private $controller;

    protected function setUp(): void
    {
        parent::setUp();
        require_once __DIR__ . '/../config.php';
        $this->entityManager = getEntityManager();
        $this->controller = new ContatoController($this->entityManager);
        $this->entityManager->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->entityManager->rollback();
        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
        parent::tearDown();
    }

    public function testCreateNewContato()
    {
        // Preparar os dados da Pessoa
        $pessoa = new Pessoa();
        $pessoa->setNome('Test Person');
        $pessoa->setCpf('82978748001');
        $this->entityManager->persist($pessoa);
        $this->entityManager->flush();

        // Preparar os dados do Contato
        $data = [
            'tipo' => 'Telefone',
            'descricao' => '21966521147',
            'pessoa_id' => $pessoa->getId(),
        ];

        // Chamar o método store() do ContatoController
        $this->controller->store($data);

        // Verificar se o contato foi adicionado ao banco de dados
        $contato = $this->entityManager->getRepository(Contato::class)->findOneBy([
            'tipo' => $data['tipo'],
            'descricao' => $data['descricao'],
            'pessoa' => $pessoa,
        ]);

        $this->assertNotNull($contato, 'Contato não foi adicionado ao banco de dados');
        $this->assertSame($pessoa, $contato->getPessoa(), 'A pessoa associada ao contato não corresponde');
    }
}
