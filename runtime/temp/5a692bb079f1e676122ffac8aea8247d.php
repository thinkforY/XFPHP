<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:54:"D:\PHPStudy\WWW\XFPHP/app/admin\view\system\email.html";i:1517382738;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainHead.html";i:1500516744;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainFoot.html";i:1500448109;}*/ ?>
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
        <legend>邮箱配置</legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label">服务器</label>
            <div class="layui-input-4">
                <input type="text" lay-verify="required" name="smtp_server" placeholder="SMTP服务器" value="<?php echo $info['smtp_server']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">SMTP端口</label>
            <div class="layui-input-4">
                <input type="text" lay-verify="required" name="smtp_port" placeholder="SMTP端口" value="<?php echo $info['smtp_port']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">发信人</label>
            <div class="layui-input-4">
                <input type="text" name="smtp_user" lay-verify="required" placeholder="发信人邮件地址" value="<?php echo $info['smtp_user']; ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">身份验证码</label>
            <div class="layui-input-3">
                <input type="text" name="smtp_pwd" lay-verify="required" placeholder="SMTP身份验证码" value="<?php echo $info['smtp_pwd']; ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">测试邮箱</label>
            <div class="layui-input-3">
                <input type="text" name="test_eamil" id="test_eamil" placeholder="测试接收邮件地址" value="<?php echo $info['test_eamil']; ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="sys"><?php echo lang('submit'); ?></button>
                <button type="reset" class="layui-btn layui-btn-primary"><?php echo lang('reset'); ?></button>
                <button type="button" class="layui-btn layui-btn-normal" id="trySend">测试发送</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/public/static/admin/plugins/layui/layui.js"></script>
<script src="/public/static/js/jquery.2.1.1.min.js"></script>

<script>
    $('#trySend').click(function(){
        var email = $('#test_eamil').val();
        $.post("<?php echo url('trySend'); ?>",{email:email},function(res){
            if(res.code > 0){
                layer.msg(res.msg,{time:1800});
            }else{
                layer.msg(res.msg,{time:1800});
            }
        });
    });
    layui.use(['form', 'layer'], function () {
        var form = layui.form(),layer = layui.layer;
        // 登录提交监听
        form.on('submit(sys)', function (data) {
            // 提交到方法 默认为本身
            $.post("<?php echo url('system/email'); ?>",data.field,function(res){
                if(res.code > 0){
                    layer.msg(res.msg,{time:1800},function(){
                        location.href = res.url;
                    });
                }else{
                    layer.msg(res.msg,{time:1800});
                }
            });
        })
    })
</script>