<?php
use Phalcon\Mvc\View;
error_reporting(E_ALL);
$view = new View();

$view->setLayoutsDir(__DIR__ . '/layouts/');
$view->setLayout('admin');
$view->setViewsDir(__DIR__ . '/views/');
echo $view->render('user', 'index', array(
    'title' => 'abc'
));

