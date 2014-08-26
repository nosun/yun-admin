<!DOCTYPE HTML>
<html>
 <head>
  <title><?=$title?></title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />   <!-- 下面的样式，仅是为了显示代码，而不应该在项目中使用-->
   <link href="<?php echo base_url() ?>/views/assets/css/prettify.css" rel="stylesheet" type="text/css" />
 </head>
 <body>
    <div class="container">
      <div class="row">
        <h2><?=$title?></h2>
        <div class="span24" id="canvas"></div>
      </div>
    </div>
  <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
  <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
  <script type="text/javascript">
    BUI.use('common/page');
    BUI.use('bui/chart',function (Chart) {
    var chart = new Chart.Chart({
    render : '#canvas',
    width : 950,
    height : 400,
    title : {
    text : '本月设备注册情况',
    'font-size' : '16px'
    },
    subTitle : {
    text : '2014年7月'
    },
    xAxis : {
    categories: [
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    '10',
    '11',
    '12',
    '13',
    '14',
    '15',
    '16',
    '17',
    '18',
    '19',
    '20',
    '21',
    '22',
    '23',
    '24',
    '25',
    '26',
    '27',
    '28',
    '29',
    '30',
    '31'
    ]
    },
    yAxis : {
    title : {
    text : '设备注册数量'
    },
    min : 0
    },
    tooltip : {
    shared : true
    },
    seriesOptions : {
    columnCfg : {
    }
    },
    series: [ {
    name: '注册设备',
    data: [5,6, 12, 4, 9, 14,7, 12, 18, 21, 12, 6,10,9,20,9,7,12,7,16,12,19]
    }]
    });
    chart.render();
    });

  </script>

<body>
</html>  