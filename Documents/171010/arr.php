<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/10
 * Time: 上午10:17
 */

$arr = array('zhangsan','lisi','wangerma');

for ($i = 0;$i < count($arr);$i++){

    echo $arr[$i] . '<br>';

}

$arr2 = array(

    'name' => 'zhangsan',
    'age' => 20,
    'sex' => 'male'

);

foreach ($arr2 as $k => $value){

    echo $k . ':' . $value . '<br>';

}
