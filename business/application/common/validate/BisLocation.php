<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/10
 * Time: 上午10:57
 */
namespace app\common\validate;

use think\Validate;

class BisLocation extends Validate{
    protected $rule = [
        'name' => 'require',
        'logo' => 'require',
        'address' => 'require',
        'tel' => 'require',
        'contact' => 'require',
        'open_time' => 'require',
        'content' => 'require',
        'city_id' => 'require',
        'category_id' => 'require'
    ];
    protected $message = [
        'name.require' => '店铺名不能为空',
        'logo.require' => '缩略图不能为空',
        'address.require' => '地址不能为空',
        'tel.require' => '电话不能为空',
        'contact.require' => '联系人不能为空',
        'open_time.require' => '营业时间不能为空',
        'content.require' => '简介不能为空',
        'city_id.require' => '请选择城市信息',
        'category_id.require' => '请选择分类'
    ];
    protected $scene = [
        'add' => ['name','logo','address','tel','contact','open_time','content','city_id','category_id','bank_info']
    ];
}