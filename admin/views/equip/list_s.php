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
    <div class="row">
            <div class="control-group span4">
                <div class="controls" >
                      <a href="" >今天</a> |
                      <a href="" >昨天</a> |
                      <a href="" >前天</a>                              
                </div>
            </div>
        <form id="searchForm" method="post" class="form-horizontal">
            <div class="control-group span8">
                <div class="controls">
                    <label class="control-label">选择时间：</label>
                    <input type="text" class="calendar" name="date" value="">
                </div>
            </div>
            <div class="span4 offset2">
                <button type="button" id="btnSearch" class="button button-primary">查询</button>
            </div>
        </form>
    </div>
    
    <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
        </div>
    </div>
</div>
   
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
  BUI.use('common/search',function (Search) {
    
    columns = [
        {title:'设备序列号',dataIndex:'device_sn',width:100},
        {title:'设备型号',dataIndex:'product_id',width:100},    
        {title:'设备MAC',dataIndex:'device_mac',width:150},
        {title:'所在省份',dataIndex:'province',width:100},
        {title:'所在城市',dataIndex:'city',width:100},        
        {title:'设备状态',dataIndex:'device_online',width:80}, 
        {title:'设备运转',dataIndex:'device_work',width:80},
         {title:'启用时间',dataIndex:'active_time',width:80},       
        {title:'运行时长',dataIndex:'work_time',width:80}   
        ],
      store = Search.createStore('../data/eq_list',{
        proxy : {
          method : 'POST'
        },
        pageSize:15
      }),
      gridCfg = Search.createGridCfg(columns,{
        plugins : [] // 插件形式引入多选表格
      });

    var  search = new Search({
        store : store,
        gridCfg : gridCfg
      }),
      grid = search.get('grid');

  });
</script>

<body>
</html>  