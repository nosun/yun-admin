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
    <?php
        echo "cating";
    ?>
   
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
 <script type="text/javascript">
    BUI.use('bui/calendar',function(Calendar){
    var datepicker = new Calendar.DatePicker({
    trigger:'.calendar',
    autoRender : true
    });
    });
</script>
<script type="text/javascript">
    BUI.use('common/page');
</script>

<script type="text/javascript">
    BUI.use('bui/grid',function (Grid) {
    var data = <?php echo $json_eq;?>,
    grid = new Grid.SimpleGrid({
    render : '#grid', //显示Grid到此处
    width : 950, //设置宽度
    columns : [
    {title:'设备序列号',dataIndex:'device_sn',width:100},
    {title:'设备型号',dataIndex:'device_cat',width:100},    
    {title:'设备MAC',dataIndex:'device_mac',width:100},
    {title:'所在地区',dataIndex:'device_location',width:100},
    {title:'设备状态',dataIndex:'device_desc1',width:100},    
    {title:'运行时长',dataIndex:'device_desc2',width:100}   
    ]
    });
    grid.render();
    grid.showData(data);
    });
</script>
<body>
</html>  