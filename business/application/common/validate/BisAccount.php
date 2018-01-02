<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/7
 * Time: 上午10:36
 */
namespace app\common\validate;

use think\Validate;

class BisAccount extends Validate{
    protected $rule = [
        'username' => 'require',
        'password' => 'require'
    ];
    protected $message = [
        'username.require' => '用户名不能为空',
        'password.require' => '密码不能为空'
    ];
    protected $scene = [
        'login' => ['username','password'],
        'add' => ['username','password']
    ];
}