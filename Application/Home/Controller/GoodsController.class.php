<?php
	namespace Home\Controller;
	use Think\Controller;

	class GoodsController extends Controller{
		//商品详情
		public function goodsDetail(){
			$this->display('Goods/detail');
		}

		//商品分类
		public function goodsCategory(){
			$this->display('Goods/category');
		}

		 //空方法操作
    	public function _empty($method,$args){
    		echo "没有此方法";
   		}
	}