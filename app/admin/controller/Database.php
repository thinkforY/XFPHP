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
	//修复
	public function repair(){
		$batchFlag = input('param.batchFlag',0,'intval');
		//批量删除
		if ($batchFlag) {
			$table = input('key',array());
		}else{
			$table[] = input('tableName','');
		}
		if (empty($table)) {
			$result['msg'] = '请选择要修复的表！';
			$result['code'] = 0;
			return $result;
		}
		$strTable = implode(',', $table);
		if (!Db::query("REPATR TABLE {$strTable}")) {
			$strTable = '';
		}
		$result['msg'] = '修复表成功！';
		$result['url'] = url('database');
		$result['code'] = 1;
		return $result;
	}
	//备份
	public function backup(){
		$puttables = input('post.tables/a');
		if (empty($puttables)) {
			$dataList = $this->db->query("SHOW TABLE STATUS LIKE '".config('prefix')."%'");
			foreach ($dataList as $row) {
				$table[] = $row['Name'];
			}
		}else{
			$table = input('tables/a');
		}
		$sql = "-- XFPHP SQL Backup\n-- Time:".toDate(time())."\n-- http://www.xfphp.com \n\n";
		foreach ($table as $key => $table) {
			$sql .= "--\n-- 表的结构 `$table`\n-- \n";
            $sql .= "DROP TABLE IF EXISTS `$table`;\n";
            $info = $this->db->query("SHOW CREATE TABLE  $table");
            $sql .= str_replace(array('USING BTREE','ROW_FORMAT=DYNAMIC'),'',$info[0]['Create Table']).";\n";
            $result = $this->db->query("SELECT * FROM $table");
            if($result)$sql .= "\n-- \n-- 导出`$table`表中的数据 `$table`\n--\n";
            foreach($result as $key=>$val) {
                foreach ($val as $k=>$field){
                    if(is_string($field)) {
                        $val[$k] = '\''. $this->db->escape_string($field).'\'';
                    }elseif($field==0){
                        $val[$k] = 0;
                    } elseif(empty($field)){
                        $val[$k] = 'NULL';
                    }
                }
                $sql .= "INSERT INTO `$table` VALUES (".implode(',', $val).");\n";
            }
		}
		$filename = empty($filename) ? date('YmdH').'_'.rand_string(10) : $filename;
		$r = file_put_contents($this->datadir . $filename . '.sql',trim($sql));
		exit(json_encode(array('code'=>1,'msg'=>'成功备份数据库','url'=>url('restore'))));
	}
	//备份列表
	public function restore(){
		$size = 0;
		$pattern = "*.sql";
		$filelist = glob($this->datadir.$pattern);
		$fileArray = array();
		foreach ($filelist as $i => $file) {
			//制度去文件
			if (is_file($file)) {
				$_size = filesize($file);
				$size += $_size;
				$name = basename($file);
				$pre = substr($name, 0,strrpos($name, '_'));
				$number = str_replace(array($pre.'_','.sql'), array('',''), $name);
				$fileArray[] = array(
					'name'=>$name,
					'pre'=>$pre,
					'time'=>filemtime($file),
					'size'=>$_size,
					'number'=>$number,
				);
			}
		}
		if (empty($fileArray)) {
			$fileArray = array();
		}
		krsort($fileArray);//按备份时间倒序排列
		$this->assign('vlist',$fileArray);
		$this->assign('total',format_bytes($size));
		$this->assign('filenum',count($fileArray));
		return $this->fetch();
	}
	//执行还原数据库操作
	public function restoreData(){
		
	}
}