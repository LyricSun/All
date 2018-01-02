<?php
/**
 * Created by PhpStorm.
 * User: inner
 * Date: 2017/10/21
 * Time: 下午5:09
 */

 namespace Common\Model;
 use Think\Model;
 class AdminModel extends Model{
     private $_db='';
     function __construct()
     {
         $this->_db = M('admin');
     }
     public function GetUserByUsername($username){
         $res = $this->_db->where("username='".$username."'")->find();
         return $res;
     }

     public function getAdmin(){
         $res = $this->_db->select();
         return $res;

     }
     public function insert($data){

         if (!$data || !is_array($data)){
             return 0;
         }

         return $this->_db->add($data);
     }
     public function updateStatusById($id,$status){
         if (!is_numeric($id) || !$id){
             throw_exception('ID不合法');
         }

         if (!is_numeric($status) || !$status){
             throw_exception('状态不合法');
         }
         $data['status'] = $status;

         return $this->_db->where('admin_id='.$id)->save($data);

     }
 }
