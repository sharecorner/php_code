<?php
	namespace Admin\Controller;
	use Think\Controller;

	//管理员登录控制器
	class ManagerController extends Controller{
		//login
		public function login(){
			//实例化验证码对象
			$verify = new \Think\Verify();
			if (IS_POST) {
				//判断验证码是否正确
				if ($verify->check($_POST['captcha'])) {
					//验证用户名和密码
					$mg_name = $_POST['mg_name'];
					$mg_pwd = $_POST['mg_pwd'];
					$m_model = new \Model\ManagerModel();
					$res = $m_model->checkNamePwd($mg_name,$mg_pwd);

					if(!empty($res)){ //非空非零 返回false
					//存储session 数据持久化
						session('username',$_POST['mg_name']);
						session('userid',$_POST['mg_id']);

						//跳转到后台
						$this->redirect('Index/index');
					}else{
						$this->error('用户名或密码错误');
					}

				}else{
					$this->error('验证码错误');
				}
			}else{
			$this->display();
			}
		}

		public function logout(){
			session(null);
		}

		//验证码
		public function verifyImg(){
			//验证码配置参数
			$config = array(
				'useImgBg'  =>  false,           // 使用背景图片 
				'codeSet'   =>  '123456789',             // 验证码字符集合
        		'fontSize'  =>  20,              // 验证码字体大小(px)
        		'useCurve'  =>  false,            // 是否画混淆曲线
        		'useNoise'  =>  false,            // 是否添加杂点	
        		'imageH'    =>  0,               // 验证码图片高度
       			'imageW'    =>  0,               // 验证码图片宽度
       			'fontttf'   =>  '1.ttf',              // 验证码字体，不设置随机获取
       			'length'    =>  3,               // 验证码位数
       			'bg'        =>  array(243, 251, 254),  // 背景颜色
			);

			//实例化一个验证码对象
			$verify = new \Think\Verify($config);

			$verify->entry();
		}
	}