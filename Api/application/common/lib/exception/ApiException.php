<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/27
 * Time: 下午4:42
 */
//命名空间
namespace app\common\lib\exception;
//使用类
use think\Exception;
use Throwable;
//继承异常类
class ApiException extends Exception{

    //因为下的构造方法要把传来的httpCode参数赋给实例这个类的对象的一个属性,所以要先声明个属性
    public $httpCode = 500;
    public $status = -1;

    //构造方法,接受传来的msg参数和状态码
    public function __construct($message = "",$httpCode = 500,$status = -1, $code = 0, Throwable $previous = null)
    {

//        halt($status);
        //把参数赋给这个对象的属性
        $this->httpCode = $httpCode;
        $this->status = $status;

        parent::__construct($message, $code, $previous);
    }

}