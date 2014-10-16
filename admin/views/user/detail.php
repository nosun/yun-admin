</head>
<body>
<div class="container">
    <div class="detail-page">
      <div class="detail-section">  
        <h3>基本信息</h3>
        <hr>
        <div class="row detail-row">
          <div class="span8">
            <label>用户名：</label><span class="detail-text"><?php echo $user['user_name']?></span>
          </div>
          <div class="span8">
            <label>电话号码：</label><span class="detail-text"><?php echo $user['user_phone']?></span>
          </div>
           <div class="span8">
            <label>电子邮箱：</label><span class="detail-text"><?php echo $user['user_email']?></span>
          </div>
        </div>
        <div class="row detail-row">
          <div class="span8">
            <label>所在省份：</label><span class="detail-text"><?php echo $user['province']?></span>
          </div>
           <div class="span8">
            <label>城市：</label><span class="detail-text"><?php echo $user['city']?></span>
          </div>
          <div class="span8">
            <label>注册时间：</label><span class="detail-text"><?php echo date('Y-m-d',$user['user_regtime'])?></span>
          </div>            
        </div>
      </div>
        <hr>
      <div class="detail-section"> 
        <h3>设备情况</h3>

        <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
            </div>
        </div>
       </div>
    </div>        
</div>        
   
    <?php  $this->load->view('common/js'); ?>
<script type="text/javascript">
    BUI.use('common/page');
</script>
<script type="text/javascript">
  BUI.use('common/search',function (Search) {
    
      editing = new BUI.Grid.Plugins.DialogEditing({
        triggerCls : 'btn-edit'
      }),
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
      store = Search.createStore('../../data/user_eq_list/<?=$user['id']?>',{
        proxy : {
          method : 'POST'
        },
        pageSize:10,
      }),
      gridCfg = Search.createGridCfg(columns,{
        plugins : [editing,BUI.Grid.Plugins.AutoFit] // 插件形式引入多选表格
      });

    var  search = new Search({
        store : store,
        gridCfg : gridCfg
      }),
      grid = search.get('grid');

  });
</script>