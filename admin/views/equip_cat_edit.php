<!DOCTYPE HTML>
<html>
<head>
<title>设备列表页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
  <div id="content">
      <form id="J_Form" class="form-horizontal" method="post" action="<?php echo site_url() ?>/equipments/eq_cat_update">
          
         <input name="id" type="hidden" value="1">
        <div class="row">
          <div class="control-group span8">
            <label class="control-label"><s>*</s>设备型号</label>
            <div class="controls">
              <input name="model" type="text" data-rules="{required:true}" class="input-normal control-text">
            </div>
          </div>
          <div class="control-group span8">
            <label class="control-label"><s>*</s>设备名称</label>
            <div class="controls">
              <input name="name" type="text" data-rules="{required:true}" class="input-normal control-text">
            </div>
          </div>

          <div class="control-group span8">
            <label class="control-label"><s>*</s>上市时间</label>
            <div class="controls">
              <input name="show_time" type="text" data-rules="{required:true}" class="calendar">
            </div>
          </div>
        </div>        
        <div class="row">
          <div class="control-group span24">
            <label class="control-label">设备详情</label>
            <div class="controls control-row4">
                <textarea name="info" class="input-large" type="text" cols="60"></textarea>
            </div>
          </div>
        </div>
        <div class="row form-actions">
            <div class="span13 offset3 ">
              <button class="button button-primary" type="submit">保存</button>
              <button class="button" type="reset">重置</button>
            </div>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
    <script type="text/javascript">
        BUI.use('common/page');
    </script>
    <script type="text/javascript">
    BUI.use('bui/calendar',function(Calendar){
    var datepicker = new Calendar.DatePicker({
    trigger:'.calendar',
    autoRender : true
    });
    });
    </script>
  
<body>
</html>  