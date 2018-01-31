<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:53:"D:\PHPStudy\WWW\XFPHP/app/admin\view\index\index.html";i:1517368501;s:53:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\head.html";i:1500515889;s:53:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\foot.html";i:1499333476;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo config('sys_name'); ?>后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/public/static/admin/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/public/static/admin/css/global.css" media="all">
    <link rel="stylesheet" href="/public/static/admin/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/static/admin/css/animate.css" />
    <script>
        var ADMIN = '/public/static/admin';
        var navs = <?php echo $menus; ?>;
    </script>
    <style>
        .fa{width: 1rem; font-size: 1rem;text-align: center;}
    </style>

</head>
<body>
<div class="layui-layout layui-layout-admin" style="border-bottom: solid 5px #1aa094;">
<div class="layui-header header header-demo">
    <div class="layui-main">
        <div class="admin-login-box">
            <a class="logo" style="left: 0;" href="<?php echo url('admin/index/index'); ?>">
                <span style="font-size: 22px;"><?php echo config('sys_name'); ?></span>
            </a>
            <div class="admin-side-toggle">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <div class="admin-side-full">
                <i class="fa fa-life-bouy" aria-hidden="true"></i>
            </div>
        </div>
        <ul class="layui-nav admin-header-item">
            <li class="layui-nav-item" id="cache">
                <a href="javascript:;"><?php echo lang('clearCache'); ?></a>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo url('home/index/index'); ?>" target="_blank"><?php echo lang('home'); ?></a>
            </li>
            <li class="layui-nav-item">
                <a href="javascript:;" class="admin-header-user">
                    <img src="/public/static/admin/images/0.jpg" />
                    <span><?php echo session('username'); ?></span>
                </a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="<?php echo url('login/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i><?php echo lang('logout'); ?></a>
                    </dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav admin-header-item-mobile">
            <li class="layui-nav-item">
                <a href="<?php echo url('home/index/index'); ?>" target="_blank"><?php echo lang('home'); ?></a>
            </li>
            <li class="layui-nav-item">
                <a href="<?php echo url('login/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> <?php echo lang('logout'); ?></a>
            </li>
        </ul>
    </div>
</div>
<div class="layui-side layui-bg-black" id="admin-side">
    <div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
</div>
<div class="layui-body" id="admin-body">
    <div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab" >
        <ul class="layui-tab-title">
            <li class="layui-this">
                <i class="fa fa-dashboard" aria-hidden="true"></i>
                <cite>控制面板</cite>
            </li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src="<?php echo url('main'); ?>"></iframe>
            </div>
        </div>
    </div>
</div>
    <div class="layui-footer footer footer-demo" id="admin-footer">
        <div class="layui-main">
            <p>2017 &copy;
                <a href="http://www.cltphp.com/">www.cltphp.com</a> LGPL license
            </p>
        </div>
    </div>
    <div class="site-tree-mobile layui-hide">
        <i class="layui-icon">&#xe602;</i>
    </div>
    <div class="site-mobile-shade"></div>

    <script type="text/javascript" src="/public/static/admin/plugins/layui/layui.js"></script>
    <script src="/public/static/js/jquery.2.1.1.min.js"></script>
    <script src="/public/static/admin/js/index.js"></script>
    <script>
        $('#cache').click(function () {
            layer.confirm('确认要清除缓存？', {icon: 3}, function (data) {
                $.post('<?php echo url("clear"); ?>', {}, function (data) {
                    layer.msg(data.info, {icon: 6}, function (index) {
                        layer.close(index);
                        window.location.href = data.url;
                    });
                });
            });
        });
    </script>
</div>
</body>
</html>