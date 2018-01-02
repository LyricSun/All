<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/27
 * Time: 下午4:42
 */
namespace app\common\lib\exception;

use think\Exception;
use Throwable;

class ApiException extends Exception{
    public $httpCode = 500;
    public function __construct($message = "",$httpCode = 500, $code = 0, Throwable $previous = null)
    {
        $this->httpCode = $httpCode;
        parent::__construct($message, $code, $previous);
    }

}