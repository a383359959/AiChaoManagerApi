<?php

function getCount($user_id){
	$peisong = M('peisong')->field('school_id')->where('id = '.$user_id)->find();
	$arr[] = M('order')->where('`status` = 1 and pay_status = 1')->count();
	$arr[] = M('order')->where('school_id = '.$peisong['school_id'].' and `status` = 6')->count();
	return $arr;
}

function setOrderStatus($order_id,$msg){
	$data['order_id'] = $order_id;
	$data['msg'] = $msg;
	$data['time'] = time();
	return M('order_msg')->add($data);
}