</head>
 <body>
    <div class="container">
            <h2><?=$title?></h2>
                <div class="control-group span4">
                    <div class="controls" >
                        <?php
                            $now=time();
                            $year=  date('Y',$now); //2014
                            $month= date('n',$now); //9
                            $day=date('j',$now); //1
                            $day0=strtotime($year.'-'.$month.'-'.$day);//today
                            $day1=strtotime($year.'-'.$month.'-'.($day-1));//yestoday
                            $day2=strtotime($year.'-'.$month.'-'.($day-2));//the day before yestoday
                        ?>
                        <a href="<?php echo site_url() ?>/user/count_d/<?=$action?>/<?=$day0?>" >今天</a> |
                        <a href="<?php echo site_url() ?>/user/count_d/<?=$action?>/<?=$day1?>" >昨天</a> |
                        <a href="<?php echo site_url() ?>/user/count_d/<?=$action?>/<?=$day2?>" >前天</a>                               
                    </div>
                </div>
                <form id="searchForm" method="post" class="form-horizontal">
                    <div class="control-group span8">
                        <div class="controls">
                            <label class="control-label">选择时间：</label>
                            <input type="text" class="calendar" name="date" value="<?=$date?>">
                        </div>
                    </div>
                    <div class="span4 offset2">
                        <button type="button" id="btnSearch" class="button button-primary">查询</button>
                    </div>
                </form>
    <?php $x_cate="['1','2','3','4','5', '6', '7', '8', '9','10','11','12','13','14','15','16','17','18','19', '20',
         '21','22','23', '24','25','26','27','28','29','30','31']"?>
    <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
        </div>
    </div>
    <?php  $this->load->view('common/js'); ?>
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
  <script type="text/javascript">
    BUI.use(['bui/form','bui/chart','common/search'], function(Form,Chart,Search) {
        store = Search.createStore('../data/eq_new_count',{
          proxy : {
            method : 'POST'
          },
          pageSize:31,
          pageIndex:0
        }),        
        categories = <?php echo $x_cate;?>;
   
    var chart =  new Chart.Chart({
      id : 'canvas',
      width : 950,
      height : 500,
      plotCfg : {
        margin : [50,50,80] //画板的边距
      },
      title : {
        text : '新增用户'

      },
      subTitle : {
        text : '本月新增'
      },
      xAxis : {
        type : 'category', //标明分组坐标轴，会通过数据查找分类
        formatter : function(value){
          return categories[value]; //通过索引获取月的名称
        },
        labels : {
            label : {
            //rotate : -45,
            'text-anchor' : 'end'
            }
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
          name: '用户总量',
          xField : 'date' //指定x坐标轴
        }
      },
      tooltip : {
        valueSuffix : '台',
        //shared : true, //是否多个数据序列共同显示信息
        //crosshairs : true //是否出现基准线
      },
      series : [{
            yField : 'eq_num_new'
        }]
    });

    chart.render();

    store.on('load',function(){
      var data = store.getResult();
      chart.changeData(data);
    });
    store.load(); //store.load(params);
    
    var searchForm=new Form.HForm({
		      	srcNode : '#searchForm',
		      	defaultChildCfg : {
		        	validEvent : 'blur' //移除时进行验证
		      	}
		    }).render(); 
	//新增
	$("#btnSearch").click(function(){
	        var param = searchForm.serializeToObject();
	        param.start=0;
	        param.pageIndex=0;
	        store.load(param);
	});
});
</script>
