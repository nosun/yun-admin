</head>
    <body>
        
        <div class="container">
            <div class="row">
                    <div class="control-group span4">
                        <div class="controls" >
                              <a href="" >今天</a> |
                              <a href="" >昨天</a> |
                              <a href="" >前天</a>                              
                        </div>
                    </div>
                <form id="searchForm" method="post" class="form-horizontal">
                    <div class="control-group span8">
                        <div class="controls">
                            <label class="control-label">选择时间：</label>
                            <input type="text" class="calendar" name="date" value="">
                        </div>
                    </div>
                    <div class="span4 offset2">
                        <button type="button" id="btnSearch" class="button button-primary">查询</button>
                    </div>
                </form>
            </div>
            <div class="row">
                <h2><?= $title ?></h2>
                <div class="span24" id="canvas"></div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
        <script type="text/javascript">
            BUI.use('common/page');
            BUI.use('bui/chart', function(Chart) {
                var chart = new Chart.Chart({
                    render: '#canvas',
                    width: 950,
                    height: 500,
                    plotCfg: {
                        margin: [50, 50, 80] //画板的边距
                    },
                    title: {
                        text: '今日设备在线情况'

                    },
                    subTitle: {
                        text: '2014年7月15日'
                    },
                    xAxis: {
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
                            '24'
                        ]
                    },
                    yAxis: {
                        title: {
                            text: '设备小时在线数量',
                            rotate: -90
                        }
                    },
                    tooltip: {
                        valueSuffix: '°C',
                        shared: true, //是否多个数据序列共同显示信息
                        crosshairs: true //是否出现基准线
                    },
                    series: [{
                            name: '设备在线',
                            data: [120, 110, 112, 120, 110, 115, 120, 80, 70, 60, 30, 40, 60, 80, 90, 150, 160, 165, 163, 180, 190, 200, 220, 250]
                        }]
                });

                chart.render();
            });

        </script>
