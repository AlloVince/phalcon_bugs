<?php

/**
 * Services are globally registered in this file
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;


/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a router
 */
$di['router'] = function () {

    $router = new Router();

    $router->setDefaultModule("frontend");
    $router->setDefaultNamespace("Eva\Frontend\Controllers");

    return $router;
};

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () {
    $url = new UrlResolver();
    $url->setBaseUri('/phalcon_bugs/master_slave_db_log/');

    return $url;
};

/**
 * Start the session the first time some component request the session service
 */
$di['session'] = function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
};


$di->set('dbMaster', function () use ($di) {
    $dbAdapter = new DbAdapter(array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '582tsost',
        'dbname' => '',
        'charset' => 'utf8',
    ));

    $eventsManager = new EventsManager();
    $logger = new FileLogger(__DIR__ . '/' . date('Y-m-d') . '.log');
    $eventsManager->attach('dbMaster', function($event, $dbAdapter) use ($logger) {
        if ($event->getType() == 'beforeQuery') {
            $logger->log($dbAdapter->getSQLStatement(), \Phalcon\Logger::INFO);
        }
    });
    $dbAdapter->setEventsManager($eventsManager);
    return $dbAdapter;
});


$di->set('dbSlave', function () use ($di) {
    $dbAdapter = new DbAdapter(array(
        'host' => 'localhost',
        'username' => 'root',
        'password' => '582tsost',
        'dbname' => '',
        'charset' => 'utf8',
    ));

    $eventsManager = new EventsManager();
    $logger = new FileLogger(__DIR__ . '/' . date('Y-m-d') . '.log');
    $eventsManager->attach('dbSlave', function($event, $dbAdapter) use ($logger) {
        if ($event->getType() == 'beforeQuery') {
            $logger->log($dbAdapter->getSQLStatement(), \Phalcon\Logger::INFO);
        }
    });
    $dbAdapter->setEventsManager($eventsManager);
    return $dbAdapter;
});
