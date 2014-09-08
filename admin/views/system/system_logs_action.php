</head>
<body id="setting">
    <div class="container">
        <div class="detail-section">
            <h2><?php echo $title;?></h2>
                <div class="row">
                    <form id="searchForm" class="form-horizontal">
                    <div class="row">
                        <div class="control-group span5">
                            <div class="controls">
                                <select name="s_key">
                                    <option value="">请选择查询方式</option>                    
                                    <option value="username">按用户名</option>
                                    <option value="table">按操作</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group span5">
                            <div class="controls">
                                <input type="text" class="control-text" name="s_value" placeholder="请输入关键字" value="">
                            </div>
                        </div>
                        <div class="control-group span10">
                            <div class="controls">
                                <label class="control-label">注册时间时间：</label>
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
    
      editing = new BUI.Grid.Plugins.DialogEditing({
        triggerCls : 'btn-view'
      }),
    columns = [
        {title:'ID',dataIndex:'id',width:50},
        {title:'用户名',dataIndex:'username',width:100},
        {title:'操作模块',dataIndex:'table',width:100},
        {title:'操作内容',dataIndex:'detail',width:300},        
        {title:'IP地址',dataIndex:'ip',width:100},
        {title:'操作时间',dataIndex:'time',width:150},        
        ],
      store = Search.createStore('../data/logs_action',{
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