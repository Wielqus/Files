<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Flash\Direct as FlashDirect;
use Phalcon\Flash\Session as FlashSession;

define(
    "APP_PATH", realpath("..") . "/"
);

ini_set('display_errors', 1);
error_reporting(\E_ALL);

// Read the configuration
$config = new ConfigIni(
    APP_PATH . "app/config/config.ini"
);

require APP_PATH . "app/config/loader.php";








// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set(
    "view", function (){
  $view = new View();

  $view->setViewsDir(__DIR__ . "/../app/views/");

  return $view;
}
);





// Setup a base URI so that all generated URIs include the "tutorial" folder
require APP_PATH . "app/config/services.php";





// Start the session the first time a component requests the session service
$di->set(
    "session", function (){
  $session = new Session();

  $session->start();

  return $session;
}
);

// Set up the flash service
$di->set(
    "flash",
    function () {
        return new FlashDirect();
    }
);

// Set up the flash session service
$di->set(
    "flashSession",
    function () {
        return new FlashSession();
    }
);

// Database connection is created based on parameters defined in the configuration file
$di->setShared(
    "db", function () use ($config){
  return new DbAdapter(
      [
    "host" => $config->database->host,
    "username" => $config->database->username,
    "password" => $config->database->password,
    "dbname" => $config->database->dbname,
      ]
  );
}
);




$application = new Application($di);

$response = $application->handle();

$response->send();
