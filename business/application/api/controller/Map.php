<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/8
 * Time: 下午2:42
 */
namespace app\api\controller;

use think\Controller;

class Map extends Controller{
    public function get_image(){
        $res = \Map::getStaticImage('辽宁省大连市');
        return $res;
    }
}