</head>
<body>
<div class="container">
<div class="detail-section">
    <div id="searchBox">
        <style>
            #searchBox{   background: none repeat scroll 0 0 #f4f4f4;
            padding-top:20px;margin-bottom:20px;width:950px;
            }
        </style>
        <form id="searchForm" method="post" class="form-horizontal">
        <input type="hidden" name="a" value="3">
        <div class="row">
            <div class="control-group span8">
                <label class="control-label">产品选择</label>
                <div class="controls" >
                    <select name="product" id="product_id" selected="">
                        <option value="0">所有型号</option>
                        <option value="skyware001">skyware001</option>
                    </select>
                </div>
            </div>
            <div class="control-group span8">
                <label class="control-label">消息类别</label>                
                <div class="controls">
                    <select name="category">
                        <option value="0">所有类别</option>                    
                        <option value="1">系统消息</option>
                        <option value="2">服务消息</option>  
                    </select>
                </div>
            </div>
            <div class="control-group span8">
                <label class="control-label">消息状态</label>                
                <div class="controls">
                    <select name="status">
                        <option value="0">所有状态</option>       
                        <option value="1">未发送</option>                         
                        <option value="2">已发送</option>  
                    </select>
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="control-group span10">
                <div class="controls">
                    <label class="control-label">起止时间：</label>
                    <input type="text" class="calendar" name="start_date" value=""> 
                    <input name="end_date" type="text" class="calendar" value="">
                </div>
            </div>
            <div class="span2 offset2">
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
    
    columns = [
        {title:'消息id',dataIndex:'id',width:60},
        {title:'消息类型',dataIndex:'type',width:100},    
        {title:'消息标题',dataIndex:'title',width:200},
        {title:'发送对象',dataIndex:'group',width:100}, 
        {title:'发送数量',dataIndex:'num_send',width:80}, 
        {title:'送达数量',dataIndex:'num_reach',width:80},
        {title:'发送时间',dataIndex:'sendtime',width:100},
        {title:'发送状态',dataIndex:'status',width:80},
        {title:'操作',dataIndex:'',width:80,renderer : function(value,obj){
          var viewStr = '<span class="grid-command btn-view" title="查看">查看</span>';
          return viewStr;
        }}
        ],
      store = Search.createStore('../data/notice',{
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