</head>
 <body>
    <div class="container">
            <h2><?=$title?></h2>
    <div class="row">
        <form id="searchForm" method="post" class="form-horizontal">
        <input type="hidden" name="a" value="3">
        <div class="row">
            <div class="control-group span6">
                <div class="controls" >
                    <select name="product_id" id="product_id" selected="">
                        <option value="0">请选择产品型号</option>
                        <option value="1">产品一</option>
                        <option value="2">产品二</option>
                    </select>
                </div>
            </div>
            <div class="control-group span12">
                <div class="controls">
                    <label class="control-label">启用时间：</label>
                    <input type="text" class="calendar" name="start_date" value=""><span> - </span>
                    <input name="end_date" type="text" class="calendar" value="">
                </div>
            </div>
            <div class="span4 offset2">
                <button type="submit" id="btnSearch" class="button button-primary">查询</button>
            </div>
        </div>
        </form>
    </div>        
      <div class="row">
        <div class="span24" id="canvas"></div>
      </div>
    </div>
       <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
        <script type="text/javascript">
            BUI.use('bui/calendar',function(Calendar){
                var datepicker = new Calendar.DatePicker({
                trigger:'.calendar',
                autoRender : true
                });
            });
        </script>
        <script type="text/javascript">
            BUI.use('common/page');
        </script>
        <script>
            BUI.use('common/search',function (Search) {
                editing = new BUI.Grid.Plugins.DialogEditing({
                triggerCls : 'btn-edit'
      }),
    columns = [
        {title:'设备序列号',dataIndex:'device_sn',width:100},
        {title:'设备型号',dataIndex:'device_cat',width:100},    
        {title:'设备MAC',dataIndex:'device_mac',width:150},
        {title:'所在地区',dataIndex:'device_location',width:100},
        {title:'设备状态',dataIndex:'device_desc1',width:100},    
        {title:'运行时长',dataIndex:'device_desc2',width:100}   
        ],
      store = Search.createStore('../data/eq_list',{
        proxy : {
          method : 'POST'
        },
        pageSize:5
      }),
      gridCfg = Search.createGridCfg(columns,{
        plugins : [editing,BUI.Grid.Plugins.CheckSelection,BUI.Grid.Plugins.AutoFit] // 插件形式引入多选表格
      });

    var  search = new Search({
        store : store,
        gridCfg : gridCfg
      }),
      grid = search.get('grid');

  });
  </script>
  <script type="text/javascript">
        BUI.use(['bui/chart', 'bui/data'], function(Chart, Data) {
        var store = new Data.Store({
          url : '../data/eq_new_count',
          autoLoad : false
        }),
         categories = ['1','2','3','4','5', '6', '7', '8', '9','10','11','12','13','14','15','16','17','18','19', '20',
             '21','22','23', '24','25','26','27','28','29','30','31'];

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