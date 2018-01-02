<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/15
 * Time: 下午5:37
 */
namespace app\index\controller;
use think\Controller;
use think\Session;

class Login extends Controller{
    public function index(){
        if (session('user','','o2o')){
            $this->redirect('index/index');
        }
        return $this->fetch();
    }
    public function check(){
        $data = input('post.');
        $validate = validate('BisAccount');
        $res = $validate->scene('login')->check($data);
        if (!$res){
            $this->error($validate->getError());
        }
        $user = model('User')->get(['username' => $data['username']]);
        if (!$user){
            $this->error('用户名不存在');
        }
        if ($user->password != md5($data['password'] . $user->code)){
            $this->error('密码错误');
        }
        session('user',$user,'o2o');
        $this->redirect('index/index');
    }
    public function logout(){
        Session::delete('user','o2o');
        $this->redirect('login/index');
    }
}