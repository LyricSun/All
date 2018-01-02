<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/29
 * Time: 下午4:59
 */
$redis = new Redis();

$redis->connect('127.0.0.1',6379) or die('连接失败');

$redis->set('test','happy new year');

echo $redis->get('test');