<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Mapping;

function getEntityManager()
{
    // Caminho das entidades e metadados do banco de dados
    $paths = array(realpath(__DIR__ . '/models'));

    // Configuração do modo de desenvolvimento
    $isDevMode = true;

    // Configuração da conexão com o banco de dados
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'banco_teste',
        'user'     => 'root',
        'password' => '',
    );

    // Carregamento das anotações do Doctrine
    $annotationReader = new AnnotationReader();
    $cache = new ArrayCache();
    $cachedAnnotationReader = new CachedReader($annotationReader, $cache);

    // Configuração do Doctrine
    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
    $config->setMetadataDriverImpl(new Mapping\Driver\AnnotationDriver($cachedAnnotationReader, $paths));

    return EntityManager::create($dbParams, $config);
}
