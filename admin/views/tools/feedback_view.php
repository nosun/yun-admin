<?php $this->load->view('common/header');?>
    <link rel="stylesheet" type="text/css" href="<?php echo YUN_URL ?>assets/bs33/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo YUN_URL ?>assets/css/yun.css" />
<body>

<div class="container">
    <div class="detail-section">
            <div class="row" id='panelbox'>
                <section class='col-sm-10' id='u_content'>
                    <div id="u_title">
                        <h3 class="left"><i class="account_icon"></i><?php echo $title ?></h3>
                <span class="right">
                    <a class="btn btn-danger" href="<?php echo site_url('user/feedback') ?>" id="cancel-worker">关闭工单</a>
                    <a class="btn btn-primary" href="<?php echo site_url('user/feedback') ?>" target="_self">返回列表</a>
                </span>
                    </div>
                    <div class="u_box" id="fbview">
                        <div class="record-bd">
                            <div class="question-title cc">
                                <p class='fb-title'>问题标题：<?php echo $fb_main['title'] ?></p>
                            </div>
                            <div class="question-status">
                                <span class="fb-id">工单编号： <?php echo $fb_main['id'] ?> </span>
                                <span class="fb-status">状态： <?php echo $fb_main['status'] ?></span>
                                <span class="fb-category">问题类型： <?php echo $fb_main['category'] ?> </span>
                                <span class="fb-product">产品型号： <?php echo $fb_main['product'] ?></span>
                                <span class="fb-time">提交时间：<?php echo date('Y-m-d h:i:s', $fb_main['addtime']) ?></span>
                            </div>
                        </div>

                        <div class="module-wrap">
                            <h3 class="section-title">沟通记录</h3>
                            <div class="bordersection mb20">
                                <ul class="bubble-wrap">
                                    <li>
                                        <div class="bubble-main left  ">
                                            <p style="color:#444;white-space:pre-wrap" class="bubble-content">问题描述 ： <?php echo $fb_main['content'] ?></p>
                                            <div class="arrow-left"></div>
                                        </div>
                                        <span class="tips left-floating"><?php echo date('Y-m-d h:i:s', $fb_main['addtime']) ?></span>
                                    </li>

                                    <?php foreach($fb_reply as $row){
                                        $float=($row['role']==1)?'left':'right';
                                        ?>
                                        <li>
                                            <div class="bubble-main <?php echo $float?>  ">
                                                <p style="color:#444;white-space:pre-wrap" class="bubble-content"><?php echo $row['content'] ?></p>
                                                <div class="arrow-left"></div>
                                            </div>
                                            <span class="tips left-floating"><?php echo date('Y-m-d h:i:s', $row['addtime']) ?></span>
                                        </li>

                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <div class="workorder-comment-block">
                            <h2 class="section-title">留言/反馈</h2>
                            <form method="post" id="J_Form" class='form-horizontal bv-form' action="<?php echo site_url('feedback/reply/'.$fb_main['id'])?>">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="content"  rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary btn-block ">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/bs33/js/bootstrapValidator.min.js"></script>
</div>

<?php $this->load->view('common/footer');?>