<?php
namespace Model;
use Think\Model;

class ManagerModel extends Model{
	//验证用户名和密码
	public function checkNamePwd($mg_name,$mg_pwd){

		$info = $this->getByMg_Name($mg_name);
		show_obj($info);

	}
}