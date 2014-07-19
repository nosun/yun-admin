<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$d='[';
foreach ($admins as $admin): 
$d.= '{"uid":"'.$admin['uid'].'","username" :"'.$admin['username'].'","role": "'.$admin['role'].'",email:"'.$admin['email'].'",status:"'.$admin['status'].'"},';
endforeach;
$d.= ']';
?>
<?php //var_dump ($strstor);?>

<script type="text/javascript">
    BUI.use(['common/search','common/page'],function (Search) {
        var roleObj = {
             <?php
                foreach ($roles as $rl):
                    ?>
            "<?php echo $rl['id']?>":"<?php echo $rl['name']?>",
             <?php endforeach; ?>
        };
        var statusObj = {"1":"正常","0":"冻结"},
        columns = [
            {title:'ID',dataIndex:'uid',width:80,renderer:function(v){
                    return Search.createLink({
                        id : 'detail' + v,
                        title : '管理员信息',
                        text : v,
                        href : '<?php echo $link_url?>/index/'
                    });
                }},
            {title:'用户名',dataIndex:'username',width:100},
            {title:'用户角色',dataIndex:'role',width:150,renderer:BUI.Grid.Format.enumRenderer(roleObj)},
            {title:'Email',dataIndex:'email',width:150},
            {title:'状态',dataIndex:'status',width:100,renderer:BUI.Grid.Format.enumRenderer(statusObj)},
            {title:'操作',dataIndex:'',width:200,renderer : function(value,obj){
                    var editStr = Search.createLink({ //链接使用 此方式
                        id : 'edit' + obj.id,
                        title : '编辑管理员信息',
                        text : '编辑',
                        href : '<?php echo $link_url?>create'
                    }),
                    delStr = '<span class="grid-command btn-del" title="删除学生信息">删除</span>';//页面操作不需要使用Search.createLink
                    return editStr + delStr;
                }
            }
        ],
       store = Search.createStore('<?php echo $link_url?>admin_data'),
       gridCfg = Search.createGridCfg(columns,{
            tbar : {
                items : [
                    {text : '<i class="icon-plus"></i>新建',btnCls : 'button button-small',handler:function(){alert('新建');}},
                    {text : '<i class="icon-remove"></i>删除',btnCls : 'button button-small',handler : delFunction}
                ]
            },
            plugins : [BUI.Grid.Plugins.CheckSelection] // 插件形式引入多选表格
        });
        var search = new Search({
            store : store,
            gridCfg : gridCfg
        }),
        grid = search.get('grid');
        
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
                    $.ajax({
                        url : '../data/del.php',
                        dataType : 'json',
                        data : {ids : ids},
                        success : function(data){
                            if(data.success){ //删除成功
                                search.load();
                            }else{ //删除失败
                                BUI.Message.Alert('删除失败！');
                            }
                        }
                    });
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
