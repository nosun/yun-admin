<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//var_dump($admins);
?>
</head>
<body>
    <div class="container">

        <div class="search-grid-container">
            <div id="grid"></div>
        </div>
        <div id="content" class="hide">
            <form id="J_Form" class="form-horizontal" method="post" action="<?php echo $link_url ?>create">
                <input type="hidden" name="a" value="3">
                <div class="row">
                    <div class="control-group span8">
                        <label class="control-label"><s>*</s>角色名</label>
                        <div class="controls">
                            <input name="name" type="text" data-rules="{required:true}" class="input-normal control-text">
                            <input name="id" type="hidden" class="input-normal control-text">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>

    <script type="text/javascript">
        BUI.use('common/page');
    </script>
    <script type="text/javascript">
        BUI.use(['common/search'],function (Search) {
           
            editing = new BUI.Grid.Plugins.DialogEditing({
                contentId : 'content', //设置隐藏的Dialog内容
                autoSave : true, //添加数据或者修改数据时，自动保存
                triggerCls : 'btn-edit'
            }),
            columns = [
                {title:'ID',dataIndex:'id',width:80,visible:true},
                {title:'角色名',dataIndex:'name',width:150},
                {title:'操作',dataIndex:'',width:200,renderer : function(value,obj){
                        var editStr =  Search.createLink({ //链接使用 此方式
                            id : 'edit' + obj.id,
                            title : '设置权限',
                            text : '设置权限',
                            href : '<?php echo $link_url?>power/'+obj.id
                        }),
                        editStr1 = '<span class="grid-command btn-edit" title="编辑">编辑</span>',
                        delStr = '<span class="grid-command btn-del" title="删除">删除</span>';
                        return editStr + editStr1 + delStr;
                    }
                }
            ],
            store = Search.createStore('roles_data',{      
                proxy : {
                    save : { //也可以是一个字符串，那么增删改，都会往那个路径提交数据，同时附加参数saveType
                        addUrl : './create',
                        updateUrl : './create',
                        removeUrl : './del'
                    },
                    method : 'POST'
                },
                autoSync : true, //保存数据后，自动更新
                pageSize:15
            }),
            gridCfg = Search.createGridCfg(columns,{
                tbar : {
                    items : [
                        {
                            text : '权限管理',
                            btnCls : 'button button-primary',
                            handler:function(event){
                               location.href='../power/index';
                            }
                        },
                        {
                            text : '<i class="icon-plus"></i>新建',
                            btnCls : 'button button-small',
                            handler:addFunction
                        },
                        {
                            text : '<i class="icon-remove"></i>删除',
                            btnCls : 'button button-small',
                            handler : delFunction
                        }
                       
                    ]
                },
                plugins : [editing,BUI.Grid.Plugins.CheckSelection,BUI.Grid.Plugins.AutoFit]// 插件形式引入多选表格
            });
            var search = new Search({
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


