<!DOCTYPE HTML>
<html>
<head>
<title><?php echo $user['login_name'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
    <div class="detail-page">
      <div class="detail-section">  
        <h3>基本信息</h3>
        <hr>
        <div class="row detail-row">
          <div class="span8">
            <label>用户名：</label><span class="detail-text"><?php echo $user['login_name']?></span>
          </div>
          <div class="span8">
            <label>电话号码：</label><span class="detail-text"><?php echo $user['user_phone']?></span>
          </div>
           <div class="span8">
            <label>电子邮箱：</label><span class="detail-text"><?php echo $user['user_email']?></span>
          </div>
        </div>
        <div class="row detail-row">
          <div class="span8">
            <label>所在区域：</label><span class="detail-text"><?php echo $user['user_location']?></span>
          </div>
          <div class="span8">
            <label>注册时间：</label><span class="detail-text"><?php echo $user['user_regtime']?></span>
          </div>
           <div class="span8">
            <label>用户头像：</label><span class="detail-text"><?php echo $user['user_img']?></span>
          </div>
        </div>
      </div>
        <hr>
      <div class="detail-section"> 
        <h3>设备情况</h3>

        <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
            </div>
        </div>
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
  BUI.use('common/search',function (Search) {
    
      editing = new BUI.Grid.Plugins.DialogEditing({
        triggerCls : 'btn-edit'
      }),
    columns = [
        {title:'设备序列号',dataIndex:'device_sn',width:100},
        {title:'设备型号',dataIndex:'device_cat',width:100},    
        {title:'设备MAC',dataIndex:'device_mac',width:150},
        {title:'所在地区',dataIndex:'device_location',width:300},
        {title:'设备状态',dataIndex:'device_desc1',width:100},    
        {title:'运行时长',dataIndex:'device_desc2'}   
        ],
      store = Search.createStore('../../data/user_eq_list/<?=$user['id']?>',{
        proxy : {
          method : 'POST'
        },
        pageSize:10,
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
<body>
</html>  