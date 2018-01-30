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
		return $this->fetch("login");
	}
	//退出登录
	public function logout(){
		session(null);
		$this->redirect("login/index");
	}
}