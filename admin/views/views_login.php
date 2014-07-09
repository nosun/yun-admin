<!DOCTYPE HTML>
<html>
 <head>
  <title>思佳维云平台——管理中心</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="<?php echo base_url() ?>assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/css/main.css" rel="stylesheet" type="text/css" />
 </head>
<body id="login">
	<div class="container">
		<div id="header">
			<div class="logo">
				<img src="" />
			</div>
		</div>
		<div id="wrapper" class="clearfix">
			<div class="login_box">
				<div class="login_title">管理登录</div>
				<div class="login_cont">
					<b style="color:red"></b>
                   
						<table class="form_table">
							<col width="90px" />
							<col />
							<tr>
								<th>用户名：</th><td><input autocomplete="off" class="normal" type="text" name="username" alt="请填写用户名" /></td>
							</tr>
							<tr>
								<th>密码：</th><td><input class="normal" type="password" name="password" alt="请填写密码" /></td>
							</tr>
							<tr>
								<th></th><td><input class="submit" type="submit" value="登录" /><input class="submit" type="reset" value="取消" /></td>
							</tr>
						</table>
					
				</div>
			</div>
		</div>
		<div id="footer">
        </div>
	</div>
</body>
</html>
