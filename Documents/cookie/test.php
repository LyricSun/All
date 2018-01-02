<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/22
 * Time: 下午3:58
 */

$id_num = '12348765643456676';

echo substr_replace($id_num,'****',-4,4);

$var = 'ABCDEFGH:/MNRPQR/';
echo "Original: $var<hr />\n";

/* 这两个例子使用 “bob” 替换整个 $var。*/
echo substr_replace($var, 'bob', 0) . "<br />\n";
echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n";

/* 将 “bob” 插入到 $var 的开头处。*/
echo substr_replace($var, 'bob', 0, 0) . "<br />\n";

/* 下面两个例子使用 “bob” 替换 $var 中的 “MNRPQR”。*/
echo substr_replace($var, 'bob', 10, -1) . "<br />\n";
echo substr_replace($var, 'bob', -7, -1) . "<br />\n";

/* 从 $var 中删除 “MNRPQR”。*/
echo substr_replace($var, '', 10, -1) . "<br />\n";

echo substr_replace('eggs','x',-1,-1). "<br />\n"; //eggxs
echo substr_replace('eggs','x',-1,-2). "<br />\n"; //eggxs

$input = array('A: XXX', 'B: XXX', 'C: XXX');

// A simple case: replace XXX in each string with YYY.
echo implode('; ', substr_replace($input, 'YYY', 3, 3))."<br>";

// A more complicated case where each replacement is different.
$replace = array('AAA', 'BBB', 'CCC');
echo implode('; ', substr_replace($input, $replace, 3, 3))."<br>";

// Replace a different number of characters each time.
$length = array(1, 2, 3);
echo implode('; ', substr_replace($input, $replace, 3, $length))."<br>";

$arr_num = range(1, 10);
var_dump($arr_num);

$animals = array('ant', 'bee', 'cat', 'dog', 'elk', 'fox');
print $animals[1];
print $animals[2];
print count($animals);

// unset
unset($animals[1]);
print $animals[1];
print $animals[2];
print count($animals);


// 增加新元素
$animals[] = 'gun';
print $animals[1];
print $animals[6];
print count($animals);

$array = ['apple', 'banana', 'coconut'];

$array = array_pad($array, 5, '1');

var_dump($array);

$arr2 = array_splice($array, 3);
var_dump($array);
var_dump($arr2);
