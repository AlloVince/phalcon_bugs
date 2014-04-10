<?php
error_reporting(E_ALL);

$di = new \Phalcon\DI\FactoryDefault();

//Set up the database service
$di->set('db', function(){
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => "localhost",
        "username" => "root",
        "password" => "582tsost",
        "dbname" => "scrapy"
    ));
});


class Users extends Phalcon\Mvc\Model
{
    public $id;

    public function getSource()
    {
        return "eva_user_users";
    }

}

$users = Users::find();

$paginator = new \Phalcon\Paginator\Adapter\Model(
    array(
        "data" => $users,
        "limit"=> 10,
        "page" => 1
    )
);

print_r($paginator->getPaginate());


