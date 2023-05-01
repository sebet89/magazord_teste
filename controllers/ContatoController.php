<?php
namespace Controllers;

require_once __DIR__ . '/../config.php';

use Models\Contato;
use Models\Pessoa;

use Utils\Validation;

class ContatoController
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index()
    {
        $contatos = $this->entityManager->getRepository(Contato::class)->findAll();
        require './../views/contatos/index.php';
    }

    public function create()
    {
        $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
        require './../views/contatos/create.php';
    }

    public function store($data)
    {
        if ($data['tipo'] === 'Email' && !Validation::validateEmail($data['descricao'])) {
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
            $error = 'Email inválido. Por favor, insira um Email válido.';

            require './../views/contatos/create.php';
            return;
        }
    
        if ($data['tipo'] === 'Telefone' && !Validation::validatePhone($data['descricao'])) {
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
            $error = 'Telefone inválido. Por favor, insira um Telefone válido.';

            require './../views/contatos/create.php';
            return;
        }

        $contato = new Contato();
        $contato->setTipo($data['tipo']);
        $contato->setDescricao($data['descricao']);

        $pessoa = $this->entityManager->find(Pessoa::class, $data['pessoa_id']);
        $contato->setPessoa($pessoa);

        $this->entityManager->persist($contato);
        $this->entityManager->flush();
        header('Location: /contatos');
    }

    public function show($id)
    {
        $contato = $this->entityManager->find(Contato::class, $id);
        require './../views/contatos/show.php';
    }

    public function edit($id)
    {
        $contato = $this->entityManager->find(Contato::class, $id);
        $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
        require './../views/contatos/edit.php';
    }

    public function update($id, $data)
    {
        if ($data['tipo'] === 'Email' && !Validation::validateEmail($data['descricao'])) {
            $error = 'Email inválido. Por favor, insira um Email válido.';

            $contato = $this->entityManager->find(Contato::class, $id);
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
            require './../views/contatos/edit.php';
            return;
        }
    
        if ($data['tipo'] === 'Telefone' && !Validation::validatePhone($data['descricao'])) {
            $error = 'Telefone inválido. Por favor, insira um Telefone válido.';

            $contato = $this->entityManager->find(Contato::class, $id);
            $pessoas = $this->entityManager->getRepository(Pessoa::class)->findAll();
            require './../views/contatos/edit.php';
            return;
        }

        $contato = $this->entityManager->find(Contato::class, $id);
        $contato->setTipo($data['tipo']);
        $contato->setDescricao($data['descricao']);

        $pessoa = $this->entityManager->find(Pessoa::class, $data['pessoa_id']);
        $contato->setPessoa($pessoa);

        $this->entityManager->flush();
        header('Location: /contatos');
    }

    public function destroy($id)
    {
        $contato = $this->entityManager->find(Contato::class, $id);
        $this->entityManager->remove($contato);
        $this->entityManager->flush();
        header('Location: /contatos');
    }
}