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
 BUI.use(['bui/chart', 'bui/data'], function(Chart, Data) {            
        var store = new Data.Store({
          url : '../../data/5.json',
          autoLoad : false //不自动加载
        }),
         categories = ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'];

        var chart = new Chart.Chart({
          id : 'canvas',
          width : 950,
          height : 500,
          plotCfg : {
            margin : [50,50,80] //画板的边距
          },
          title : {
            text : '一年的平均温度'

          },
          subTitle : {
            text : 'Source: WorldClimate.com'
          },
          xAxis : {
            type : 'category', //标明分组坐标轴，会通过数据查找分类
            formatter : function(value){
              return categories[value]; //通过索引获取月的名称
            }
          },
          yAxis : {
            title : {
              text : '温度',
              rotate : -90
            }
          },  
          seriesOptions: {
            lineCfg : {
              xField : 'month' //指定x坐标轴
            }
          },
          tooltip : {
            valueSuffix : '°C',
            shared : true, //是否多个数据序列共同显示信息
            crosshairs : true //是否出现基准线
          },
          series : [{
                name: 'Tokyo',
                yField : 'tokyo'
            }]
        });

        chart.render();

        store.on('load',function(){
          var data = store.getResult();
          chart.changeData(data);
        });
        store.load(); //store.load(params);
    });
      </script>