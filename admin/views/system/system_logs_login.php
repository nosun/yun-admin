</head>
<body id="setting">
    <div class="container">
        <div class="detail-section">
            <h2><?php echo $title;?></h2>
                <div class="row">
                    <form id="searchForm" class="form-horizontal">
                    <div class="row">
                        <div class="control-group span8">
                            <div class="controls">
                                <label class="control-label">按用户名查询：</label>
                                    <input type="text" class="control-text" name="s_value" placeholder="请输入用户名" value="">
                            </div>
                        </div>                        
                        <div class="control-group span10">
                            <div class="controls">
                                <label class="control-label">注册时间：</label>
                                <input type="text" class="calendar" name="start_date" value=""><span> - </span>
                                <input name="end_date" type="text" class="calendar" value="">
                            </div>
                        </div>
                        <div class="span1 offset1">
                            <button type="submit" id="btnSearch" class="button button-primary">查询</button>
                        </div>
                    </div>
                    </form>
                </div>
    
    <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
        </div>
    </div>
</div>
   
    <?php  $this->load->view('common/js'); ?>
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
    
      editing = new BUI.Grid.Plugins.DialogEditing({
        triggerCls : 'btn-view'
      }),
    columns = [
        {title:'ID',dataIndex:'logid',width:180},
        {title:'用户名',dataIndex:'username',width:180},
        {title:'登录状态',dataIndex:'status',width:180},
        {title:'登录IP',dataIndex:'loginip',width:180},
        {title:'登录时间',dataIndex:'logintime',width:180},        
        ],
      store = Search.createStore('../data/logs_login',{
        proxy : {
          method : 'POST'
        },
        pageSize:15
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