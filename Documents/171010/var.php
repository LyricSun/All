<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/10
 * Time: 上午9:33
 */

$name = 'tom';

function display(){
    global $name;
    echo "name is $name";
}

display();


function sta(){
    static $x = 0;
    $x++;
    echo $x;
}

sta();
sta();
sta();
sta();
sta();


