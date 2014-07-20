<!DOCTYPE HTML>
<html>
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    
    <div class="span20">
      <div id="grid"></div>
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
title : '',
dataIndex :'a',
width:'20%'
},{
title : '90日到期',
dataIndex : 'b',
summary : true,
width:'18%'
},
{
title : '30日到期',
dataIndex : 'c',
summary : true,
width:'18%'
},
{
title : '7日到期',
dataIndex :'d',
summary : true,
width:'18%'
},
{
title : '已到期',
dataIndex :'e',
summary : true,
width:'18%'
}
];

var store = new Store({
url : '../../data/3.json',
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
<!-- script end -->

<body>
</html>  