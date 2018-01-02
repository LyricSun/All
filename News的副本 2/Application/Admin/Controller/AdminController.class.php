<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/26
 * Time: 上午10:56
 */
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller{
    public function index(){

        $res = D('Admin')->getAdmin();
        $this->assign('admins',$res);

        $this->display();
    }

    public function add(){

        if ($_POST){
            if(!isset($_POST['username']) || !$_POST['username']) {
                return show(0,'用户名不能为空');
            }
            if(!isset($_POST['password']) || !$_POST['password']) {
                return show(0,'密码不能为空');
            }
            if(!isset($_POST['realname']) || !$_POST['realname']) {
                return show(0,'真实名不能为空');
            }

            $res = D('Admin')->insert($_POST);

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

                $res = D('Admin')->updateStatusById($id, $status);

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
}