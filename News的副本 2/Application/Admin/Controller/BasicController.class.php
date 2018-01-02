<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/26
 * Time: 上午10:49
 */
namespace Admin\Controller;
use Think\Controller;
class BasicController extends Controller{
    public function index(){
        $this->display();
    }
}