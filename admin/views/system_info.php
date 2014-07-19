<!DOCTYPE HTML>
<html>
    <head>
        <title> 表单代码结构</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />   <!-- 下面的样式，仅是为了显示代码，而不应该在项目中使用-->
        <link href="<?php echo base_url() ?>/views/assets/css/prettify.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            code {
                padding: 0px 4px;
                color: #d14;
                background-color: #f7f7f9;
                border: 1px solid #e1e1e8;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <h1>欢迎您来到Skylink云平台管理系统</h1>
            <hr />
            <div class="detail-section" id="user_info">
                <h2>基本信息</h2>
                <p>登陆者：nosun  用户组：管理员</p>
                <p>这是您第100次登录本站，上次登录时间为：2014年5月7日 11:21:29，登录IP为<?php echo $this->input->ip_address(); ?></p>
            </div>
            <hr />
            <div class="detail-section" id="sys_info">
                <h2>系统信息</h2>
                <div class="row detail-row">
                    <div class="span12">
                        <label>平台版本:</label><span class="detail-text"><?php echo SKYLINK_VERSION; ?></span>
                    </div>
                    <div class="span12">
                        <label>当前系统:</label><span class="detail-text"><?php echo PHP_OS; ?></span>
                    </div>                
                </div>


                <div class="row detail-row">
                    <div class="span12">
                        <label>运行环境：</label><span class="detail-text"><?php echo isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '' ?></span>
                    </div>                
                    <div class="span12">
                        <label>数据库:</label><span class="detail-text"><?php echo 'MySQL' . $this->db->version(); ?></span>
                    </div>
                </div>
                <div class="row detail-row">
                    <div class="span12">
                        <label>网站域名:</label><span class="detail-text"><?php echo $_SERVER['SERVER_NAME']; ?></span>
                    </div>
                    <div class="span12">
                        <label>网站IP:</label><span class="detail-text"><?php echo getHostByName(php_uname('n')) . ':' . $_SERVER['SERVER_PORT']; ?></span>
                    </div>

                </div>
            </div>
        </div>

    <body>
</html>  