<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/12/1
 * Time: 下午4:25
 */
namespace app\api\controller;
use aliyun\api_demo\SmsDemo;
use jpush\src\JPush\Client;
use think\Controller;

class Test extends Controller{
    public function push(){
        $app_key = 'c4e91430e558f24991ea11e1';
        $master_ser = '656cf2171e93ca40550a5c63';
        $client = new Client($app_key,$master_ser);
        $client->push()
            ->setPlatform('all')
            ->addAllAudience()
            ->setNotificationAlert('hello,JPush')
            ->iosNotification('hello',[
                'sound' => 'sound',
                'badge' => '+1',
                'extras' => [
                    'news_id' => 2
                ]
            ])
            ->androidNotification('hello',[
                'extras' => [
                    'news_id' => 2
                ]
            ])
            ->send();
    }
    public function yzm(){
        header('Content-Type: text/plain; charset=utf-8');

        $response = SmsDemo::sendSms(
            "源文科技", // 短信签名
            "SMS_109405011", // 短信模板编号
            "18640515521", // 短信接收者
            Array(  // 短信模板中字段的值
                "code"=>"12345",
                "product"=>"dsd"
            ),
            "123"   // 流水号,选填
        );

        return show(0,'OK',$response);
    }
}