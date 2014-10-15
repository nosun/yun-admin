<?php $this->load->view('common/header'); ?>

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
        <div class="detail-section" id="user_info">
            <h2>基本信息</h2>
            <p>登陆者：<?php echo $this->_admin->username;?> &nbsp;&nbsp; 用户组：<? echo $role['name'] ?> </p>
            <p>这是您第<?echo $login_num;?>次登录本站，上次登录时间为：<?echo date('Y-m-d h:i',$last_login[0]['logintime'])?>，登录IP为<?php echo $last_login[0]['loginip'] ?></p>
        </div>
        <div class="detail-section" id="sys_info">
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

<?php $this->load->view('common/footer'); ?>
