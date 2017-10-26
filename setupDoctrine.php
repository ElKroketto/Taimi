<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 19.10.2017
 * Time: 22:16
 */

//require 'Doctrine/ORM/Tools/Setup.php';

use elkroketto\taimi;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

include_once "dao/DB_config.php";

$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);

$conn = array(
    'driver' => 'pdo_mysql',
    'host' => DB_HOST,
    'dbname' => DB_DATABASE,
    'user' => DB_USER,
    'password' => DB_PASSWORD
);

$entityManager = EntityManager::create($conn, $config);

// Include Class-files
include_once "model/Client.php";
include_once "model/Project.php";
include_once "model/Task.php";
include_once "model/WorkBlock.php";
include_once "model/User.php";
include_once "model/UserSession.php";

// Test fully qualified class names for method getClassMetadata()
/*$c = new taimi\Client();
echo get_class($c);*/

$classes = array(
    $entityManager->getClassMetadata('elkroketto\taimi\Client'),
    $entityManager->getClassMetadata('elkroketto\taimi\Project'),
    $entityManager->getClassMetadata('elkroketto\taimi\Task'),
    $entityManager->getClassMetadata('elkroketto\taimi\WorkBlock'),
    $entityManager->getClassMetadata('elkroketto\taimi\User'),
    $entityManager->getClassMetadata('elkroketto\taimi\UserSession'),
);

if (isset($updateScheme) && $updateScheme) {
    $tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
    $tool->updateSchema($classes);
}
