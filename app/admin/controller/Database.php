<?php
namespace app\admin\controller;
use think\Db;
/**
* 	数据库备份模块
*/
class Database extends Common
{
	protected $db = '';
	protected $datadir = './public/Data/';
	function _initialize(){
		parent::_initialize();
		$db = db('');
		$this->db = db::connect();
	}
	public function database(){
		$dbtables = $this->db->query("SHOW TABLE STATUS LIKE '".config('prefix')."%'");
		$total = 0;
		foreach ($dbtables as $k => $v) {
			$dbtables[$k]['size'] = format_bytes($v['Data_length'] + $v['Index_length']);
			$total += $v['Data_length'] + $v['Index_length'];
		}
		$this->assign('dataList',$dbtables);
		$this->assign('total',format_bytes($total));
		$this->assign('tableNum',count($dbtables));
		return $this->fetch();
	}
	//优化
	public function optimize(){
		$batchFlag = input('param.batchFlag',0,'intval');
		//批量删除
		if ($batchFlag) {
			$table = input('key',array());
		}else{
			$table[] = input('tableName','');
		}
		if (empty($table)) {
			$result['msg'] = '请选择要优化的表！';
			$result['code'] = 0;
			return $result;
		}
		$strTable = implode(',', $table);
		if (!DB::query("OPTIMIZE TABLE {$strTable}")) {
			$strTable = '';
		}
		$result['msg'] = '优化表成功！';
		$result['url'] = url('database');
		$result['code'] = 1;
		return $result;
	}
}