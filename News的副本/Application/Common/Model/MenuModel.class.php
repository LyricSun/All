<?php
/**
 * Created by PhpStorm.
 * User: Wudi
 * Date: 2017/10/23
 * Time: 下午2:54
 */

namespace Common\Model;


use Think\Model;

class MenuModel extends Model{

    private $_db = '';

    function __construct()
    {
        $this->_db = M('menu');
    }

    public function getMenus(){
        $data['status'] = array('neq', -1);
        $res = $this->_db->where($data)->select();
        return $res;
    }

    public function insert($data){

        if (!$data || !is_array($data)){
            return 0;
        }

        return $this->_db->add($data);
    }
    public function updateMsg($arr4){
        $id = $arr4['menu_id'];
        $data['name'] = $arr4['name'];
        $data['f'] = $arr4['f'];
        $data['m'] = $arr4['m'];
        $data['c'] = $arr4['c'];

        return $this->_db->where('menu_id='.$id)->save($data);

    }


    public function updateStatusById($id,$status){
        if (!is_numeric($id) || !$id){
            throw_exception('ID不合法');
        }

        if (!is_numeric($status) || !$status){
            throw_exception('状态不合法');
        }
        $data['status'] = $status;

        return $this->_db->where('menu_id='.$id)->save($data);

    }
    public function getMsgById($id){
        return $this->_db->where('menu_id='.$id)->field('menu_id,name,m,c,f')->select();
    }
    public function getAdminMenus() {
        $data['status'] = array('neq', -1);
        $data['type'] = 1;

        return $this->_db->where($data)->select();

    }
    public function getIdAndName(){
        $res = $this->_db->field('menu_id,name')->select();
        return $res;
    }

}