<!DOCTYPE HTML>
<html>
    <head>
        <title><?= $title ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="<?php echo base_url() ?>/views/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>/views/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>/views/assets/css/page-min.css" rel="stylesheet" type="text/css" />   <!-- 下面的样式，仅是为了显示代码，而不应该在项目中使用-->
        <link href="<?php echo base_url() ?>/views/assets/css/prettify.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h2>设备地区分布</h2>
                <div class="row">
                    <div id="grid" class="span12">
                    </div>
                    <div class="span10">
                        <div class="panel">
                            <div class="panel-header">
                                饼图 <?php $p=strtotime('2014-07-02');echo $p;?>
                            </div>
                            <div id="canvas" class="panel-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/bui-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>/views/assets/js/config-min.js"></script>
        <script type="text/javascript">
            BUI.use('common/page');
            BUI.use(['bui/chart', 'bui/data', 'bui/grid'], function(Chart, Data, Grid) {
                var store = new Data.Store({
                    url: '../../data/2.json',
                    autoLoad: true
                });
//饼图
                var chart = new Chart.Chart({
                    width: 400,
                    height: 300,
                    render: '#canvas',
                    store: store,
                    plotCfg: {
                        margin: [20, 0, 80] //画板的边距
                    },
                    tooltip: {
                        shared: true,
                        pointRenderer: function(point) {
                            return (point.percent * 100).toFixed(2) + '%';
                        }
                    },
                    seriesOptions: {
                        pieCfg: {
                            allowPointSelect: true,
                            labels: {
                                distance: 20,
                                label: {
                                },
                                renderer: function(value, item) {
                                    return value + ' ' + (item.point.percent * 100).toFixed(2) + '%';
                                }
                            }
                        }
                    },
                    legend: null,
                    series: [{
                            type: 'pie',
                            name: '设备区域分布'
                        }]
                });

                chart.render();

                var columns = [
                    {title: '编号', dataIndex: '', width: 40, renderer: function(value, obj, index) {
                            return index;
                        }},
                    {title: '地区', dataIndex: 'name', width: 100},
                    {title: '占比(%)', dataIndex: 'y', width: 100},
                    {title: '数量', dataIndex: 'z', width: 100},        
                ],
                        grid = new Grid.Grid({
                            render: '#grid',
                            columns: columns,
                            loadMask: true, //加载数据时显示屏蔽层
                            store: store
                        });
                grid.render();

                var pie = chart.getSeries()[0];
//根据名称获取饼图项
                function findItem(name) {
                    var
                            items = pie.getItems(),
                            rst;
                    BUI.each(items, function(item) {
//point是表示这个图形的位置的对象，obj是初始时传入的对象
                        if (item.get('point').obj.name == name) {
                            rst = item;
                            return false;
                        }
                    });
                    return rst;
                }

//点击表格选中圆饼图
                grid.on('rowclick', function(ev) {
                    var record = ev.record,
                            item = findItem(record.name);

                    chart.pauseEvent('seriesitemselected'); //阻止事件执行
                    pie.setSelected(item);
                    chart.resumeEvent('seriesitemselected');
                });

                chart.on('seriesitemselected', function(ev) {
                    var item = ev.seriesItem,
                            record = item.get('point').obj;

                    grid.setSelected(record);

                });

            });
        </script>

    <body>
</html>  