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
          url : '../../data/4.json',
          autoLoad : false
        }),
         categories = ['1',
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
                      '12'];

        var chart =  new Chart.Chart({
          id : 'canvas',
          width : 950,
          height : 500,
          plotCfg : {
            margin : [50,50,80] //画板的边距
          },
          title : {
            text : '新增设备图'

          },
          subTitle : {
            text : '7月注册设备'
          },
          xAxis : {
            type : 'category', //标明分组坐标轴，会通过数据查找分类
            formatter : function(value){
              return categories[value]; //通过索引获取月的名称
            }
          },
          yAxis : {
            title : {
              text : '数量',
              rotate : -90
            }
          },  
          seriesOptions: {
            columnCfg : {
              name: '日期',
              xField : 'day' //指定x坐标轴
            }
          },
          tooltip : {
            valueSuffix : '台',
            shared : true, //是否多个数据序列共同显示信息
            crosshairs : true //是否出现基准线
          },
          series : [{
                name: '设备数量',
                yField : 'num'
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