<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>Skywar云平台欢迎您</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url() ?>assets/bs33/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/bs33/css/bootstrapValidator.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/yun.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>assets/bs33/js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bs33/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bs33/js/bootstrapValidator.min.js"></script>
</head>
<body>    
    <nav id="header" class="navbar-default navbar-fixed-top">
        <div class="container">
            <div id="logo" class="navbar-brand"><strong>Skyware</strong> 云平台 </div>
            <div class="navbar-right navbar-text">
                <a href="#" class="navbar-link">官网</a>
                <a href="#" class="navbar-link">注册</a>
            </div>
        </div>
    </nav>
    <div class="container">
        <div id='content' class='row row-offcanvas row-offcanvas-right'>
            <div class='col-xs-12 col-sm-7'>
                  <div id="cloud_img">
                      <img src="<?php echo base_url() ?>assets/images/cloud.jpg" />
                  </div>
            </div>
            <div id='sidebar' class='col-xs-6 col-sm-5 sidebar-offcanvas'>
                <div class="loginbox">
                    <h3 style="font-weight:bold;">登录云平台</h3>
                    <?php echo $this->message->display(); ?>                    
                    <form class="form-horizontal" role="form" id="login_form" method="post" action="<?php echo site_url('login/check_login')?>">
                      <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">用户名</label>
                        <div class="col-sm-6">
                          <input type="username" name='user_name' class="form-control" id="username" placeholder="用户名">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">密码</label>
                        <div class="col-sm-6">
                          <input type="password" name='login_pwd' class="form-control" id="password" placeholder="密码">
                        </div>
                      </div>
                    <div class="form-group">
                        <label for='captcha' class="col-sm-3 control-label">验证码</label>
                        <div class="col-sm-6">
                            <input id="captcha" class="form-control" name="captcha" type="text" class="input-middle" data-rules="{required : true}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <a href="#" onclick="document.getElementById('captcha_img').src = '<?php echo site_url('login/securimage') ?>/' + Math.random(); return false">
                                <img id="captcha_img"  style="cursor:pointer" src="<?php echo site_url('login/securimage') ?>" alt="验证码" />
                            </a>
                        </div>
                    </div>
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                          <button type="submit" class="btn btn-primary btn-block">登录</button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
          </div>
    </div>

<script>
$(document).ready(function() {
    $('#login_form').bootstrapValidator({
        message: '您的输入不合法,请重试',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            user_name: {
                message: '您的用户名输入错误,请重试!',
                validators: {
                    notEmpty: {
                        message: '用户名不能为空!'
                    },
                    stringLength: {
                        max: 30,
                        message: '您的输入必须在6-30个字符之间!'
                    }
                }
            },
            login_pwd: {
                validators: {
                    notEmpty: {
                        message: '密码不能为空!'
                    },
                    stringLength: {
                        max: 20,
                        message: '您的密码输入太长了吧~ 请重试!'
                    }
                }
            },
            captcha: {
                validators: {
                    notEmpty: {
                        message: '验证码不能为空!'
                    },
                    remote: {
                        message: '您输入的验证码不正确！',
                        type:'post',
                        url: '<?php echo site_url("login/check_captcha")?>',
                    }
                }
            }            
        }
    });
    $("#error_msg").fadeIn(150).fadeOut(10000);
});
</script>
    <div class="footer">
      <div class="container">
        <p class="text-muted">北京思佳维科技有限公司 Copyright (c) 2014-2016</p>
      </div>
    </div>
</body>
</html>