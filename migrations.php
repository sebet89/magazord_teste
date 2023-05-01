<?php

use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\Migrations\Configuration\Migration\YamlFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Symfony\Component\Console\Helper\HelperSet;

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/config.php';

$entityManager = EntityManager::create($dbParams, $config);

$connection = $entityManager->getConnection();
$configurationFile = __DIR__ . '/migrations.yaml';

$configuration = new YamlFile($configurationFile);
$dependencyFactory = DependencyFactory::fromEntityManager($configuration, new ExistingEntityManager($entityManager));

$helperSet = new HelperSet();
$helperSet->set(new ConnectionHelper($connection), 'db');
$helperSet->set(new EntityManagerHelper($entityManager), 'em');
$helperSet->set(new ConfigurationHelper($connection, $dependencyFactory->getConfiguration()), 'configuration');

return $helperSet;
