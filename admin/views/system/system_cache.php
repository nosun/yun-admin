<?php require_once APPPATH.'views/common/header.php';?>
</head>
<body id="setting">
    <div class="container">
            <h2><?php echo $title?></h2>
            <div class="row">
                
            <a href="<?php echo site_url("dcache/equip_cat") ?>" title="刷新缓存">产品</a>
            <a href="<?php echo site_url("dcache/feedback_cat") ?>" title="刷新缓存">反馈类别</a>
                
            </div>
    </div>
    
<?php require_once APPPATH.'views/common/footer.php';?>
