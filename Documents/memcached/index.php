<?php


$memcache = new Memcache();

$memcache->connect('192.168.1.13','8888') or die('连接失败');

//$memcache->set('haodonglai','shenyang');

$num = $memcache->get('haodonglai');

echo $num;