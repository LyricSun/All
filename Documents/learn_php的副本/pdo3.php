<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/30
 * Time: 下午7:44
 */





$db = new PDO('mysql:host=localhost;dbname=demo','root','123456');

$res = $db->query('SELECT * FROM student');

foreach ($res->fetchAll() as $value){
    print "{$value['name']}";
}