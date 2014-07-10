<!DOCTYPE HTML>
<html>
 <head>
  <title>思佳维云平台——管理中心</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo base_url() ?>assets/css/bs3/dpl-min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/bs3/bui-min.css" rel="stylesheet">
   <link href="<?php echo base_url() ?>assets/css/main.css" rel="stylesheet" type="text/css" />
 </head>
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
				<div class="login_cont">
                                    <form id="J_Form" action="<?php echo site_url()?>/login/do_post" class="form-horizontal" method="post" accept-charset="utf-8">
                                    <input type="hidden" name="dilicms_csrf_token" value="" />
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
                                    <div class="control-group">
                                      <label class="control-label">认证码：</label>
                                      <div class="controls">
                                          <input name="admincode" type="password" class="input-middle" data-rules="{required : true}">
                                      </div>
                                    </div>       
                                    <div class="control-group">
                                      <label class="control-label">验证码：</label>
                                      <div class="controls">
                                          <input name="flashcode" type="text" class="input-middle" data-rules="{required : true}">
                                          <img id="imgage"  style="cursor:pointer"  title="点击更换验证码" alt="点击更换验证码" src="<?php echo site_url("login/code");?>" onclick="javascript:this.src='<?php echo site_url("login/code");?>?'+Math.random()">
                                      </div>
                                    </div>                                     
                                    <div class="control-group">       
                                        <div class="login_submit">
                                          <button name="" type="submit" class="button button-primary">登 录</button>
                                        </div>
                                    </div> 
                                    </form>
				</div>
			</div>
		</div>
                </div>
                <div id="footer">
                        <p> 2014-2016 北京思佳维科技有限公司 Copyright (c) </p>
                </div>
                

    <script src="<?php echo base_url() ?>assets/js/jquery-1.8.1.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bui-min.js"></script>
   
        <!-- script start-->  
            <script type="text/javascript">
              var Form = BUI.Form;
              new Form.Form({
                srcNode : '#J_Form'
              }).render();
        </script>
        <!-- script end -->

</body>
</html>
