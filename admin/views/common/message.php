<?php
$this->load->view('common/header');
?>
</head>
<body> 
<div>

        <h2>提示信息</h2>

        <div align="center">
            <?php echo $this->message->display(); ?>
        </div>
        <a href="javascript:history.go(-1);">返回</a>
<?php
    $this->load->view('common/footer');
?>


 			