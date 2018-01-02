<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/14
 * Time: 上午9:49
 */
namespace app\admin\controller;

use think\Controller;
use think\Session;

class Login extends Controller{
    public function index(){
        if (session('admin_user','','o2o')){
            $this->redirect('index/index');
        }
        return $this->fetch();
    }
    public function check(){
        if (request()->isPost()){
            $data = input('post.');
            $validate = validate('BisAccount');
            $res = $validate->scene('login')->check($data);
            if (!$res){
                $this->error($validate->getError());
            }
            $user = model('Admin')->get(['username' => $data['username']]);
            if (!$user){
                $this->error('管理员不存在');
            }
            if ($user->password != md5($data['password'])){
                $this->error('密码错误');
            }
            session('admin_user',$user,'o2o');
            $this->redirect('index/index');
        }
    }
    public function logout(){
        Session::delete('admin_user','o2o');
        $this->redirect('login/index');
    }
}