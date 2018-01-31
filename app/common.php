<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

// 快速文件数据读取和保存 针对简单类型数据 字符串、数组
function F($name,$value='',$path=DATA_PATH){
	static $_cache = array();
	$filename = $path.$name.".php";
	if ('' !== $value) {
		if (is_null($value)) {
			//删除缓存
			return unlink($filename);
		}else{
			//缓存数据
			$dir = dirname($filename);
			//目录不存在则创建
			if(!is_dir($dir)) $res = mkdir($dir,0777,true);
			return file_put_contents($filename, "<?php\nreturn ".var_export($value,true).";\n?>");
		}
	}
	if (isset($_cache[$name])) {
		return $_cache[$name];
	}
	//获取缓存数据		
	if (is_file($filename)) {
		$value = include $filename;
		$_cache[$name] = $value;
	}else{
		$_cache[$name] = false;
	}
	return $value;
}
//缓存
function savecache($name='',$id=''){
	if ($name == "Field") {
		if ($id) {
			$Model = db($name);
			$data = $Model->order('listorder')->where('moduleid='.$id)->column('*','field');
			$name=$id.'_'.$name;
			F($name,$data);
		}else{
			$module = F("Module");
			foreach ($module as $key => $val) {
				savecache($name,$key);
			}
		}
	}elseif ($name == "System") {
		$Model = db($name);
		$list = $Model->where(array('id'=>1))->find();
		$data = $sysdata=$list;
		F('System',$list);
	}elseif ($name == "Module") {
		$Model = db($name);
		$list = $Model->order('listorder')->select();
		$pkid = $Model->getPk();
		$data = array();
		$smalldata = array();
		foreach ($list as $key => $val) {
			$data[$val[$plid]] = $val;
			$smalldata[$val['name']] = $val[$pkid];
		}
		F($name,$data);
		F('Mod',$smalldata);
	}else{
		$Model = db($name);
		$list = $Model->order("listorder")->select();
		$pkid = $Model->getPk();
		$data = array();
		foreach ($list as $key => $val) {
			$data[$val[$pkid]] = $val;
		}
		F($name,$data);
	}
	return true;
}