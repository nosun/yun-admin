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
    text : 'Monthly Average Temperature',
    'font-size' : '16px'
    },
    subTitle : {
    text : 'Source: WorldClimate.com'
    },
    xAxis : {
    categories: [
    'Jan',
    'Feb',
    'Mar',
    'Apr',
    'May',
    'Jun',
    'Jul',
    'Aug',
    'Sep',
    'Oct',
    'Nov',
    'Dec'
    ]
    },
    yAxis : {
    title : {
    text : 'xxxxx'
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
    name: 'Tokyo',
    data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    }, {
    name: 'New York',
    data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
    }]
    });
    chart.render();
    });

  </script>

<body>
</html>  