<?php

require_once __DIR__ . '/Controllers/PessoaController.php';
require_once __DIR__ . '/Controllers/ContatoController.php';

function handleRoutes($entityManager, $requestUri, $requestMethod)
{
    // Inicializa os controladores
    $pessoaController = new \Controllers\PessoaController($entityManager);
    $contatoController = new \Controllers\ContatoController($entityManager);

    // Divide a URI da solicitação em segmentos
    $uriSegments = explode('/', trim($requestUri, '/'));

    // Configuração das rotas
    switch ($uriSegments[0]) {
        case 'pessoas':
            if (!isset($uriSegments[1])) {
                $pessoaController->index();
            } elseif ($uriSegments[1] === 'create') {
                $pessoaController->create();
            } elseif ($uriSegments[1] === 'store' && $requestMethod === 'POST') {
                $data = $_POST;
                $pessoaController->store($data);
            } elseif (is_numeric($uriSegments[1])) {
                $id = (int)$uriSegments[1];
                if (!isset($uriSegments[2])) {
                    $pessoaController->show($id);
                } elseif ($uriSegments[2] === 'edit') {
                    $pessoaController->edit($id);
                } elseif ($uriSegments[2] === 'delete' && $requestMethod === 'POST') {
                    $pessoaController->destroy($id);
                }
            } elseif ($uriSegments[1] === 'update' && $requestMethod === 'POST') {
                $data = $_POST;
                $pessoaController->update($data);
            }
            break;
        case 'contatos':
            if (!isset($uriSegments[1])) {
                $contatoController->index();
            } elseif ($uriSegments[1] === 'create') {
                $contatoController->create();
            } elseif ($uriSegments[1] === 'store' && $requestMethod === 'POST') {
                $data = $_POST;
                $contatoController->store($data);
            } elseif (is_numeric($uriSegments[1])) {
                $id = (int)$uriSegments[1];
                if (!isset($uriSegments[2])) {
                    $contatoController->show($id);
                } elseif ($uriSegments[2] === 'edit') {
                    $contatoController->edit($id);
                } elseif ($uriSegments[2] === 'update' && $requestMethod === 'POST') {
                    $data = $_POST;
                    $contatoController->update($id, $data);
                } elseif ($uriSegments[2] === 'delete' && $requestMethod === 'POST') {
                    $contatoController->destroy($id);
                }
            }
            break;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "Página não encontrada.";
            break;
    }
}
