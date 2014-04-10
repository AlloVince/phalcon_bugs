<?php
error_reporting(E_ALL);

$di = new \Phalcon\DI\FactoryDefault();

//Set up the database service
$di->set('db', function(){
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "dbname" => "scrapy"
    ));
});


class Tag extends Phalcon\Mvc\Model
{
    /**
    *
    * @var integer
    */
    public $id;

    /**
    *
     * @var string
     */
     public $tagName;


    public function getSource()
    {
        return "eva_blog_tags";
    }

    public function initialize()
    {
        $this->hasOne('id', 'Texts', 'post_id', array(
            'alias' => 'Text'
        ));
    }

}

class Text extends Phalcon\Mvc\Model
{
    /**
    *
    * @var integer
    */
    public $post_id;

    /**
    *
     * @var string
     */
     public $content;


    public function getSource()
    {
        return "eva_blog_texts";
    }

}

$post = new Tag();
$text = new Text();
$post->Text = $text;

$_POST = array(
    'tagName' => 'foo',
    'Text' => array(
        'content' => 'bar' 
    ),
);
/*
//should add below:
$text->assign($_POST['Text']);
unset($_POST['Text']);
*/

$post->assign($_POST);
$post->save();

