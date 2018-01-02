<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/23
 * Time: 下午2:54
 */

namespace Common\Model;

use function PHPSTORM_META\type;
use Think\Model;

class MenuModel extends Model
{

    //操作数据库固定写法
    private $_db = '';

    function __construct()
    {
        $this->_db = M('menu');
    }

    //此时开始写获取数据库数据的函数

    public function getMenus($type, $Page)
    {
        //意思是status值不=-1;
        $data['status'] = array('neq', -1);
        $data['type'] = $type;
        //选择出status!=-1的所有数据
        $res = $this->_db->where($data)->limit($Page->firstRow . ',' . $Page->listRows)->order('listorder DESC')->select();
        return $res;

    }

    //分页需求
    public function getCount($type)
    {
        $data['status'] = array('neq', -1);
        $data['type'] = $type;
        return $this->_db->where($data)->count();
    }

    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }

    //24日下午
    public function updateStatusById($id, $status)
    {
        if (!is_numeric($id) || !$id) {
            //异常机制跟try....catch配合使用,人为制造一个警报
            throw_exception('ID不合法');

        }
        if (!is_numeric($status) || !$status) {
            throw_exception('状态不合法');

        }
        $data['status'] = $status;
        return $this->_db->where('menu_id=' . $id)->save($data);
    }

    //作业10月24日自己写可能有错误
    public function update($id)
    {
        return $this->_db->where('menu_id=' . $id)->find();

    }

    public function change($id, $data)
    {
        return $this->_db->where('menu_id=' . $id)->save($data);
    }


    //排序
    public function order($menu_id, $data)
    {
        if (!is_numeric($menu_id) || !$menu_id) {
            //异常机制跟try....catch配合使用,人为制造一个警报
            throw_exception('ID不合法');
        }
//        $datas = intval($data);
//        if (!is_numeric($datas) || !$datas) {
//            //异常机制跟try....catch配合使用,人为制造一个警报
//            throw_exception('数字不合法');
//        }

        $listoder_num = array(
            'listorder' => intval($data)
        );

        if (!is_array($listoder_num) || !$listoder_num) {
            //异常机制跟try....catch配合使用,人为制造一个警报
            throw_exception('排序不合法');
        }
        $res = $this->_db->where('menu_id=' . $menu_id)->save($listoder_num);
        return $res;
    }


    //26日课堂训练
    public function getAdminMenus()
    {
        $data['status'] = array('neq', -1);
        $data['type'] = 1;

        $res = $this->_db->where($data)->order('listorder desc')->select();
        return $res;
    }

    public function getName($catid)
    {
        $data['type'] = 0;
        $data['menu_id'] = $catid;
        $res = $this->_db->where($data)->getField('name');
        return $res;

    }
    public function getMenuName(){
        $data['status'] = 1;
        $data['type'] =0;
        return $this->_db->where($data)->select();

    }

//    public function getMenuNameByType(){
//
//        $data['type'] = array('eq',0);
//        $res = $this->_db-
//    }


}
