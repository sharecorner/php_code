<?php
namespace Home\Controller;
use Think\Controller;

class EmptyController extends Controller{
	public function _empty($m, $args){
		echo "控制器错误";
	}
}