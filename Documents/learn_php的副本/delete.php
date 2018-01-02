<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/18
 * Time: 下午2:32
 */

include 'db.php';

if (!empty($_GET)){

    $userID = $_GET['userID'];

    $dbc = mysqli_connect(DB_POST,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error('连接失败'));

    $sql = "DELETE FROM person WHERE id = '$userID'";

    $result = mysqli_query($dbc,$sql);

    if ($result){
        jumpTo('index');
    }
    else{
        echo '<script>alert("删除失败")</script>';
    }

}

