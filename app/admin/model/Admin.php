<?php
namespace app\admin\model;
use think\Model;
/**
* 	
*/
class Admin extends Model
{
	public function login($data){
		$user = db("admin")->where("username",$data['username'])->find();
		if ($user) {
			if($user['pwd'] == md5($data['password'])){
				session('username',$user['username']);
				session('aid',$user['admin_aid']);
				return 1;//信息正确
			}else{
				return -1;//信息错误
			}
		}else{
			return -1;//用户不存在
		}
	}
}