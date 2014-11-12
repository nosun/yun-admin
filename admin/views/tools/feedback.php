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
                        <?php foreach($equip_cat as $key=>$value){
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }?>
                    </select>
                </div>
            </div>
            <div class="control-group span8">
                <label class="control-label">问题分类</label>                
                <div class="controls">
                    <select name="category">
                        <option value="0">所有类别</option>
                        <?php foreach($feedback_cat as $key=>$value){
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }?>
                    </select>
                </div>
            </div>
            <div class="control-group span8">
                <label class="control-label">问题状态</label>                
                <div class="controls">
                    <select name="status">
                        <option value="0">所有问题</option>
                        <?php foreach($feedback_status as $key=>$value){
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }?>
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
        {title:'id',dataIndex:'id',width:100},
        {title:'用户',dataIndex:'user_name',width:100},
        {title:'产品',dataIndex:'product',width:100},
        {title:'标题',dataIndex:'title',width:300,renderer:function(value,obj){
            return '<a href="'+ '<?php echo site_url('feedback/show')?>/' + obj.id +'" ' +
                'title="查看内容" class="show_fb" >' + value +'</a>';
        }},
        {title:'时间',dataIndex:'addtime',width:100},
        {title:'分类',dataIndex:'category',width:100},
        {title:'状态',dataIndex:'status',width:100}
        ],
      store = Search.createStore('../data/feedback',{
        proxy : {
          method : 'POST'
        },
        pageSize:15
      }),
      gridCfg = Search.createGridCfg(columns,{
        plugins : [], // 插件形式引入多选表格
        forceFit: true
      });

    var  search = new Search({
        store : store,
        gridCfg : gridCfg
      }),
      grid = search.get('grid');

  });
</script>