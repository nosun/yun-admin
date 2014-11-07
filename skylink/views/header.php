<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title><?php echo $title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url() ?>assets/bs33/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/bs3/bui-min.css" rel="stylesheet">    
    <link href="<?php echo base_url() ?>assets/css/yun.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/bs33/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bs33/js/bootstrap.min.js"></script>
</head>
<body id="ucenter">
<nav id="header" class="navbar-default navbar-fixed-top">
     <div class="container">
         <div id="logo" class="navbar-brand"><strong>Skyware</strong> 云平台 </div>
         <div class="navbar-right navbar-text">
            <a href="#" id="header_user_name" class="navbar-link mye_icon">新年</a>
             <a id="message" style="cursor: pointer;" href="#" class="navbar-link mye_icon">消息</a>
            <a href="<?php echo site_url('login/quit') ?>" class="navbar-link">退出</a>
         </div>
     </div>
 </nav>