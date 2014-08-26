</head>
<body id="setting">
    <div class="container">
        <div>
            <h2>站点设置</h2>
            <div class="login_cont">
                <form id="J_Form" action="<?php echo site_url()?>/system/change_site_settings" class="form-horizontal" method="post" accept-charset="utf-8"> 
                    <div class="control-group">
                        <label class="control-label">站点名称：</label>
                        <div class="controls"><input class="input-large control-text" type="text" name="site_name" value="<?php echo $settings->site_name; ?>"></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">网店链接：</label>
                        <div class="controls"><input class="input-large control-text" type="text" name="shop_url" value="<?php echo $settings->shop_url; ?>" /></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">后台登录认证码：</label>
                        <div class="controls"><input class="input-large control-text" type="text" name="auth_code" value="<?php echo $settings->auth_code; ?>"/></div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">不开启操作时间点：</label>
                        <div class="controls" id="mtime_select">
                            <div class="oneline">
                            <?php $not_oper_time = json_decode($settings->not_oper_time);?>
                            <?php for($i=0; $i<24; $i++):?>
                                <?php if($i>1 && $i%8==0){?>
                                        </div><div class="oneline">
                               <?php } ?>
                                 <label class="checkbox"><input type='checkbox' class='normal' name="not_oper_time[]" <?php echo in_array($i, $not_oper_time) ? "value='{$i}' checked='checked'" :"value='{$i}'"; ?> autocomplete="off" /><span class="choise"><?php echo $i;?>点</span></label>
                            <?php endfor;?>
                                </div>
                        </div>
                    </div>
                    <!--<div class="control-group">
                        <label class="control-label">记录登陆日志：</label>
                        <input type="radio" name="keep_login_log" value="1" <?php echo $settings->keep_login_log ? 'checked="checked"' :''; ?>  />开启
                        <input type="radio" name="keep_login_log" value="0" <?php echo !$settings->keep_login_log ? 'checked="checked"' :''; ?> />关闭
                    </div>
                    <div class="control-group">
                        <label class="control-label">记录操作日志：</label>
                        <input type="radio" name="keep_oper_log" value="1" <?php echo $settings->keep_oper_log ? 'checked="checked"' :''; ?>  />开启
                        <input type="radio" name="keep_oper_log" value="0" <?php echo !$settings->keep_oper_log ? 'checked="checked"' :''; ?> />关闭
                    </div>
                    -->
                    <div class="row offset2">
                        <button type="submit" class="button button-primary">保存后台设置</button>
                        <button type="reset" class="button">重 置</button>
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

