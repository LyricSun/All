<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/28
 * Time: 下午2:01
 */
namespace app\api\controller;

use think\Controller;

class Time extends Controller{
    public function index(){
        return data_return(0,'OK',['server_time' => time()]);
    }
}