<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/27
 * Time: 下午4:03
 */
namespace app\common\lib\exception;

use Exception;
use think\exception\Handle;

class ApiHandleException extends Handle{
    public function render(Exception $e)
    {
        if (config('app_debug')){
            return parent::render($e);
        }
        $httpCode = 500;
        if ($e instanceof ApiException){
            $httpCode = $e->httpCode;
        }
        return data_return(-1,$e->getMessage(),[],$httpCode);
    }
}