<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/7
 * Time: 下午3:40
 */
namespace app\bis\controller;

use think\Session;

class Index extends Base {

    public function index(){

        return $this->fetch();
    }
    public function welcome(){
//        $res = \Map::getLngLat('大连市沙河口区软件园路3号');
//        $src = \Map::getStaticImage();

        return $this->fetch();
    }
}