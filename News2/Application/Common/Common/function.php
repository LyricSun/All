<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/20
 * Time: 下午2:38
 */

function show($status,$message,$data = array()){

    $result = array(

        'status' => $status,
        'message' => $message,
        'data' => $data

    );

    exit(json_encode($result));

}

function getMd5password($password){

    return md5($password . C('MD5_PRE'));

}