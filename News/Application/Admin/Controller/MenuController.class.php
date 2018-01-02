<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/23
 * Time: 下午2:36
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class MenuController extends Controller
{
    //点击菜单管理后跳转至index方法.要把数据库里的menu的一部分信息显示出来,因为要做些数据库相关操作,所以要在common里建立model类


    /*$User = M('User'); // 实例化User对象
$count      = $User->where('status=1')->count();// 查询满足要求的总记录数
$Page       = new \Think\Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数(25)
$show       = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
$list = $User->where('status=1')->order('create_time')->limit($Page->firstRow.','.$Page->listRows)->select();
$this->assign('list',$list);// 赋值数据集
$this->assign('page',$show);// 赋值分页输出
$this->display(); // 输出模板*/

    public function index()
    {
        //10月25日作业,写下拉逻辑
        $type = intval($_REQUEST['type']);
        //获取到数据
//        $res = D('Menu')->GetMenus($type);
        //把获取的数据放在name为menus里返回给前端
//        $this->assign('menus', $res);
//分页

        $count = D('Menu')->getCount($type);
        $Page = new \Think\Page($count, 3);
        $show = $Page->show();
        $res = D('Menu')->GetMenus($type,$Page);
        $this->assign('menus', $res);
        $this->assign('pageRes', $show);
        $this->display();
    }

//增,和改
    public function add()
    {
        if ($_POST) {
            if (!isset($_POST['name']) || !$_POST['name']) {
                return show(0, '菜单名不能为空');
            }
            if (!isset($_POST['m']) || !$_POST['m']) {
                return show(0, '模块名不为空');

            }
            if (!isset($_POST['c']) || !$_POST['c']) {
                return show(0, '控制器不能为空');

            }
            if (!isset($_POST['f']) || !$_POST['f']) {
                return show(0, '方法不能为空');

            }
            //增和改都进add方法,区别时改的时候会传id,增不会
            if ($_POST['menu_id']) {
                $id = $_POST['menu_id'];

                $res = D('Menu')->change($id, $_POST);
                if (!$res) {
                    return show(0, '操作失败');

                } else {
                    return show(1, '操作成功');
                }
            }



            $res = D('Menu')->insert($_POST);
            if (!$res) {
                show(0, '插入失败');
            }
            return show(1, '插入成功');

        }
        $this->display();
    }
//删除

    public function setStatus()
    {
        try {
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
        } //$e就代表那个异常,$e->getMessage()是异常自带的函数,就是获取里面的msg;
        catch (Exception $e) {
            return show(0, $e->getMessage());
        }
    }

//作业10月24日可能有错误
//改
    public function edit()
    {
        if ($_GET) {
            $id = $_GET['id'];
            $res = D('Menu')->update($id);
            $this->assign('menu', $res);
        }
        $this->display();
    }

    //作业结束
    //排序
    public function listorder()
    {
        try {
            $value = $_POST['listorder'];
            //注意$value as $key => $v用法
            foreach ($value as $key => $v) {

                D('Menu')->order($key, $v);

            }

            return show(1, '排序成功');
        } catch (Exception $e) {
            return show(0, $e->getMessage());
        }


    }


}