<?php

/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/20
 * Time: 上午9:37
 */
class Model
{

    public $dbc;

    function __construct()
    {
        $config = require_once 'config.php';
        $this->dbc = mysqli_connect($config['POST'],$config['USER'],$config['PASSWORD'],$config['DATABASE'])or die(mysqli_connect_error('连接失败'));
    }

    public function query()
    {

    }

}


