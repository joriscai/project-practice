<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
	public function regedit(){
		$this->display('User/regedit');
	}
	
	public function login(){
		$this->show('越杨上传了吗？');
	}
	
	public function regedit_handle(){
		var_dump($_POST);
		die;
	}
}
