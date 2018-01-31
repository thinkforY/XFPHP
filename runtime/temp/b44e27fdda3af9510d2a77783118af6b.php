<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"D:\PHPStudy\WWW\XFPHP/app/admin\view\system\system.html";i:1517382025;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainHead.html";i:1500516744;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainFoot.html";i:1500448109;}*/ ?>
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
        <legend><?php echo lang('systemSet'); ?></legend>
    </fieldset>
    <form class="layui-form layui-form-pane">
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('websiteName'); ?></label>
            <div class="layui-input-4">
                <input type="text" ng-model="field.name" lay-verify="required" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('websiteName'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('WebsiteUrl'); ?></label>
            <div class="layui-input-4">
                <input type="text" ng-model="field.url" lay-verify="url" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('WebsiteUrl'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('seoTitle'); ?></label>
            <div class="layui-input-4">
                <input type="text" ng-model="field.title" lay-verify="required" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('WebsiteUrl'); ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label"><?php echo lang('seoKeyword'); ?></label>
            <div class="layui-input-block">
                <textarea ng-model="field.key" lay-verify="required" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('seoKeyword'); ?>" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label"><?php echo lang('description'); ?></label>
            <div class="layui-input-block">
                <textarea ng-model="field.des" lay-verify="required" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('description'); ?>" class="layui-textarea"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">网站LOGO</label>
            <div class="layui-input-block">
                <div class="site-demo-upload">
                    <img id="cltLogo" src="/public/static/admin/images/tong.png">
                    <div class="site-demo-upbar">
                        <input type="file" name="logo" lay-type="images" class="layui-upload-file" id="logo">
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('recordNum'); ?></label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.bah" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('recordNum'); ?>" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">Copyright</label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.copyright" placeholder="<?php echo lang('pleaseEnter'); ?>Copyright" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('companyAddress'); ?></label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.ads" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('companyAddress'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('tel'); ?></label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.tel" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('tel'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"><?php echo lang('email'); ?></label>
            <div class="layui-input-3">
                <input type="text" ng-model="field.email" placeholder="<?php echo lang('pleaseEnter'); ?><?php echo lang('email'); ?>" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="button" class="layui-btn" lay-submit="" lay-filter="sys"><?php echo lang('submit'); ?></button>
                <button type="reset" class="layui-btn layui-btn-primary"><?php echo lang('reset'); ?></button>
            </div>
        </div>
    </form>
</div>
<script src="/public/static/js/angular.min.js"></script>
<script type="text/javascript" src="/public/static/admin/plugins/layui/layui.js"></script>
<script src="/public/static/js/jquery.2.1.1.min.js"></script>

<script>
    var m = angular.module('hd',[]);
    m.controller('ctrl',['$scope','$http',function($scope,$http){
        $scope.field = <?php echo $system; ?>;
        layui.use(['form', 'layer','upload'], function () {
            var form = layui.form(),layer = layui.layer,upload = layui.upload;
            if($scope.field.logo){
                cltLogo.src = "/public"+ $scope.field.logo;
            }
            upload({
                url: '<?php echo url("UpFiles/upload"); ?>',
                title: '上传LOGO',
                ext: 'jpg|png|gif', //那么，就只会支持这三种格式的上传。注意是用|分割。
                success: function(res, input){
                    cltLogo.src = "/public"+res.url;
                    $scope.field.logo = res.url;
                }
            });
            // 登录提交监听
            form.on('submit(sys)', function () {
                // 提交到方法 默认为本身
                $.post("<?php echo url('system/system'); ?>",$scope.field,function(res){
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
    }]);
</script>