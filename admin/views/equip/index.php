</head>
<body>
<div class="container">
    <div class="row">
        <h2><?=$title?></h2>
        <div class="span20">
        <div id="grid"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
<script type="text/javascript">
  BUI.use('common/page');
</script>
<script type="text/javascript">
var Grid = BUI.Grid,
Data = BUI.Data;
var Grid = Grid,
Store = Data.Store,
columns = [{
title : '设备总量',
dataIndex : 'b',
summary : true,
width:'16%'
},
{
title : '今日新增',
dataIndex : 'c',
summary : true,
width:'16%'
},
{
title : '当前在线',
dataIndex :'d',
summary : true,
width:'16%'
},
{
title : '当前异常',
dataIndex :'e',
summary : true,
width:'16%'
},
{
title : '滤网到期',
dataIndex :'f',
summary : true,
width:'16%'
}];

var store = new Store({
url : '../../data/1.json',
pageSize : 10,
autoLoad:true
}),
grid = new Grid.Grid({
render:'#grid',
columns : columns,
store: store
});
 
grid.render();
</script>