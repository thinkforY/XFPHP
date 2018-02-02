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
	//删除管理员
	public function adminDel(){
		$admin_id=input('get.admin_id');
        if (session('aid')==1){
            Admin::destroy(['admin_id'=>$admin_id]);
            $this->redirect('adminList');
        }
	}
	//修改管理员状态
	public function adminState(){
		$id = input('post.id');
		if (empty($id)) {
			$result['status'] = 0;
			$result['info'] = '用户ID不存在!';
			$result['url'] = url('adminList');
			exit;
		}
		$status = db('admin')->where('admin_id='.$id)->value('is_open');
		if ($status == 1) {
			$data['is_open'] = 0;
			db('admin')->where('admin_id='.$id)->update($data);
			$result['status'] = 1;
			$result['info'] = lang('disabled');
		}else{
			$data['is_open'] = 1;
			db('admin')->where('admin_id='.$id)->update($data);
			$result['status'] = 1;
			$result['info'] = lang('enabled');
		}
		return $result;
	}

	//更新管理员信息
	public function adminEdit(){
		if (request()->isPost()) {
			$data = input('post.');
			$pwd = input('post.pwd');
			$map['admin_id'] = array('neq',input('post.admin_id'));
			$where['admin_id'] = input('post.admin_id');
			if (input('post.username')) {
				$map['username'] = input('post.username');
				$check_user = Admin::get($map);
				if (($check_user)) {
					return $result = ['code'=>0,'msg'=>'用户已存在，请重新输入用户名！'];
				}
			}
			if ($pwd) {
				$data['pwd'] = input('post.pwd','','md5');
			}else{
				unset($data['pwd']);
			}
			$msg = $this->validate($data,"Admin");
			if ($msg != 'true') {
				return $result = ['code'=>0,'msg'=>$msg];
			}
			Admin::update($data);
			return $result = ['code'=>1,'msg'=>'管理员修改成功！','url'=>url('adminList')];
		}else{
			$auth_group = AuthGroup::all();
			$info = Admin::get(['admin_id'=>input('admin_id')]);
			$selected = db('auth_group')->where('group_id',$info['group_id'])->find();
			$this->assign('selected',json_encode($selected,true));
			$this->assign('info',$info->toJson());
			$this->assign('authGroup',json_encode($auth_group,true));
			$this->assign('title',lang('edit').lang('admin'));
			return view('adminForm');
		}
	}
	/*-----------------------用户组管理----------------------*/
	//用户组管理
	public function adminGroup(){
		$list = AuthGroup::all();
		$this->assign('list',$list);
		return $this->fetch();
	}
	//删除管理员分组
	public function groupDel(){
		AuthGroup::destroy(['group_id'=>input('id')]);
		$this->redirct('adminGroup');
	}
	//添加分组
	public function groupAdd(){
		if (request()->isPost()) {
			$data = input('post.');
			$data['addtime'] = time();
			AuthGroup::create($data);
			$result['msg'] = '用户组添加成功！';
			$result['url'] = url('adminGroup');
			$result['code'] = 1;
			return $result;
		}else{
			$this->assign('title','添加用户组');
			$this->assign('info','null');
			return $this->fetch('groupForm');
		}
	}
}