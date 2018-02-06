<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"D:\PHPStudy\WWW\XFPHP/app/admin\view\auth\groupForm.html";i:1517553268;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainHead.html";i:1500516744;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainFoot.html";i:1500448109;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Paging</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">

    <link rel="stylesheet" href="/public/static/admin/plugins/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/public/static/admin/css/global.css" media="all">
    <link rel="stylesheet" href="/public/static/admin/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/public/static/admin/css/style.css">
    <link rel="stylesheet" href="/public/static/admin/css/animate.css" />
</head>
<body>
<div class="admin-main fadeInUp animated" ng-app="hd" ng-controller="ctrl">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend><?php echo $title; ?></legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label">用户组名</label>
            <div class="layui-input-4">
                <input type="text" name="title" ng-model="field.title" lay-verify="required" placeholder="<?php echo lang('pleaseEnter'); ?>用户组名" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                <a href="<?php echo url('adminGroup'); ?>" class="layui-btn layui-btn-primary"><?php echo lang('back'); ?></a>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/public/static/admin/plugins/layui/layui.js"></script>
<script src="/public/static/js/jquery.2.1.1.min.js"></script>

<script src="/public/static/js/angular.min.js"></script>
<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope',function($scope) {
        $scope.field = '<?php echo $info; ?>'!='null'?<?php echo $info; ?>:{title:''};
        layui.use(['form', 'layer'], function () {
            var form = layui.form(), layer = layui.layer;
            form.on('submit(submit)', function (data) {
                // 提交到方法 默认为本身
                data.field.group_id = $scope.field.group_id;
                $.post("", data.field, function (res) {
                    if (res.code > 0) {
                        layer.msg(res.msg, {time: 1800, icon: 1}, function () {
                            location.href = res.url;
                        });
                    } else {
                        layer.msg(res.msg, {time: 1800, icon: 2});
                    }
                });
            })
        });
    }]);
</script>