<?php
namespace Model;
use Think\Model;

class ManagerModel extends Model{
	//验证用户名和密码
	public function checkNamePwd($mg_name,$mg_pwd){

		//获取根据提交的用户名查询记录
		$info = $this->getByMg_Name($mg_name);

		if (!empty($info)) { //非空非零 返回false
			if ($info['mg_pwd'] === $mg_pwd) {  //根据查询出来的密码 与 参数密码 是否相等
				return $info;
			}else{
				return false;
			}
		}else{
			return false;
		}

	}
}