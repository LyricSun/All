<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/18
 * Time: 下午3:41
 */

include 'db.php';

if ($_POST){

    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    if (!empty(trim($username)) && !empty(trim($gender)) && !empty(trim($phone))){

        $dbc = mysqli_connect(DB_POST,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_error('链接失败'));

        $sql = "INSERT INTO if_php.person (per_name, per_gender, per_tel) VALUES('$username','$gender','$phone')";

        $result = mysqli_query($dbc,$sql);

        if ($result){

            jumpTo('index');
            echo '<script>alert("添加成功")</script>';

        }
        else{

            echo '<script>alert("添加失败")</script>';

        }

    }
    else{

        echo '<script>alert("每项信息都不能为空")</script>';

    }

}
