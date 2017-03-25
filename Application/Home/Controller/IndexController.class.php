<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    //空方法操作
    public function _empty($method,$args){
    	echo "没有此方法";
    }
}