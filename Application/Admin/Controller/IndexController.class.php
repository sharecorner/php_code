<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	//首页
    public function index(){
        $this->display();
        //get_define_constants();所以的常量
    }

    //头部
    public function head(){
    	$this->display();
    }

    public function left(){
    	$this->display();
    }

    public function right(){
    	$this->display();
    }

}