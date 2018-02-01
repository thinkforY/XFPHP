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
}