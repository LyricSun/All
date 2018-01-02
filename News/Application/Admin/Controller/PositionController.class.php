<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/26
 * Time: 上午10:50
 */
namespace Admin\Controller;
use Think\Controller;

class PositionController extends Controller{
    public function index(){
//        $res = D('Position')->getPosition();
//        $this->assign('positions',$res);
//分页

        $count = D('Position')->getCount();
        $Page = new \Think\Page($count,3);
        $show = $Page->show();// 分页显示输出
        $res = D('Position')->getPosition($Page);
        $this->assign('positions',$res);
        $this->assign('page',$show);

        $this->display();

    }
//增和改
    public function add(){
        if($_POST) {
            $name= $_POST['name'];
            $description = $_POST['description'];
            $status = $_POST['status'];
            $data = array(
                'name' => $name,
                'description' => $description,
                'status' => $status
            );
            if (!trim($name)) {
                show(0,'请输入姓名');
            }
            if (!trim($description)) {
                show(0,'此处不能为空');
            }

            if ($_POST['id']) {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $description = $_POST['description'];
                $data= array(
                    'name' => $name,
                    'description' => $description
                );
                $res = D('Position')->change($id,$data);
                if (!$res) {
                    return show(0,'修改成功');
                }else {
                    return show(1,'修改成功');
                }
            }


            $res = D('Position')->insert($data);
            if (!$res) {
                show(0,'添加失败');
            }
            return show(1,'添加成功');
        }
        $this->display();
    }
    //删除
    public function  setStatus()
    {
        try {
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
        } //$e就代表那个异常,$e->getMessage()是异常自带的函数,就是获取里面的msg;
        catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
    //修改
    public function edit()
    {
        if ($_GET) {
            $id = $_GET['id'];
            $res = D('Position')->update($id);
            $this->assign('vo', $res);
        }
        $this->display();
    }

}