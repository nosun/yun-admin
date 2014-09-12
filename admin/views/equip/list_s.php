</head>
<body>
<div class="container">
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
    BUI.use('common/page');
</script>
<script type="text/javascript">
  BUI.use('common/search',function (Search) {
    
    columns = [
        {title:'设备序列号',dataIndex:'device_sn',width:120},
        {title:'设备型号',dataIndex:'product_id',width:120},    
        {title:'所在省份',dataIndex:'province',width:100},
        {title:'所在城市',dataIndex:'city',width:100},        
        {title:'在线状态',dataIndex:'device_online',width:80}, 
        {title:'运转状态',dataIndex:'device_work',width:80},
        {title:'报警状态',dataIndex:'device_alarm',width:80},
        {title:'运转时长',dataIndex:'work_time',width:100},
        {title:'滤网状态',dataIndex:'filter_time',width:100}
        ],
      store = Search.createStore('<?=$dataurl?>',{
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