<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"D:\PHPStudy\WWW\XFPHP/app/admin\view\login\login.html";i:1517304880;}*/ ?>
<!DOCTYPE html>
<html lang="zh_ch">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>登录</title>
	<link rel="stylesheet" href="/public/static/admin/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/public/static/admin/css/login.css" />
</head>
<body class="beg-login-bg">
	<div class="beg-login-box" ng-app="hd" ng-controller="ctrl">
		<header>
			<h1><?php echo config('sys_name'); ?>后台登录</h1>
		</header>
		<div class="beg-login-main">
			<form class="layui-form layui-form-pane" method="post">
	            <div class="layui-form-item">
	                <label class="beg-login-icon">
	                    <i class="layui-icon">&#xe612;</i>
	                </label>
	                <input type="text" ng-model="field.username" placeholder="这里输入登录名" class="layui-input">
	            </div>
	            <div class="layui-form-item">
	                <label class="beg-login-icon">
	                    <i class="layui-icon">&#xe642;</i>
	                </label>
	                <input type="password" ng-model="field.password" placeholder="这里输入密码" class="layui-input">
	            </div>
	            <textarea name="data" hidden></textarea>
	            <div class="layui-form-item lfb">
	                <div class="beg-pull-left beg-login-remember">
	                    <label>记住帐号？</label>
	                    <input type="checkbox" name="rememberMe" value="true" lay-skin="switch" checked title="记住帐号">
	                </div>
	                <div class="beg-pull-right">
	                    <button type="submit" class="layui-btn btn-submit" lay-submit lay-filter="sub">
	                        <i class="layui-icon">&#xe650;</i> 登录
	                    </button>
	                </div>
	                <div class="beg-clear"></div>
	            </div>
	        </form>
		</div>
		<footer>
	        <p><?php echo config('sys_name'); ?> © <?php echo config('url_domain_root'); ?></p>
	    </footer>
	</div>
<script type="text/javascript" src="/public/static/admin/plugins/layui/layui.js"></script>
<script src="/public/static/js/angular.min.js"></script>
<script src="/public/static/js/jquery.2.1.1.min.js"></script>
<script>
	var m = angular.module("hd",[]);
	m.controller("ctrl",['$scope','$http',function($scope,$http){
		$scope.field = {username:"",password:""};
		layui.use(['form','layer'],function(){
			var form = layui.form(),
				layer = layui.layer;
			//登录监听事件
			form.on("submit(sub)",function(){
				// 提交到方法 默认为本身
				$.post("<?php echo url('index'); ?>",$scope.field,function(res){
					if (res.code > 0) {
						layer.msg(res.msg,{time:1800},function(){
							location.href = "<?php echo url('index/index'); ?>";
						});
					}else{
						layer.msg(res.msg,{time:1800});
					}
				});
			});
		});
	}]);
</script>
</body>
</html>
