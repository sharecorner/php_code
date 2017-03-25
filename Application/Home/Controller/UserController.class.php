<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
	//login
	public function login(){
		$this->display('User/login');
	}

	//register
	public function register(){
		
		$this->display('User/register');
	}
	
	 //空方法操作
    public function _empty($method,$args){
    	echo "没有此方法";
    }
}