<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/26
 * Time: 上午10:49
 */
namespace Admin\Controller;
use Think\Controller;
class ContentController extends Controller{
    public function index(){

        $res = D('Content')->getNews();

        $this->assign('news', $res);


        $this->display();
    }

    public function setStatus(){
        try{
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
        }catch (Exception $e){
            return show(0,$e->getMessage());

        }
    }
}