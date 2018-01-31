<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
use clt\Leftnav;
use app\admin\model\System as SysModel;
/**
* 系统配置
*/
class System extends Common
{
	/********************************站点管理*******************************/
	//站点设置
	public function system($sys_id=1){
		$table = db('system');
		if (request()->isPost()) {
			$datas = input('post.');
			if ($table->update($datas) !== false) {
				return json(['code' => 1, 'msg' => '站点保存成功！', 'url' => url('system/system')]);
			}else{
				return json(['code' => 0, 'msg' => '站点保存失败！']);
			}
		}else{
			$system = $table->field('id,name,url,title,key,des,bah,copyright,ads,tel,email,logo')->find($sys_id);
			$this->assign('system',json_encode($system,true));
			return $this->fetch();
		}
	}
	//邮箱配置
	public function email(){
		$table = db('config');
		if (request()->isPost()) {
			$datas = input('post.');
			foreach ($datas as $k => $v) {
				$table->where(['name' => $k, 'inc_type' => 'smtp'])->update(['value' => $v]);
			}
			return json(['code' => 1, 'msg' => '邮箱设置成功！', 'url' => url('system/email')]);
		}else{
			$smtp = $table->where(['inc_type'=>'smtp'])->select();
			$info = convert_arr_kv($smtp,'name','value');
			$this->assign('info',$info);
			return $this->fetch();
		}
	}
	//测试发送
	public function trySend(){
		$sender = input('email');
		//检查是否邮箱格式
		if (!is_email($sender)) {
			return json(['code' => -1, 'msg' => '测试邮箱码格式有误']);
		}
		$send = send_email($sender,'测试邮箱','您好！'.$this->system['name'].'的测试邮件！');
		if ($send) {
			return json(['code' => 1, 'msg' => '邮件发送成功！']);
		}else{
			return json(['code' => -1, 'msg' => '邮件发送失败！']);
		}
	}
}