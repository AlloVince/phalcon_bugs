<?php


namespace Eva\Frontend\Models;


class User extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;
     
    /**
     *
     * @var integer
     */
    public $name;

    public function initialize()
    {
        $this->setWriteConnectionService('dbMaster');
        $this->setReadConnectionService('dbSlave');
    }
}
