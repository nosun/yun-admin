<?php  $this->load->view('common/header'); ?>
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
</head>
<body>
<?= @flash_message() ?>
    <div class="container">
        <h1><?php echo $roles['name'] ?>的权限设置</h1>
        <?php echo validation_errors(); ?>
        <form action="<?php echo base_url().'roles/set_rights/'.$id ?>" method="post">
            <?php 
            foreach ($powers as $p): ?>
                <p><input name="models[]" type="checkbox" value="<?php echo $p['id'] ?>"
                    <?php
                    $id = strval($p['id']);
                    if ($models[$id] == 1) {
                        echo 'checked="checked"';
                    }
                    ?> /><?php echo $p['name']?></p>
                <?php endforeach ?>
            <input name="action" value="ok" type="hidden"/>
            <input type="submit" value="提交"/>
        </form>
    </div>
<?php  $this->load->view('common/footer'); ?>    
    