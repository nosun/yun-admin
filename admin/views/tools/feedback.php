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
                <label class="control-label">产品筛选</label>
                <div class="controls" >
                    <select name="product" id="product_id" selected="">
                        <option value="0">所有型号</option>
                        <option value="skyware001">skyware001</option>
                    </select>
                </div>
            </div>
            <div class="control-group span8">
                <label class="control-label">问题分类</label>                
                <div class="controls">
                    <select name="category">
                        <option value="0">所有类别</option>                    
                        <option value="1">质量问题</option>
                        <option value="2">使用疑难</option>  
                        <option value="3">业务投诉</option>  
                        <option value="4">产品建议</option>  
                        <option value="5">业务咨询</option>  
                    </select>
                </div>
            </div>
            <div class="control-group span8">
                <label class="control-label">问题状态</label>                
                <div class="controls">
                    <select name="status">
                        <option value="0">所有问题</option>       
                        <option value="1">新开</option>                         
                        <option value="2">未解决</option>
                        <option value="3">处理中</option>  
                        <option value="4">已解决</option>  
                        <option value="5">不处理</option>   
                    </select>
                </div>
            </div>            
        </div>
        <div class="row">
            
            
            <div class="control-group span8">
                <label class="control-label">问题id</label>                   
                <div class="controls">
                    <input type="text" class="control-text" name="id" value="">
                </div>
            </div>

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
        {title:'反馈id',dataIndex:'id',width:60},
        {title:'设备型号',dataIndex:'product',width:100},    
        {title:'问题内容',dataIndex:'title',width:160},
        {title:'反馈时间',dataIndex:'content',width:300},
        {title:'问题分类',dataIndex:'category',width:80},        
        {title:'状态',dataIndex:'status',width:80}, 
        {title:'操作',dataIndex:'',width:160,renderer : function(value,obj){
          var viewStr = '<span class="grid-command btn-view" title="查看">查看</span>',
              replyStr = '<span class="grid-command btn-reply" title="回复">回复</span>',
              delStr = '<span class="grid-command btn-del" title="删除">删除</span>';
          return viewStr+replyStr + delStr;
        }}
        ],
      store = Search.createStore('../data/feedback',{
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