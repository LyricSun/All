<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/9/29
 * Time: 上午11:00
 */


include 'db.php';

session_start();

if ($_SESSION['user']){

    jumpTo('index');

}


if ($_POST){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty(trim($username)) && !empty(trim($password))){

        $dbc = mysqli_connect(DB_POST,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error('链接失败'));

        $pass_md5 = md5($password);

        $sql = "SELECT username FROM user WHERE username = '$username' AND password = '$pass_md5'";

        $result = mysqli_query($dbc,$sql);

        if (mysqli_num_rows($result)){

            session_start();
            $_SESSION['user'] = $username;

            jumpTo('index');

        }
        else{

            echo '<script>alert("账户名或密码错误")</script>';

        }
    }
    else{

        echo '<script>alert("账户名或密码为空")</script>';

    }

}

include 'templates/login.php';

