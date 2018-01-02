<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/13
 * Time: 下午2:19
 */
namespace app\common\validate;

use think\Validate;

class Deal extends Validate{
    protected $rule = [
        'name' => 'require',
        'city_id' => 'require',
        'category_id' => 'require',
        'location_ids' => 'require',
        'image' => 'require',
        'start_time' => 'require',
        'end_time' => 'require',
        'total_count' => 'require|number',
        'origin_price' => 'require|number',
        'current_price' => 'require|number',
        'coupons_begin_time' => 'require',
        'coupons_end_time' => 'require',
        'description' => 'require',
        'notes' => 'require'
    ];
    protected $message = [
        'name.require' => '请填写团购商品名',
        'city_id.require' => '请选择城市',
        'category_id.require' => '请选择分类',
        'location_ids.require' => '请选择支持店铺',
        'image.require' => '请上传图片',
        'start_time.require' => '请选择团购开始时间',
        'end_time.require' => '请选择团购结束时间',
        'total_count.require' => '请填写总数',
        'total_count.number' => '总数必须是数字',
        'origin_price.require' => '请输入原价',
        'origin_price.number' => '原价必须是数字',
        'current_price.require' => '请输入当前价格',
        'current_price.number' => '当前价格必须是数字',
        'coupons_begin_time.require' => '请选择优惠卷生效时间',
        'coupons_end_time.require' => '请选择优惠卷失效时间',
        'description.require' => '请填写描述',
        'notes.require' => '请填写用户须知',
    ];
    protected $scene = [
        'add' => [
            'name',
            'city_id',
            'category_id',
            'location_ids',
            'image',
            'start_time',
            'end_time',
            'total_count',
            'origin_price',
            'current_price',
            'coupons_begin_time',
            'coupons_end_time',
            'description',
            'notes'
        ]
    ];
}