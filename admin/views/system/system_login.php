<!DOCTYPE HTML>
<html>
    <head>
        <title>思佳维云平台——管理中心</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url() ?>views/assets/css/bs3/dpl-min.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>views/assets/css/bs3/bui.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>views/assets/css/main.css" rel="stylesheet" type="text/css" />
    </head>
<style type="text/css">
#error_msg {
 background:#FBE6F2 none repeat scroll 0 0;
 border:1px solid #D893A1;
}
#notice_msg {
 background:#EFF8D9 none repeat scroll 0 0;
 border:1px solid #B4E04B;
}
#error_msg, #notice_msg {
 color:#333333;
 padding: 10px;
 min-height: 26px;
 overflow: auto; /* need to clear float */
 margin-bottom:15px;
 margin-left:38px;
 width: 300px;
}


#error_msg p, #notice_msg p {
 font-size: 1.4em;
 margin-bottom:5px;
}

#error_msg img, #notice_msg img {
 float:left;
}

#error_msg_container, #notice_msg_container {
 float:left;
 margin-left:10px;
}

.message {
 color: red;
}        
</style>
    <body id="login">
        <div class="wrapper">
            <div id="header_bg">
                <div id="header">
                    <div id="login_logo"></div>
                </div>
            </div>
            <div id="login_main" class="clearfix">
                <div id="login_box">
                    <h2>管理登录</h2>
                    <?php echo $this->message->display(); ?>
                    <div class="login_cont">
                        <form id="J_Form" action="<?=site_url('login/check_login')?>" class="form-horizontal" method="post" accept-charset="utf-8">
                            <div class="control-group">
                                <label class="control-label">用户名：</label>
                                <div class="controls">
                                    <input name="username" type="text" class="input-middle" data-rules="{required : true}">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">密码：</label>
                                <div class="controls">
                                    <input name=password type="password" class="input-middle" data-rules="{required : true}">
                                </div>
                            </div>
                            <!--                           <div class="control-group">
                                                          <label class="control-label">认证码：</label>
                                                          <div class="controls">
                                                              <input name="admincode" type="password" class="input-middle" data-rules="{maxlength:10,required:true}">
                                                          </div>
                                                        </div>-->
                            <div class="control-group">
                                <label class="control-label">验证码：</label>
                                <div class="controls">
                                    <input id="captcha" name="captcha" type="text" class="input-middle" data-rules="{required : true}">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <a href="#" onclick="document.getElementById('captcha_img').src = '<?php echo site_url('login/securimage') ?>/' + Math.random();
                                        return false">
                                    <img id="captcha_img" style="cursor:pointer" src="<?php echo site_url('login/securimage') ?>" alt="验证码" />
                                </a>
                            </div>    
                            <div class="control-group">       
                                <div class="login_submit">
                                    <button id="loginButton" name="loginButton" type="submit" class="button button-primary">登 录</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer">
            <p> 北京思佳维科技有限公司 Copyright (c) 2014-2016 </p>
        </div>

    <?php  $this->load->view('common/js'); ?>
        <script type="text/javascript">
                                var Form = BUI.Form;
                                new Form.Form({
                                    srcNode: '#J_Form'
                                }).render();

        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                    $("#error_msg").fadeIn(150).fadeOut(10000);
                });
        </script>        
    </body>
</html>
