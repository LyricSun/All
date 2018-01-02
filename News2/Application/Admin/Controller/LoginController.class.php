<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/10/20
 * Time: 上午9:25
 */

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller{

    public function index()
    {

        $this->display();

    }

    public function check()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];



        if (!trim($username)) {

            return show(0, '用户名为空');

        } else if (!trim($password)) {

            return show(0, '密码为空');

        }

        $res = D('Admin')->getUserByUsername($username);

        if (!$res || $res['username'] != $username) {

            return show(0,'用户名不存在');

        }
        if ($res['password'] != getMd5password($password)){

            return show(0,'密码错误');

        }

        return show(1,'登录成功');

    }

}