</head>
 <body>
    <div class="container">
            <h2><?=$title?></h2>
               <div class="control-group span4">
                    <div class="controls" >
                        <?php
                            if(!empty($date)){
                                $month=$date;
                            }else{
                                $month= date('Y-n',now());
                            }
                            $pn=explode('-',$month);
                            $month0=$pn[0].'-'.$pn[1];// this month
                            $month1=$pn[0].'-'.($pn[1]-1);//last month
                            
                            if($pn[1]==1){
                                $month1_num=12;
                                $month1=($pn[0]-1).'-'.$month1_num;//next month
                            }else{
                                $month1_num=$pn[1]-1;
                                $month1=($pn[0]).'-'.$month1_num;
                            } 
                            
                            if($pn[1]==12){
                                $month2_num=1;
                                $month2=($pn[0]+1).'-'.$month2_num;//next month
                            }else{
                                $month2_num=$pn[1]+1;
                                $month2=($pn[0]).'-'.$month2_num;
                            }
                        ?>
                        
                        <a href="<?php echo site_url() ?>/user/count_d/<?=$action?>/<?=$month1?>" ><?=$month1_num?>月</a> |                        
                        <a href="<?php echo site_url() ?>/user/count_d/<?=$action?>/<?=$month0?>"><?=$pn[1]?>月</a>
                        
                        <?php if(date('n',time())==$pn[1]){
                            ;
                        }else{
                        ?>
                         | <a href="<?php echo site_url() ?>/user/count_d/<?=$action?>/<?=$month2?>" ><?=$month2_num?>月</a>  
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <form id="searchForm" method="post" class="form-horizontal">
                    <div class="control-group span8">
                        <div class="controls">
                            <label class="control-label">月份选择：</label>
                            <input type="text" id="J_Month" name="date" value="<?=$date?>" style="z-index: 100">
                        </div>
                    </div>
                    <div class="span4 offset2">
                        <button type="button" id="btnSearch" class="button button-primary">查询</button>
                    </div>
                </form>
    <div class="row detail-row">
          <div class="span24">
            <div id="grid"></div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
<script type="text/javascript">
 BUI.use('bui/calendar',function(Calendar){
          var inputEl = $('#J_Month'),
            monthpicker = new BUI.Calendar.MonthPicker({
            trigger : inputEl,
         // month:1, //月份从0开始，11结束
          autoHide : true,
          zIndex:0,
          align : {
            points:['bl','tl']
          },
          //year:2000,
          success:function(){
            var month = this.get('month'),
              year = this.get('year');
            inputEl.val(year + '-' + (month + 1));//月份从0开始，11结束
            this.hide();
          }
        });

        monthpicker.render();
        monthpicker.on('show',function(ev){
          var val = inputEl.val(),
            arr,month,year;
          if(val){
            arr = val.split('-'); //分割年月
            year = parseInt(arr[0]);
            month = parseInt(arr[1]);
            monthpicker.set('year',year);
            monthpicker.set('month',month - 1);
            monthpicker.set('zIndex',1000);

          }
        });
      });
    
</script>
<script type="text/javascript">
    BUI.use('common/page');
</script>
<script type="text/javascript">
    BUI.use(['bui/form','bui/chart','common/search'], function(Form,Chart,Search) {
        store = Search.createStore('<?php echo $dataurl?>',{
          proxy : {
            method : 'POST'
          },
          pageSize:31,
          pageIndex:0
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
        text : '用户总数'

      },
      subTitle : {
        text : '<?=$pn[1]?>月'
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
        <?=$chart?> : {
          name: '用户总量',
          xField : 'updatetime' //指定x坐标轴
        }
      },
      tooltip : {
        valueSuffix : '人',
        shared : true, //是否多个数据序列共同显示信息
        crosshairs : true //是否出现基准线
      },
      series : [{
            yField : 'num'
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