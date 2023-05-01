<?php
namespace Controllers;

require_once __DIR__ . '/../config.php';

use Models\Pessoa;
use Models\Contato;

use Utils\Validation;

class PessoaController
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index()
    {
        $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
        require './../views/pessoas/index.php';
    }

    public function create()
    {
        require './../views/pessoas/create.php';
    }

    public function store($data)
    {
        if (!Validation::validateCPF($data['cpf'])) {
            $error = 'CPF inválido. Por favor, insira um CPF válido.';
    
            require './../views/pessoas/create.php';
            return;
        }

        $pessoa = new Pessoa();
        $pessoa->setNome($data['nome']);
        $pessoa->setCpf($data['cpf']);
        $this->entityManager->persist($pessoa);
        $this->entityManager->flush();
        header('Location: /pessoas');
    }

    public function show($id)
    {
        $pessoa = $this->entityManager->find(Pessoa::class, $id);
        require './../views/pessoas/show.php';
    }

    public function edit($id)
    {
        $pessoa = $this->entityManager->find(Pessoa::class, $id);
        require './../views/pessoas/edit.php';
    }

    public function update($data)
    {
        if (!Validation::validateCPF($data['cpf'])) {
            $error = 'CPF inválido. Por favor, insira um CPF válido.';

            $pessoa = $this->entityManager->find(Pessoa::class, $data['id']);
    
            require './../views/pessoas/edit.php';
            return;
        }

        $id = $data['id'];
        $pessoa = $this->entityManager->find(Pessoa::class, $id);
        $pessoa->setNome($data['nome']);
        $pessoa->setCpf($data['cpf']);
        $this->entityManager->flush();
        header('Location: /pessoas');
    }

    public function destroy($id)
    {
        $pessoa = $this->entityManager->find(Pessoa::class, $id);

        if ($pessoa === null) {
            http_response_code(404);
            echo 'Pessoa não encontrada';
            return;
        }

        // Exclui todos os contatos relacionados à pessoa
        $contatos = $this->entityManager->getRepository(Contato::class)->findBy(['pessoa' => $pessoa]);
        foreach ($contatos as $contato) {
            $this->entityManager->remove($contato);
        }

        $this->entityManager->remove($pessoa);
        $this->entityManager->flush();

        header('Location: /pessoas');
    }
}
