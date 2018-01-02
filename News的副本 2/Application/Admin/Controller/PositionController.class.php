<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/26
 * Time: 上午10:51
 */
namespace Admin\Controller;
use Think\Controller;
class PositionController extends Controller{
    public function index(){

        $res = D('Position')->getPositions();

        $this->assign('positions', $res);

        $this->display();
    }
    public function add(){

        if ($_POST){
            if(!isset($_POST['name']) || !$_POST['name']) {
                return show(0,'职位名不能为空');
            }
            if(!isset($_POST['description']) || !$_POST['description']){
                return show(0,'职位描述不能为空');
            }
            if($_POST['id']) {

                return $this->save($_POST);

            }

            $res = D('Position')->insert($_POST);

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

                $res = D('Position')->updateStatusById($id, $status);

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

            $res = D('Position')->getMsgById($id);


            $this->assign('vo', $res);


        }

        $this->display();
    }
    public function save($data) {
        $id = $data['id'];
        unset($data['id']);

        try {
            $id = D("Position")->updatePositionById($id, $data);
            if($id === false) {
                return show(0,'更新失败');
            }
            return show(1,'更新成功');
        }catch(Exception $e) {
            return show(0,$e->getMessage());
        }
    }
}