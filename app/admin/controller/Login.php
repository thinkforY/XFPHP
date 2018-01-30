<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin;
/**
* 登录操作
* xuf
*/
class Login extends Controller
{
	private $cache_model,$system;
	public function index(){
		if (request()->isPost()) {
			$admin = new Admin();
			$data = input("post.");
			$num = $admin->login($data);
			if ($num == 1) {
				return json(['code'=>1,'msg'=>'登录成功','url'=>url('index/index')]);
			}else{
				return json(['code'=>0,'msg'=>'用户名或者密码错误，重新输入!']);
			}
		}
		$this->cache_model = array("");
		return $this->fetch("login");
	}
	//退出登录
	public function logout(){
		session(null);
		$this->redirect("login/index");
	}
}