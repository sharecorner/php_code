<?php

	namespace Admin\Controller;
	use Think\Controller;

	//商品管理控制器
	class GoodsController extends Controller{
		//商品展示
		public function showList(){

			$m_goods = D("Goods");
			// $m_goods = D("Goods");  实例化其它数据表 替换Goods
			$data = $m_goods->select();
			//$data = $m_goods->field('goods_id,goods_price,goods_name')->group('goods_category_id')->select();
			//show_obj($data);

			$this->assign('data',$data);
			$this->display();
		}

		//商品添加
		public function add(){

			if (IS_POST) {
				$data = I('post.'); // 1 获取post的数据
				$model = M('Goods');


				if($model->create($data)) { // 2 收集表单数据

					if(!empty($_FILES)) { // 3 判断是否上传图片
						//配置上传类参数
						$config = array(
							'rootPath'      =>  './Public/', //保存根路径
       						'savePath'      =>  'Upload/', //保存路径	
						);
						//实例化上传类
						$upload = new \Think\Upload($config);
						$upd_res = $upload->uploadOne($_FILES['goods_img']);  //上传单个文件 【true,false】

						if ($upd_res) {
							show_obj($upload->getError()); //获取上传附件产生的错误信息
						}else{
							//拼装路径并保存
							$img = $upd_res['savePath'].$upd_res['savename']; // './Public/Upload/img_name'
							$_POST['goods_big_img'] = $img;    //保存到POST中 

							//缩略图制作
							$image = new \Think\Image();
							$srcimg = $upload->rootPath.$upd_res['savename']; //获取图片路径
							$image->open($srcimg,); //打开原图像
							$image->thumb(150,150); //缩略图制作
							$smallimg = $upd_res['savePath'].'small'.$upd_res['savename']; //拼接路径 缩略图路径
							$image->save($upload->rootPath.$smallimg); //保存路径
							$_POST['goods_small_img'] = $smallimg;  //保存图片到post中
						}
					}

					$model->create();
					$result=$model->add();   // 4 添加数据到数据库

					if ($result) { //$result = false 添加失败 
						$this->success('数据添加成功',U('Goods/showList'),2);
					}else{
						$this->error('数据添加失败',3);
					}
				}else{
					$this->error('数据添加失败',3);
				}

			}else{
				//如果不是post提交则展示数据
				$m_model = D('Category');  //实例化分类模型对象
				$data = $m_model->field('cat_name')->select(); //查询商品分类
				$this->assign('data',$data);

				$da = D('Goods')->field('goods_brand_id')->select();  //商品列表
				$this->assign('da',$da);
				$this->display();
			}
		}

		//商品修改
		public function upd(){	
			// dump($a);
			//展示更新数据 修改数据并提交
			if (IS_POST) {
				$m_model = M('Goods');
				$data = I('post.');
				// show_obj($data);
				// exit();
				$m_model->goods_id = I('post.goods_id');
				$m_model->goods_name = I('post.goods_name');
				$m_model->goods_weight = I('post.goods_weight');
				$m_model->goods_price = I('post.goods_price');
				$m_model->goods_number = I('post.goods_number');
				$m_model->goods_category_id = I('post.goods_category_id');
				$m_model->goods_brand_id = I('post.goods_brand_id');
				$m_model->goods_introduce = I('post.goods_introduce');
				$m_model->goods_big_img = I('post.goods_big_img');
				$m_model->goods_small_img = I('post.goods_small_img');
				$m_model->goods_create_time = I('post.goods_create_time');
				$m_model->goods_last_time = I('post.goods_last_time');
				
				$r = $m_model->where('goods_id')->save();  //根据goods_id更新数据库记录

				if ($r) {
					$this->success('更新成功',U('Goods/showList',3));
				}else{
					$this->error('更新失败',3);
				}
			}else{
			//展示数据
				$id = I('get.goods_id');  //获取url goods_id
				$data = D('Goods')->find($id); //根据id 查询一条记录
				//show_obj($data);
				$this->assign('data',$data);
				$this->display();
			}
		}

		//del
		public function del(){
			
		}
	}