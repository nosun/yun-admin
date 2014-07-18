<!DOCTYPE HTML>
<html>
 <head>
  <title>站点设置页</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />   <!-- 下面的样式，仅是为了显示代码，而不应该在项目中使用-->
   <link href="<?php echo base_url() ?>/views/assets/css/prettify.css" rel="stylesheet" type="text/css" />
 </head>
 <body id="passwd">
    <div class="container">
        <div id="change_pwd">
                <h2>修改密码</h2>
                <div class="login_cont">
                    <form id="J_Form" action="<?php echo site_url()?>/system/change_passwd" class="form-horizontal" method="post" accept-charset="utf-8"> 
                        <div class="control-group">
                          <label class="control-label">旧密码：</label>
                          <div class="controls">
                            <input id="old_pass" name="old_pass" type="password" class="input-middle" data-rules="{required : true}">
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label">新密码：</label>
                          <div class="controls">
                              <input id="new_pass" name="new_pass" type="password" class="input-middle" data-rules="{required : true}">
                          </div>
                        </div>
                        <div class="control-group">
                          <label class="control-label">确认新密码：</label>
                          <div class="controls">
                              <input id="new_pass2" name="new_pass2" type="password" class="input-middle" data-rules="{equalTo:'#new_pass'}">
                          </div>
                        </div>
                        
                        <div class="control-group">       
                           <button type="submit" class="button button-warning">保 存</button>
                        </div> 
                    </form>
                </div>
            </div>
    </div>
    
    <script src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
    <script src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
    
   <!-- script start-->  
   <script type="text/javascript">
      BUI.use('bui/form',function  (Form) {
        new Form.Form({
          srcNode : '#J_Form'
        }).render();
      });
    </script>
    <!-- script end -->

 </body>
</html>  