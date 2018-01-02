<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/7
 * Time: 下午3:46
 */

namespace app\bis\controller;

use think\Controller;
use think\Session;

class Login extends Controller{

    public function index(){
        if (Session::get('bis_user','o2o')){
            $this->redirect('index/index');
        }
        return $this->fetch();
    }
    public function check(){
        if (request()->isPost()){
            $data = input('post.');
            $validate = validate('BisAccount');
            $res = $validate->scene('login')->check($data);
            if(!$res){
                $this->error($validate->getError());
            }
            $user = model('BisAccount')->get(['username' => $data['username']]);
            if (!$user){
                $this->error('用户名不存在');
            }
            if ($user->password != md5($data['password'] . $user->code)){
                $this->error('密码错误');
            }
            session('bis_user',$user,'o2o');
            $this->redirect('index/index');
        }
    }
    public function logout(){
        session('bis_user',null,'o2o');
        $this->redirect('login/index');
    }
}