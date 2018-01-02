<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/17
 * Time: 下午2:09
 */

include 'db.php';


if ($_SESSION['user']){

    jumpTo('login');

}

$url = $_SERVER['HTTP_REFERER'];

var_dump($url);

if($url == 'http://localhost/learn_php的副本/update.php'){

    echo '<script>alert("修改成功")</script>';

}

$dbc = mysqli_connect(DB_POST,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error('连接失败'));

$sql = "SELECT * FROM person";

$result = mysqli_query($dbc,$sql);

$data = array();

if (mysqli_num_rows($result)){

    while ($row = mysqli_fetch_array($result)){

        $data[] = $row;

    }

}




include 'templates/index.php';
