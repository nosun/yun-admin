<?php include_once 'header.php'; ?>
<div class="container mainbox">
    <p class="row" id='path'><a href="#">首页</a> &gt; <a href="/account/">用户中心</a> &gt; 在线反馈</p>
    <div class="row" id='panelbox'>
        <section class='col-sm-2' id='u_menu'>
            <?php include_once 'uleft.php'; ?>
        </section>
        <section class='col-sm-10' id='u_content'>
            <div id="u_title">
                <h3 class="left"><i class="account_icon"></i><?php echo $title ?></h3>
                <span class="right">
                    <a class="btn btn-primary" href="<?php echo site_url('user/feedback_add') ?>" target="_self">增加反馈</a>
                </span>    
            </div>
            <div class="u_box">
                <form class="form-horizontal" role="form" method="post" id='J_Form'  action="<?php echo site_url('user/add_feedback') ?>">
                   <input type="hidden" name='user_name' id="user_name" value='1'>
                  <div class="form-group" id="product_div">
                    <label for="product" class="col-sm-2 control-label">产品类别</label>
                      <div class="col-sm-3">
                            <select name="product" class="form-control">
                                <option value="0">请选择所有类别</option>                    
                                <option value="1">产品一</option>
                                <option value="2">产品二</option>  
                            </select>
                        </div>
                  </div>                    
                  <div class="form-group" id="category_div">
                    <label for="category" class="col-sm-2 control-label">问题类别</label>
                      <div class="col-sm-3">
                            <select name="category" class="form-control">
                                <option value="0">所有类别</option>                    
                                <option value="1">质量问题</option>
                                <option value="2">使用疑难</option>  
                                <option value="3">业务投诉</option>  
                                <option value="4">产品建议</option>  
                                <option value="5">业务咨询</option>  
                            </select>
                        </div>
                  </div>
                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">标题</label>
                    <div class="col-sm-3">
                      <input type="text" name='title' class="form-control" id="title" placeholder="请输入内容">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">内容</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name='content'  rows="12"></textarea>
                    </div>
                    
                  </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">验证码：</label>
                    <div class="col-sm-3">
                        <input id="captcha" class="form-control" name="captcha" type="text" class="input-middle" data-rules="{required : true}">
                    </div>
                    <div class="col-sm-2">
                    <a href="#" onclick="document.getElementById('captcha_img').src = '<?php echo site_url('login/securimage') ?>/' + Math.random(); return false">
                        <img id="captcha_img" class="col-sm-offset-2" style="cursor:pointer" src="<?php echo site_url('login/securimage') ?>" alt="验证码" />
                    </a>
                    </div>
                </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                      <button type="submit" class="btn btn-primary btn-block ">提交</button>
                    </div>
                  </div>
                </form>
            </div>
        </section>
    </div>
</div>
<script src="<?php echo base_url() ?>assets/bs33/js/bootstrapValidator.min.js"></script>
<script>
$(document).ready(function() {
    $("select[name=product]").change(function(){
        $("#product_div").addClass("has-success");
    });
    $("select[name=category]").change(function(){
        $("#category_div").addClass("has-success");
    });    
    $('#J_Form').bootstrapValidator({
        message: '您的输入不合法,请重试',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                message: '您的用户名输入错误,请重试!',
                validators: {
                    notEmpty: {
                        message: '标题不能为空!'
                    },
                    stringLength: {
                        max: 50,
                        message: '您的输入必须在50个字符以内!'
                    }
                }
            },
            content: {
                validators: {
                    notEmpty: {
                        message: '内容不能为空!'
                    },
                    stringLength: {
                        max: 1000,
                        message: '您的内容输入太长了吧~ 请重试!'
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
});
</script>
<?php include_once 'footer.php'; ?>
</body>
</html>
