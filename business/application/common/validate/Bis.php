<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/9
 * Time: 下午5:44
 */
namespace app\common\validate;

use think\Validate;

class Bis extends Validate{
    protected $rule = [
        'name' => 'require',
        'email' => 'email',
        'logo' => 'require',
        'licence_logo' => 'require',
        'description' => 'require',
        'city_id' => 'require',
        'bank_info' => 'require',
        'bank_name' => 'require',
        'bank_user' => 'require',
        'faren' => 'require',
        'faren_tel' => 'require'
    ];
    protected $message = [
        'name.require' => '店铺名不能为空',
        'email.require' => '请输入正确邮箱',
        'logo.require' => '请上传缩略图',
        'licence_logo.require' => '请上传营业执照',
        'description.require' => '请填写描述',
        'city_id.require' => '请选择城市信息',
        'bank_info.require' => '请输入银行卡号',
        'bank_name.require' => '请输入开户行名称',
        'bank_user.require' => '请输入开户人姓名',
        'faren.require' => '请输入法人姓名',
        'faren_tel.require' => '请输入法人电话'
    ];
    protected $scene = [
        'add' => ['name','email','logo','licence_logo','description','city_id','bank_info','bank_name','bank_user','faren','faren_tel']
    ];
}