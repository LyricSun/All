<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/23
 * Time: 上午11:46
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class MenuController extends Controller{


    public function index(){
        $res = D('Menu')->getMenus();
        $this->assign('menus', $res);

        $User = M('Menu');
        $count = $User->where('status=1')->count();
        $Page = new \Think\Page($count,3);
        $show = $Page->show();

        $list = $User->where('status=1')->order('menu_id')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('menus',$list);
        $this->assign('pageRes',$show);

        $this->display();
    }

    public function add(){

        if ($_POST){
            if(!isset($_POST['name']) || !$_POST['name']) {
                return show(0,'菜单名不能为空');
            }
            if(!isset($_POST['m']) || !$_POST['m']) {
                return show(0,'模块名不能为空');
            }
            if(!isset($_POST['c']) || !$_POST['c']) {
                return show(0,'控制器不能为空');
            }
            if(!isset($_POST['f']) || !$_POST['f']) {
                return show(0,'方法名不能为空');
            }
            $res = D('Menu')->insert($_POST);
            if (!$res){
                return show(0,'插入失败');
            }
            return show(1,'插入成功');

        }

        $this->display();
    }

    public function setStatus(){
        try{
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $res = D('Menu')->updateStatusById($id, $status);

                if (!$res) {
                    return show(0, '操作失败');
                } else {
                    return show(1, '操作成功');
                }
            }
        }catch (Exception $e){
                return show(0,$e->getMessage());

        }
    }


    public function edit(){
        if ($_GET['id']){
            $id = $_GET['id'];

            $res = D('Menu')->getMsgById($id);


            $this->assign('edit', $res[0]);


        }

        $this->display();
    }
    public function update(){



            if ($_POST) {
                if (!isset($_POST['name']) || !$_POST['name']) {
                    return show(0, '菜单名不能为空');
                }
                if (!isset($_POST['m']) || !$_POST['m']) {
                    return show(0, '模块名不能为空');
                }
                if (!isset($_POST['c']) || !$_POST['c']) {
                    return show(0, '控制器不能为空');
                }
                if (!isset($_POST['f']) || !$_POST['f']) {
                    return show(0, '方法名不能为空');
                }
                $res = D('Menu')->updateMsg($_POST);
                if (!$res) {
                    return show(0, '更新失败');
                }
                return show(1, '更新成功');
            }


        $this->display();
    }

}
