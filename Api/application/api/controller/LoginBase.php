<?php


namespace app\api\controller;

use app\common\lib\exception\ApiException;
use app\common\lib\OpenSSLAES;

class LoginBase extends Common {

    public function _initialize()
    {

        $this->isLogin();
        parent::_initialize();
    }


    public function isLogin() {

        // 获取token值
        $access_token = request()->header('access_token');

        // 验证token是否存在
        if (!$access_token) {
            throw new ApiException('没有token值', 400, 3008);
        }

        // 解密token值
        $openSSl = new OpenSSLAES(config('app.aes_key'));

        $access_token = $openSSl->decrypt($access_token);


        list($token, $id) = explode('||', $access_token);

        // 根据id值获取用户数据
        $user = model('User')->where(['id' => $id])->find();

        if ($token != $user['token']) {
            throw new ApiException('token错误', '401', 3009);
        }

        if (time() > $user['time_out']) {
            throw new ApiException('token过期, 请重新登录', 401, 3010);
        }
    }

}