<?php
use Phalcon\Mvc\View;
error_reporting(E_ALL);
$view = new View();

$view->setViewsDir(__DIR__ . '/views/');
$view->setTemplateAfter('admin');
echo $view->render('user', 'index', array(
    'title' => 'abc'
));

