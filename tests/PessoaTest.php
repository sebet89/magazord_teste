<?php

use PHPUnit\Framework\TestCase;
use Models\Pessoa;
use Controllers\PessoaController;

class PessoaTest extends TestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        require_once __DIR__ . '/../config.php';
        $this->entityManager = getEntityManager();
        $this->controller = new PessoaController($this->entityManager);
        $this->entityManager->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
        parent::tearDown();
    }

    public function testPessoaCreation()
    {
        $this->entityManager->rollback();
        $pessoa = new Pessoa();
        $pessoa->setNome('Teste');
        $pessoa->setCpf('82978748001');

        $this->assertSame('Teste', $pessoa->getNome());
        $this->assertSame('82978748001', $pessoa->getCpf());
    }

    public function testPessoaController()
    {
        $pessoaController = new PessoaController($this->entityManager);
        $pessoaData = [
            'nome' => 'Teste',
            'cpf' => '82978748001'
        ];

        // Teste o método store()
        $pessoaController->store($pessoaData);
        $createdPessoa = $this->entityManager->getRepository(Pessoa::class)->findOneBy(['cpf' => '82978748001']);
        $this->assertNotNull($createdPessoa);
        $this->assertSame('Teste', $createdPessoa->getNome());

        // Teste o método update()
        $updateData = [
            'id' => $createdPessoa->getId(),
            'nome' => 'Teste Atualizado',
            'cpf' => '82978748001'
        ];
        $pessoaController->update($updateData);
        $updatedPessoa = $this->entityManager->getRepository(Pessoa::class)->findOneBy(['cpf' => '82978748001']);
        $this->assertSame('Teste Atualizado', $updatedPessoa->getNome());

        // Teste o método destroy()
        $pessoaController->destroy($updatedPessoa->getId());
        $deletedPessoa = $this->entityManager->getRepository(Pessoa::class)->findOneBy(['cpf' => '82978748001']);
        $this->assertNull($deletedPessoa);
    }
}
