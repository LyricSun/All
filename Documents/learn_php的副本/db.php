<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/9/29
 * Time: 上午10:04
 */

define('DB_POST','127.0.0.1');

define('DB_USER','root');

define('DB_PASSWORD','123456');

define('DB_DATABASE','if_php');

define('FI_BASE','http://localhost/learn_php的副本/');

function jumpTo($desFile){

    header('location:'.FI_BASE.$desFile.'.php');

}