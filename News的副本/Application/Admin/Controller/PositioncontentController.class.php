<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/26
 * Time: 上午10:52
 */
namespace Admin\Controller;
use Think\Controller;
class PositioncontentController extends Controller{
    public function index(){

        $res = D('Positioncontent')->getPositioncontent();

        $this->assign('contents', $res);

        $this->display();
    }
    public function setStatus(){
        try{
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
        }catch (Exception $e){
            return show(0,$e->getMessage());

        }
    }
}