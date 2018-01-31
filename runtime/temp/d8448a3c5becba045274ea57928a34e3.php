<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"D:\PHPStudy\WWW\XFPHP/app/admin\view\index\main.html";i:1517368527;s:57:"D:\PHPStudy\WWW\XFPHP\app\admin\view\common\mainHead.html";i:1500516744;}*/ ?>
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
<div class="admin-main fadeInUp animated">
    <div class="table-responsive">
        <table class="layui-box layui-table" lay-even lay-skin="line">
            <colgroup>
                <col width="40%">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th class="text-center" colspan="2"><?php echo lang('systemInfo'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>网站域名</td>
                <td><?php echo $config['url']; ?></td>
            </tr>
            <tr>
                <td>网站目录</td>
                <td><?php echo $config['document_root']; ?></td>
            </tr>
            <tr>
                <td>服务器操作系统</td>
                <td><?php echo $config['server_os']; ?></td>
            </tr>
            <tr>
                <td>服务器端口</td>
                <td><?php echo $config['server_port']; ?></td>
            </tr>
            <tr>
                <td>服务器IP</td>
                <td><?php echo $config['server_ip']; ?></td>
            </tr>
            <tr>
                <td>WEB运行环境</td>
                <td><?php echo $config['server_soft']; ?></td>
            </tr>
            <tr>
                <td>MySQL数据库版本</td>
                <td><?php echo $config['mysql_version']; ?></td>
            </tr>
            <tr>
                <td>运行PHP版本</td>
                <td><?php echo $config['php_version']; ?></td>
            </tr>

            <tr>
                <td>最大上传限制</td>
                <td><?php echo $config['max_upload_size']; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>