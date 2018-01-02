<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/30
 * Time: 下午7:36
 */

$dbms = 'mysql';
$host = 'localhost';
$dbname = 'demo';
$user = 'root';
$pass = '123456';
$dsn = "$dbms:host=$host;dbname=$dbname";

$db = new PDO($dsn,$user,$pass);



$res = $db->query('SELECT * FROM student');
foreach ($res->fetchAll() as $value){
    print "{$value['name']}<br>";
}