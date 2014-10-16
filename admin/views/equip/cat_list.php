<!DOCTYPE HTML>
<html>
<head>
<title>设备列表页</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/bui.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    <div class="search-grid-container">
      <div id="grid"></div>
    </div>
    <div id="content" class="hide">
      <form id="J_Form" class="form-horizontal" method="post" action="<?php echo site_url() ?>/equipment/eq_cat_update">
        <div class="row">
          <div class="control-group span8">
            <label class="control-label"><s>*</s>设备型号</label>
            <div class="controls">
              <input name="model" type="text" data-rules="{required:true}" class="input-normal control-text">
            </div>
          </div>
          <div class="control-group span8">
            <label class="control-label"><s>*</s>设备名称</label>
            <div class="controls">
              <input name="name" type="text" data-rules="{required:true}" class="input-normal control-text">
            </div>
          </div>

          <div class="control-group span8">
            <label class="control-label"><s>*</s>上市时间</label>
            <div class="controls">
              <input name="show_time" type="text" data-rules="{required:true}" class="calendar">
            </div>
          </div>
        </div>        
        <div class="row">
          <div class="control-group span24">
            <label class="control-label">设备详情</label>
            <div class="controls control-row4">
                <textarea name="info" class="input-large" type="text" cols="60"></textarea>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?php  $this->load->view('common/js'); ?>
  <script type="text/javascript">
    BUI.use('common/page');
  </script>
<script type="text/javascript">
  BUI.use('common/search',function (Search) {
    
      editing = new BUI.Grid.Plugins.DialogEditing({
        contentId : 'content', //设置隐藏的Dialog内容
        autoSave : true, //添加数据或者修改数据时，自动保存
        triggerCls : 'btn-edit'
      }),
      columns = [
          {title:'id',dataIndex:'id',width:80,visible:true},
          {title:'型号',dataIndex:'model',width:100},
          {title:'名称',dataIndex:'name',width:100},
          {title:'上市时间',dataIndex:'show_time',width:100,renderer:BUI.Grid.Format.dateRenderer},
          {title:'介绍',dataIndex:'info',width:400},
          {title:'操作',dataIndex:'',width:100,renderer : function(value,obj){
            var editStr1 = '<span class="grid-command btn-edit" title="编辑">编辑</span>',
                delStr = '<span class="grid-command btn-del" title="删除">删除</span>';
            return editStr1 + delStr;
          }}
        ],
      store = Search.createStore('../data/eq_cat',{
      //sortInfo : {
      //      field : 'id',
      //      direction : 'ASC'
      //      },
        proxy : {
          save : { //也可以是一个字符串，那么增删改，都会往那个路径提交数据，同时附加参数saveType
            addUrl : './eq_cat_insert',
            updateUrl : './eq_cat_update',
            removeUrl : './eq_cat_delete'
          },
          method : 'POST'
        },
        autoSync : true, //保存数据后，自动更新
        pageSize:12
      }),
      gridCfg = Search.createGridCfg(columns,{
        tbar : {
          items : [
            {text : '<i class="icon-plus"></i>新建',btnCls : 'button button-small',handler:addFunction},
            {text : '<i class="icon-remove"></i>删除',btnCls : 'button button-small',handler : delFunction}
          ]
        },
        plugins : [editing,BUI.Grid.Plugins.CheckSelection,BUI.Grid.Plugins.AutoFit] // 插件形式引入多选表格
      });

    var  search = new Search({
        store : store,
        gridCfg : gridCfg
      }),
      grid = search.get('grid');

    function addFunction(){
      var newData = {isNew : true}; //标志是新增加的记录
      editing.add(newData,'model'); //添加记录后，直接编辑
    }

    //删除操作
    function delFunction(){
      var selections = grid.getSelection();
      delItems(selections);
    }

    function delItems(items){
      var ids = [];
        BUI.each(items,function(item){
            ids.push(item.id);
        });

      if(ids.length){
        BUI.Message.Confirm('确认要删除选中的记录么？',function(){
          store.save('remove',{ids : ids});
          store.remove(items);
        },'question');
       
      }
    }

    //监听事件，删除一条记录
    grid.on('cellclick',function(ev){
      var sender = $(ev.domTarget); //点击的Dom
      if(sender.hasClass('btn-del')){
        var record = ev.record;
        delItems([record]);
      }
    });
  });
</script>
<body>
</html>  