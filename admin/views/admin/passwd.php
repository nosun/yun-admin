<?php  $this->load->view('common/header'); ?>
</head>
<script type="text/javascript" src="<?php echo base_url() ?>views/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        $("#flashmessage").animate({top: "20%"},1000).show('fast').fadeIn(100).fadeOut(50).fadeIn(50).fadeOut(50).fadeIn(50);
        $("#closemessage").click(function(){
            $("#flashmessage").hide();            
        });
    });
</script>

<style>
.message{   
    border:1px solid #CCCCCC;   
    width:300px;   
    border:1px solid #c93;   
    background:#ffc;   
    padding:5px;   
    color: #333333;   
    margin-bottom:10px;
    position: absolute;
    top:30%;
    left:30%;
    z-index: 10;
}  
    
</style>
<?= @flash_message() ?>
<body id="passwd">
    <div class="container">
        <div id="change_pwd">
                <h2><?php echo $title ?></h2>
                <div class="login_cont">
                    <form id="J_Form" action="<?php echo site_url()?>admin/change_passwd" class="form-horizontal" method="post" accept-charset="utf-8"> 
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
                        
                        <div class="control-group offset3">       
                           <button type="submit" class="button button-primary">保 存</button>
                           <button type="reset" class="button">重 置</button>
                        </div> 
                    </form>
                </div>
            </div>
    </div>
<?php  $this->load->view('common/footer'); ?>