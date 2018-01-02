<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/15
 * Time: 下午4:18
 */
namespace app\index\controller;

use think\Controller;

class Register extends Controller{
    public function index(){
        return $this->fetch();
    }
    public function add(){
        if (request()->isPost()) {
            $data = input('post.');
            $validate = validate('User');
            $res = $validate->scene('add')->check($data);
            if (!$res) {
                $this->error($validate->getError());
            }
            if (!captcha_check($data['verifyCode'])) {
                $this->error('验证码输入有误');
            }
            $code = mt_rand(1000, 9999);
            $userData = [
                'username' => $data['username'],
                'password' => md5($data['password'] . $code),
                'code' => $code,
                'email' => $data['email']
            ];

            $res = model('User')->save($userData);
            if (!$res) {
                $this->error('注册失败');
            }
            $this->success('注册成功', url('login/index'));
        }
    }
}