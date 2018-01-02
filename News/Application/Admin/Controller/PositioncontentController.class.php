<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/26
 * Time: 上午10:51
 */

namespace Admin\Controller;

use Think\Controller;

class PositioncontentController extends Controller
{
    public function index()
    {

//        $res = D('Positioncontent')->getContents();
//        $this->assign('contents',$res);
//分页
        $count = D('Positioncontent')->getCount();
        $page = new \Think\Page($count, 5);
        $show = $page->show();
        $res = D('Positioncontent')->getContents($page);
        $this->assign('contents', $res);
        $this->assign('page', $show);
        $this->display();
    }

    //删除
    public function setStatus()
    {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $res = D('Positioncontent')->updateStatusById($id, $status);
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

}
