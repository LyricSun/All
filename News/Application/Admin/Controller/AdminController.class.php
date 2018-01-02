<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/26
 * Time: 上午10:54
 */
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{
    public function index(){
//        $res = D('Admin')->getAdmin();
//        $this->assign('admins', $res);

//分页
        $count = D('Admin')->getCount();// 查询满足要求的总记录数
        $page = new \Think\Page($count,3);//实例化分页类 传入总记录数和每页显示的记录数(3)
        $show = $page->show();// 分页显示输出
        $res = D('Admin')->getAdmin($page);
        //将内容传到前端,前端通过name值获取到数据
        $this->assign('admins', $res);
        $this->assign('page',$show);
        $this->display();

    }
  //增

    public function add(){
        //添加新admin,通过点击提交触发Ajax,在后台获取到传入的值.初步判断是否为空,返回前端结果,均不空时,调用Model里的添加方法,判断.返回结果
        if ($_POST) {

            $username = $_POST['username'];
            $password = $_POST['password'];
            $realname = $_POST['realname'];
            $data = array(
                'username' => $username,
                'password' => getMd5Password($password),
                'realname' => $realname

            );
            if (!trim($username)) {
                show(0,'请输入姓名');
            }
            if (!trim($password)) {
                show(0,'请输入密码');
            }
            if (!trim($realname)) {
                show(0,'请输入真实姓名');
            }
            $res = D('Admin')->insert($data);
            if (!$res) {
                show(0,'添加失败');
            }
            return show(1,'添加成功');
        }
        $this->display();
    }

    //删
    public function  setStatus()
    {
        //try...catch结合着throw_exception用,主动加一个异常提示
        try {
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
        } //$e就代表那个异常,$e->getMessage()是异常自带的函数,就是获取里面的msg;
        catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }
}