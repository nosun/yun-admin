<!DOCTYPE HTML>
<html>
 <head>
  <title>Skyware 企业云平台</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="<?php echo base_url() ?>views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url() ?>views/assets/css/bs3/bui.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>views/assets/css/main.css" rel="stylesheet" type="text/css" />
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
           <strong>Skyware</strong> 企业云平台
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo $this->_admin->username; ?></span>
        <a href="<?php echo site_url()?>login/quit" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <ul id="J_Nav"  class="nav-list ks-clear">
        <li class="nav-item"><div class="nav-item-inner nav-setting">系统管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-equip">设备管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-users">用户管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-plugin">运营管理</div></li>        
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
    <?php  $this->load->view('common/js'); ?>

  <script>
    BUI.use('common/main',function(){
      var config = [{
          id:'menu', 
          homePage : 'index',
          menu:[{
              text:'系统设置',
              items:[
                {id:'index',text:'后台首页',href:'<?php echo site_url("system/info") ?>',closeable : false},
                {id:'setting',text:'站点设置',href:'<?php echo site_url("system/setting") ?>'},
                {id:'passwd',text:'修改密码',href:'<?php echo site_url("admin/passwd") ?>'}                
        
              ]
            },{
              text:'权限设置',
              items:[
                {id:'admin-index',text:'用户管理',href:'<?php echo site_url("admin/index") ?>'},
                {id:'admin-role',text:'角色管理',href:'<?php echo site_url("roles/index") ?>'},
                {id:'admin-power',text:'权限管理',href:'<?php echo site_url("rights/index") ?>'},                
              ]
            },{
              text:'日志管理',
              items:[
                {id:'loginlog',text:'登陆日志',href:'<?php echo site_url("system/logs_login") ?>'},
                {id:'actionlog',text:'操作日志',href:'<?php echo site_url("system/logs_action") ?>'}  
              ]
            }]
          },{
            id:'equip',
            homePage : 'eq_index',
            menu:[{
                text:'设备分析',
                items:[
                  {id:'eq_index',text:'设备概况',href:'<?php echo site_url("equipment/index") ?>'}, 
                  {id:'eq_regment',text:'新增设备',href:'<?php echo site_url("equipment/reg_new") ?>'},
                  {id:'eq_regment',text:'所有设备',href:'<?php echo site_url("equipment/reg_all") ?>'},
                  {id:'eq_aera',text:'设备分布',href:'<?php echo site_url("equipment/aera") ?>'},                   
                  {id:'eq_online',text:'设备在线',href:'<?php echo site_url("equipment/eq_state_h/online") ?>'},
                  {id:'eq_working',text:'设备运行',href:'<?php echo site_url("equipment/eq_state_h/working") ?>'},
                  {id:'eq_filter',text:'滤网到期设备',href:'<?php echo site_url("equipment/filter") ?>'},
                  {id:'eq_filter',text:'报警设备',href:'<?php echo site_url("equipment/list_s/alarm") ?>'}          
                ]
              },{
                text:'设备管理',
                items:[
                  {id:'eq_cat',text:'设备分类',href:'<?php echo site_url("equipment/eq_cat_list") ?>'},
                  {id:'eq_list',text:'设备列表',href:'<?php echo site_url("equipment/eq_list") ?>'}
                ]
              }]
            },{
            id:'users',
            homePage : 'reg_all',            
            menu:[{
                text : '用户分析',
                items : [
                  {id:'reg_all',text:'用户概况',href:'<?php echo site_url("user/count_d/reg_all") ?>'},
                  {id:'aera',text:'地域分析',href:'<?php echo site_url("user/aera") ?>'},
                  {id:'reg_new',text:'注册分析',href:'<?php echo site_url("user/count_d/reg_new") ?>'}, 
                  {id:'agent',text:'客户端分析',href:'<?php echo site_url("user/agent") ?>'}                 
                ]
              }, {
                text:'用户管理', 
                items:[
                  {id:'user_list',text:'用户列表',href:'<?php echo site_url("user/user_list") ?>'}
                ]
              }
              ]
          },{
            id:'plugin',
            homePage : 'feedback',
            menu:[{
                text:'用户反馈',
                items:[
                  {id:'feedback',text:'反馈列表',href:'<?php echo site_url("feedback/index") ?>'}
                ]
              },
              {
              text : '消息推送',
              items:[
                  {id:'notice',text:'消息列表',href:'<?php echo site_url("notice/index") ?>'}              
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
