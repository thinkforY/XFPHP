<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"D:\PHPStudy\WWW\XFPHP/app/admin\view\auth\groupAccess.html";i:1517555508;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainHead.html";i:1500516744;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainFoot.html";i:1500448109;}*/ ?>
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
<link rel="stylesheet" href="/public/static/admin/zTree/css/zTreeStyle.css" type="text/css">
<link rel="stylesheet" href="/public/static/admin/css/ztree.css" />

<div class="admin-main fadeInUp animated">
    <fieldset class="layui-elem-field">
        <legend>配置权限</legend>
        <div class="layui-field-box">
            <form class="layui-form layui-form-pane">
                <ul id="treeDemo" class="ztree"></ul>
                <div class="layui-form-item text-center">
                    <button type="button" class="layui-btn" lay-submit="" lay-filter="submit"><?php echo lang('submit'); ?></button>
                    <button class="layui-btn layui-btn-danger" type="button" onclick="window.history.back()"><?php echo lang('back'); ?></button>
                </div>
            </form>
        </div>

    </fieldset>
</div>
<script type="text/javascript" src="/public/static/admin/plugins/layui/layui.js"></script>
<script src="/public/static/js/jquery.2.1.1.min.js"></script>

<script type="text/javascript" src="/public/static/admin/zTree/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/public/static/admin/zTree/js/jquery.ztree.excheck.min.js"></script>
<script type="text/javascript">
    var setting = {
        check: {
            enable: true
        },
        view: {showLine: false, showIcon: false, dblClickExpand: false},
        data: {
            simpleData: {
                enable: true,
                pIdKey:'pid',
                idKey:'id'
            },
            key:{
                name:'title'
            }
        }
    };
    var zNodes =<?php echo $data; ?>;
    function setCheck() {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.setting.check.chkboxType = { "Y":"ps", "N":"ps"};

    }
    $(document).ready(function(){
        $.fn.zTree.init($("#treeDemo"), setting, zNodes);
        setCheck();
        layui.use(['form', 'layer'], function () {
            var form = layui.form(), layer = layui.layer;
            form.on('submit(submit)', function () {
                // 提交到方法 默认为本身
                var treeObj=$.fn.zTree.getZTreeObj("treeDemo"),
                    nodes=treeObj.getCheckedNodes(true),
                    v="";
                for(var i=0;i<nodes.length;i++){
                    v+=nodes[i].id + ",";
                }
                var id = "<?php echo input('id'); ?>";
                $.post("<?php echo url('groupSetaccess'); ?>", {'rules':v,'group_id':id}, function (res) {
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
    });
</script>