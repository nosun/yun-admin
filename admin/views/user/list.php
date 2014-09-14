</head>
<body>
<div class="container">
<div class="detail-section">
    <div class="row">
        <form id="searchForm" class="form-horizontal">
        <div class="row">
            <div class="control-group span5">
                <div class="controls">
                    <select name="s_key">
                        <option value="">请选择查询方式</option>                    
                        <option value="user_name">按用户名</option>
                        <option value="province">按省份</option>
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
            <div class="span2 offset1">
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
        {title:'用户名',dataIndex:'user_name',width:100},
        {title:'注册时间',dataIndex:'user_regtime',width:150},
        {title:'省份',dataIndex:'province',width:100},
        {title:'城市',dataIndex:'city',width:100},
        {title:'手机',dataIndex:'user_phone',width:100},
        {title:'设备数量',dataIndex:'num',width:100},
        {title:'操作',dataIndex:'id',width:80,renderer:function(v){
            return Search.createLink({
            id : 'detail' + v,
            text : '查看详情',
            href : '<?php echo site_url() ?>/user/user_detail/'+ v
            });
            }},
        ],
      store = Search.createStore('../data/user_list',{
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