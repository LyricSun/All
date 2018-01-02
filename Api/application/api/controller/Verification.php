<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/4
 * Time: 下午12:12
 */

namespace app\api\controller;

use think\Cache;
use think\Controller;
use aliyun\api_demo\SmsDemo;
use think\Log;

class Verification extends Controller{
    public function save(){
        $phonenum = input('param.phonenum');
        $verification = rand(1000,9999);
//        header('Content-Type: text/plain; charset=utf-8');

//        $response = SmsDemo::sendSms(
//            "源文科技",
//            "SMS_109405011",
//            $phonenum,
//            Array(
//                "code"=>$verification,
//                "product"=>"dsd"
//            ),
//            "123"
//        );
//        if ($response->Code != 'OK'){
//            Log::write('aliyun.' . json_encode($response));
//            return false;
//        }
        Cache::set('phonenum',$phonenum,12000);
        Cache::set('verification',$verification,12000);
        return show(0,'OK',$response);
    }

}