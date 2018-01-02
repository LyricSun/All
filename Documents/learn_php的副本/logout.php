<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/17
 * Time: 下午3:46
 */

include 'db.php';

session_start();

if ($_SESSION['user']){

    jumpTo('login');

}


