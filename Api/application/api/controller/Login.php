<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/4
 * Time: 下午2:16
 */
namespace app\api\controller;

use app\common\lib\exception\ApiException;
use app\common\lib\OpenSSLAES;
use think\Cache;
use think\Validate;

class Login extends Common{
    public function save(){
        $data = input('param.');

        $validate = new Validate([
            'phone' => 'require|number|length:11',
            'code' => 'require|number|length:4'
        ]);
        if (!$validate->check($data)){
            throw new ApiException($validate->getError(),400,3003);
        }
        $cacheCode = Cache::get('phonenum');

        if ($data['code'] != $cacheCode){
            throw new ApiException('验证码错误',401,3005);
        }
        $token = $this->getToken($data['phone']);
        $userData = [
            'token' => $token,
            'time_out' => strtotime('+7 days')
        ];
        $user = model('User')->where(['phone' => $data['phone']])->find();
        if (!$user){
            $userData['username'] = 'yw' . rand(100000,999999);
            $userData['phone'] = input('post.phone');
            $userData['status'] = 1;
            $user_id = model('User')->add($userData);
        }
        else{
            $user_id = $user['id'];
            $userData['create_time'] = time();
            $userData['status'] = 1;
            model('User')->save($userData, ['id' => $user_id]);

            $openSSL = new OpenSSLAES(config('app.aes_key'));
            $result = [
                'token' => $openSSL->encrypt($token . '||' . $user_id)
            ];

            return show(0, 'OK', $result);
        }
    }
    public function getToken($phone){
        $str = md5(uniqid(md5(microtime(true)),true));

    }
}