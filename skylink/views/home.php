<?php include_once 'header.php'; ?>
<div class="container mainbox">
    <p class="row" id='path'><a href="#">首页</a> &gt; <a href="/account/">用户中心</a> &gt; 在线反馈</p>
    <div class="row" id='panelbox'>
        <section class='col-sm-2' id='u_menu'>
            <nav class="fl mye_nav">
                <h5 class="mye_nav_head">
                    <a href="/account/"><img class="header_icon" src="<? echo base_url() ?>/assets/images/noavatar.png"></a>
                    <p class="tc f14 msg_username">
                        <a title="新年" href="/account/" style="opacity: 1;">新年</a>
                    </p>
                </h5>
                <ul class="mye_nav_lists" style="position: static; top: 10px;">
                    <li>
                        <a class="mye_icon iaManage " id="device_li" href="/device/">我的设备</a>
                    </li>
                    <li>
                        <a class="mye_icon msgManage " href="/check/">设备自检</a>
                    </li>
                    <li>
                        <a class="mye_icon  myApp " href="/account/energy/">节能管理</a>
                    </li>
                </ul>
            </nav>
        </section>
        <section class='col-sm-10' id='u_content'>
            <h3 id="u_title"><i class="account_icon"></i>个人中心</h3>
            <div id="u_box">
                <form class="form-horizontal" role="form" method="post" id='J_Form'  action="feedback/doPost">
                   <input type="hidden" name='user_name' id="user_name" value='1'>
                  <div class="form-group">
                    <label for="product" class="col-sm-2 control-label">产品类别</label>
                      <div class="col-sm-3">
                            <select name="product" class="form-control">
                                <option value="0">请选择所有类别</option>                    
                                <option value="1">产品一</option>
                                <option value="2">产品二</option>  
                            </select>
                        </div>
                  </div>                    
                  <div class="form-group">
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
                      <input type="text" name='title' class="form-control" id="title" data-rules="{maxlength:5}"  placeholder="请输入内容">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="content" class="col-sm-2 control-label">内容</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name='content'  data-rules="{maxlength:100}"  rows="12"></textarea>
                    </div>
                    
                  </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">验证码：</label>
                    <div class="col-sm-3">
                        <input id="captcha" class="form-control" name="captcha" type="text" class="input-middle" data-rules="{required : true}">
                    </div>
                    <div class="col-sm-2">
                    <a href="#" onclick="document.getElementById('captcha_img').src = '<?php echo site_url('feedback/securimage') ?>/' + Math.random(); return false">
                        <img id="captcha_img" class="col-sm-offset-2" style="cursor:pointer" src="<?php echo site_url('feedback/securimage') ?>" alt="验证码" />
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
<script src="<? echo base_url() ?>assets/js/bui-min.js"></script>
<script src="<? echo base_url() ?>assets/js/config.js" data="true"></script>
<script type="text/javascript">
    BUI.use('bui/form',function(Form){
        new Form.Form({
        srcNode : '#J_Form'
        }).render();
    });
</script>
<?php include_once 'footer.php'; ?>
</body>
</html>
