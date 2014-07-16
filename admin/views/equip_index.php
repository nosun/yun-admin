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
    $json_eq= json_encode($eqlist);
    //var_dump($json_eq);

    ?>
<div class="detail-section">
    <form id="searchForm" method="get" class="form-horizontal" action="<?php echo site_url()?>/equipments/index">
    <div class="row">
        <div class="control-group span4">
            <div class="controls" >
                <select name="product_id" id="product_id">
                    <option value="0">选择产品类型</option>
                    <option value="1">产品一</option>
                    <option value="2">产品二</option>
                </select>
            </div>
        </div>
        <div class="control-group span4">
            <div class="controls">
                <select name="s_key">
                    <option value="device_location">按地区</option>
                    <option value="device_sn">按序列号</option>  
                    <option value="device_mac">按MAC</option>  
                </select>
            </div>
        </div>
        <div class="control-group span4">
            <div class="controls">
                <input type="text" class="control-text" name="s_value">
            </div>
        </div>

        <div class="control-group span9">
            <div class="controls">
                <label class="control-label">启用时间：</label>
                <input type="text" class="calendar" name="start_date"><span> - </span>
                <input name="start_date" type="text" class="calendar">
            </div>
        </div>
        <div class="span2 offset2">
            <button type="submit" id="btnSearch" class="button button-primary">查询</button>
        </div>
    </div>
</form>
    <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
        </div>
    </div>
</div>
    
<div class="pages_bar pagination"><?php echo $pagination; ?></div>  
    
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
    {title:'序列号',dataIndex:'device_sn',width:100},
    {title:'型号',dataIndex:'device_cat',width:100},    
    {title:'MAC',dataIndex:'device_mac',width:100},
    {title:'地区',dataIndex:'device_location',width:100},
    {title:'状态',dataIndex:'device_desc1',width:100},    
    {title:'累计时长',dataIndex:'device_desc2',width:100}   
    ]
    });
    grid.render();
    grid.showData(data);
    });
</script>
<body>
</html>  