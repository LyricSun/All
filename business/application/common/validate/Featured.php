<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/7
 * Time: 上午10:36
 */
namespace app\common\validate;

use think\Validate;

class Featured extends Validate{
    protected $rule = [
        'type' => 'require',
        'title' => 'require',
        'url' => 'require',
        'description' => 'require'
    ];
    protected $message = [
        'type.require' => '请选择推荐类型',
        'title.require' => '请填写标题',
        'url.require' => '请填写url',
        'description.require' => '请填写描述',
    ];
    protected $scene = [
        'add' => ['type','title','url','description']
    ];
}