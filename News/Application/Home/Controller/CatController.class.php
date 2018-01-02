<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/1
 * Time: 下午8:46
 */
namespace Home\Controller;
use Think\Controller;
class CatController extends Controller {
    public function index(){

        $id = $_GET['id'];

        $res1 = D('Content')->getNews($id);

        $res2 = D('Menu')->getMenuName();

        $res3 = D('Content')->getSmallTitle();

        $res4 = D('Positioncontent')->getAdMsg();



//        dump($res1);exit();

        $this->assign('result',$res1);

        $this->assign('navs',$res2);

        $this->assign('sm_title',$res3);

        $this->assign('adv',$res4);


        $this->display();
    }
}