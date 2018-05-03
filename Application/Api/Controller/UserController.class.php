<?php

namespace Api\Controller;

use Think\Controller;

class UserController extends Controller{
	
	public function info(){
        $field = '*';
        if($_REQUEST['field']) $field = $_REQUEST['field'];
        $find = M('peisong')->field($field)->where('id = '.$_REQUEST['user_id'])->find();
        die(json_encode($find));
	}
	
	public function setPassword(){
        $find = M('peisong')->where('id = '.$_REQUEST['user_id'])->find();
        if($find['password'] != md5($_REQUEST['old_password'])){
            $result = array('status' => 'error','msg' => '原密码不正确！');
        }else{
            $data['password'] = md5($_REQUEST['new_password']);
            M('peisong')->where('id = '.$_REQUEST['user_id'])->save($data);
            $result = array('status' => 'success');
        }
        die(json_encode($result));
	}

    public function getPicker(){
        $peisong = M('peisong')->where('id = '.$_REQUEST['user_id'])->find();
        $list = M('peisong')->field('name as text,id as value')->where('work_status = 0 and school_id = '.$peisong['school_id'])->select();
        die(json_encode($list));
    }
	
}