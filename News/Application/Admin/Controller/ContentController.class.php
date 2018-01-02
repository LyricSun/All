<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/26
 * Time: 上午10:53
 */
namespace Admin\Controller;
use Think\Controller;

class ContentController extends Controller{
    public function index(){
//        $res = D('Content')->getContent();
//        $this->assign('news',$res);
//分页,显示内容
        $po_name = D('Position')->getPositionName();


        $count = D('Content')->getCount();
        $page = new \Think\Page($count,3);
        $show = $page->show();
        $res = D('Content')->getContent($page);
        $this->assign('news',$res);
        $this->assign('pageres',$show);

        $this->assign('positions',$po_name);

        $this->display();

    }
    //删除
    public function setStatus()
    {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $res = D('Content')->updateStatusById($id, $status);
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

    public function push(){


    }


}