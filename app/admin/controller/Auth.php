<?php
namespace app\admin\controller;
use think\Db;
use clt\leftnav;
use app\admin\model\Admin;
use app\admin\model\AuthGroup;
use app\admin\model\AuthRule;
use think\Validate;
/**
* 	
*/
class Auth extends Common
{
	//管理员列表
	public function adminList(){
		if (request()->isPost()) {
			$val = input('val');
			$url['val'] = $val;
			$this->assign('testval',$val);
			$map = '';
			if ($val) {
				$map['username|email|tel'] = array('like',"%".$val."%");
			}
			if (session("aid") != 1) {
				$map['admin_id'] = session('aid');
			}
			$page = input('pageIndex')?input('pageIndex'):1;
			$pageSize = input('pageSize')?input('pageSize'):config('pageSize');
			$list = Db::table(config('database.prefix').'admin')->alias('a')
					->join(config('database.prefix').'auth_group ag','a.group_id=ag.group_id','left')
					->field('a.*,ag.title')
					->where($map)
					->paginate(array('list_rows'=>$pageSize,'page'=>$page))
					->toArray();
			return $result = ['code'=>0,'msg'=>'获取成功','list'=>$list['data'],'count'=>$list['total'],'rel'=>1];

		}
		return view();
	}
	//添加管理员
	public function adminAdd(){
		if (request()->isPost()) {
			$data = input('post.');
			$check_user = Admin::get(['username'=>$data['username']]);
			if ($check_user) {
				return $result = ['code'=>0,'msg'=>'用户已存在，请重新输入用户名！'];
			}
			$data['pwd'] = input('post.pwd','','md5');
			$data['add_time'] = time();
			$data['ip'] = request()->ip();
			//验证
			$msg = $this->validate($data,'Admin');
			if ($msg!='true') {
				return $result = ['code'=>0,'msg'=>$msg];
			}
			//单独验证密码
			$checkPwd = Validate::is(input('post.pwd'),'require');
			if ($checkPwd === false) {
				return $result = ['code'=>0,'msg'=>'密码不能为空！'];
			}
			//添加
			if (Admin::create($data)) {
				return $result = ['code'=>1,'msg'=>'管理员添加成功！','url'=>url('adminList')];
			}else{
				return $result = ['code'=>0,'msg'=>'管理员添加失败！'];
			}
		}else{
			$auth_group = db('auth_group')->select();
			$this->assign('authGroup',json_encode($auth_group));
			$this->assign('title',lang('add').lang('admin'));
			$this->assign('info','null');
			$this->assign('selected','null');
			return view('adminForm');
		}
	}
}