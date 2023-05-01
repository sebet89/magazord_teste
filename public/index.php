<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

// Configurações do Doctrine
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([__DIR__ . '/../models'], $isDevMode, null, null, false);


// Carrega as configurações do banco de dados do arquivo config.php
require_once __DIR__ . '/../config.php';
$entityManager = getEntityManager();

// Carrega e executa as rotas
require_once __DIR__ . '/../routes.php';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];
handleRoutes($entityManager, $requestUri, $requestMethod);
