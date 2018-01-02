<?php
/**
 * Created by PhpStorm.
 * User: information
 * Date: 2017/11/21
 * Time: 上午9:36
 */
namespace app\index\controller;

use alipay\Pagepay;
use think\Session;

class Order extends Base{
    public function index(){
        if (!Session::get('user','o2o')){
           $this->redirect('lodin/index');
        }
        $id = input('id',0,'intval');
//        if (!$id){
//            $this->error('ID异常');
//        }
        $deal = model('Deal')->get($id);
        return $this->fetch('',[
            'email' => $this->account->email,
            'deal' => $deal
        ]);
    }
    public function pay(){
        $data = input('post.');
        $deal = model('Deal')->get(intval($data['id']));
        $order_data = [
            'trade_id' => time() . $this->account->id . mt_rand(1000,9999),
            'user_id' => $this->account->id,
            'deal_id' => $data['id'],
            'description' => $deal->description,
            'last_ip' => get_client_ip(),
            'bis_id' => $deal->bis_id,
            'status' => 0,
            'buy_count' => $data['buy_count'],
            'total_price' => $data['total_price'],

        ];
        $res = model('Order')->save($order_data);
        if (!$res){
            $this->error('订单生成失败');
        }
        else{
            $pay_data = [
                'subject' => $deal->name,
                'out_trade_no' => $order_data['trade_id'],
                'total_amount' => $order_data['total_price']
            ];
            Pagepay::pay($pay_data);
        }
    }
    public function finish_front(){
        $data = input('get.');
        if (!empty($data['out_trade_no'])){
            $order_info = model('Order')->get(['trade_id'=>$data['out_trade_no']]);
            if ($order_info->status != 1){
                $res = model('Order')->save(['status'=>1],['trade_id'=>$data['out_trade_no']]);
                if (!$res){
                    $this->error('订单更新失败');
                }
                else{
                    $this->success('订单更新成功',url('index/index'));
                }
            }
        }
    }
    public function finish_server(){
        $data = input('post.');
        if (!empty($data['out_trade_no'])){
            $order_info = model('Order')->get(['trade_id'=>$data['out_trade_no']]);
            if ($order_info->status != 1){
                $res = model('Order')->save(['status'=>1],['trade_id'=>$data['out_trade_no']]);
                if (!$res){
                    echo 'fail';
                }
                else{
                    echo 'success';
                }
            }
        }
    }
}