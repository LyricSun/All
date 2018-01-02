<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/27
 * Time: 下午4:03
 */
//命名空间
namespace app\common\lib\exception;
//使用类
use Exception;
use think\exception\Handle;
//继承handle类
class ApiHandleException extends Handle{

    //抛出异常,当使用throw关键字的时候会调用此方法,要把new实例的对象作为参数传进来
    public function render(Exception $e)
    {
        //判断是否开启的调试模式,如果开启了,使用父类的异常处理方法
        if (config('app_debug')){
            return parent::render($e);
        }

        //因为调用show方法,如果不给httpCode参数赋值,默认为200,200代表成功,这里要抛出异常,所以默认值设为500
        $httpCode = 500;
        $status = -1;

        //如果ApiException类实例化的对象,则把该对象的httpCode参数赋给httpCode属性,如果不是,默认值为500
        if ($e instanceof ApiException){

            $httpCode = $e->httpCode;
            $status = $e->status;
        }
        //调用show,返回给前端异常信息
        return show($status,$e->getMessage(),[],$httpCode);
    }
}