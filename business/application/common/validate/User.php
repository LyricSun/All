<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/15
 * Time: 下午5:24
 */
namespace app\common\validate;

use think\Validate;

class User extends Validate{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'email' => 'require',
        'confirm' => 'require',
        'verifyCode' => 'require',
    ];
    protected $message = [
        'username.require' => '请输入用户名',
        'password.require' => '请输入密码',
        'email.require' => '邮箱格式不正确',
        'confirm.require' => '请确认密码',
        'verifyCode.require' => '请输入验证码',
    ];
    protected $scene = [
        'login' => ['username','password'],
        'add' => ['username','password','email','confirm','verifyCode']
    ];
}