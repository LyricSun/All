<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/20
 * Time: 上午9:09
 */
//定义命名空间为admin下的controller
namespace Admin\Controller;

//对应使用think里的controller
use Think\Controller;

//logicontroller这个类文件继承controller里的可被继承性质
class LoginController extends Controller
{
    //定义公开的方法index
    public function index()
    {
        //执行此方法时,让在login文件夹下的与index同名的文件显示,此文件为后台登陆页面,admin通过url如http://news.local/index.php?m=admin&c=Login&a=index,访问到模块为admin,控制器名为login的文件中执行index方法,即让登陆页面显示,此时admin就能看见登陆页面的输入和登陆框,admin输入用户名和密码,此时代码执行到login/index.html文件
        if (session('adminUser')) {
            redirect('/admin.php?c=index');
        }
        $this->display();
    }

    //前端通过Ajax传输数据时url访问了check方法
    public function check()
    {
        //因为是通过post方法传输的数据,先接受下传输的过来的数据
        $username = $_POST['username'];
        $password = $_POST['password'];

        //永远不要相信展示给你的内容,所以在接收数据后需要在判断下是不是空的
        if (!trim($username)) {


            //因为此处需要很多判断,然后把判断结果传输给前端,都是重复的语句,所以在公用文件夹内封装个show方法.调用后会把参数以对象的形式传回前端,前端通过status进行判断,输出message结果
            return show(0, '用户名为空');
            //同上
        } else if (!trim($password)) {
            return show(0, '密码为空');
        }


        //进行到此,后台已经进行初步的判断了,即用户名密码都有值
        //D是实例化Model里AdminModel这张表
        //意思就是在这张表中调用这个方法,将结果赋值给$res
        $res = D('Admin')->getUserByUsername($username);


        //判断上面的结果是否存在,即username为$username的人在数据库中有没有,$res['username'] != $username可以理解为返回的数据库中数据与输入的用户名不一致,此种情况可能被人在恶意更改传给数据库的值
        if (!$res || $res['username'] != $username) {
            return show(0, '用户不存在');
        }


        //判断密码是否和初始输入的一样
        if ($res['password'] != getMd5Password($password)) {
            return show(0, '密码错误');
        }


        //如果上面两种情况都不存在的话,就证明用户名和密码都验证成功了
        session('adminUser', $res);
        return show(1, '登陆成功');
    }

    public function logout()
    {
        session('adminUser', null);
        redirect('/admin.php?c=login');
    }
};
