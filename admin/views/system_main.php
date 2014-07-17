<!DOCTYPE HTML>
<html>
 <head>
  <title>思佳维云平台——管理中心</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="<?php echo base_url() ?>views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>views/assets/css/main.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
        <a href="#" title="logo" target="_blank">
            <img src="#" alt="logo" />
        </a>
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user">nosun</span>
        <a href="<?php echo site_url()?>/login/quit" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <ul id="J_Nav"  class="nav-list ks-clear">
        <li class="nav-item"><div class="nav-item-inner nav-setting">系统管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-equip">设备管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-users">用户管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-plugin">插件管理</div></li>        
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="<?php echo base_url() ?>views/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>views/assets/js/bui.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>views/assets/js/config.js"></script>

  <script>
    BUI.use('common/main',function(){
      var config = [{
          id:'menu', 
          homePage : 'index',
          menu:[{
              text:'系统设置',
              items:[
                {id:'index',text:'后台首页',href:'<?php echo site_url("system/info") ?>',closeable : false},
                {id:'main-menu',text:'站点设置',href:'<?php echo site_url("system/setting") ?>'},
                {id:'main-menu',text:'修改密码',href:'<?php echo site_url("system/passwd") ?>'}                
        
              ]
            },{
              text:'权限设置',
              items:[
                {id:'operation',text:'用户管理',href:'<?php echo site_url("system/members") ?>'},
                {id:'quick',text:'角色管理',href:'<?php echo site_url("system/roles") ?>'}  
              ]
            },{
              text:'日志管理',
              items:[
                {id:'operation',text:'登陆日志',href:'<?php echo site_url("system/logs/login") ?>'},
                {id:'quick',text:'操作日志',href:'<?php echo site_url("system/logs/action") ?>'}  
              ]
            }]
          },{
            id:'equip',
            menu:[{
                text:'设备分析',
                items:[
                  {id:'introduc2',text:'设备概况',href:'<?php echo site_url("equipments/index") ?>'}, 
                  {id:'introduc2',text:'新增数量',href:'<?php echo site_url("equipments/index") ?>'}, 
                  {id:'introduc1e',text:'分布情况',href:'<?php echo site_url("equipments/index") ?>'},                            
                  {id:'introduce',text:'运行时间',href:'<?php echo site_url("equipments/index") ?>'},
                  {id:'valid',text:'运行状态',href:'<?php echo site_url("equipments/index") ?>'}
                ]
              },{
                text:'设备管理',
                items:[
                  {id:'eq_cat',text:'设备分类',href:'<?php echo site_url("equipments/eq_cat_list") ?>'},
                  {id:'eq_list',text:'设备列表',href:'<?php echo site_url("equipments/eq_list") ?>'}
                ]
              }]
            },{
            id:'users',
            menu:[{
                text : '用户分析',
                items : [
                  {id:'users_info',text:'用户概况',href:'search/code.html'},
                  {id:'example-dialog',text:'用户分布',href:'search/example-dialog.html'},
                  {id:'introduce',text:'新增用户',href:'search/introduce.html'}, 
                  {id:'config',text:'在线时长',href:'search/config.html'},                 
                  {id : 'tab',text : '行为分析',href : 'search/tab.html'}
                ]
              }, {
                text:'用户管理', 
                items:[
                  {id:'example',text:'用户列表',href:'search/example.html'}
                ]
              }
              ]
          },{
            id:'plugin',
            menu:[{
                text:'留言反馈',
                items:[
                  {id:'feedback',text:'留言反馈',href:'detail/example.html'}
                ]
              },
              {
              text : '消息推送',
              items:[
                  {id:'message',text:'消息管理',href:'chart/code.html'}              
              ]
            }
            ]
          }];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>
