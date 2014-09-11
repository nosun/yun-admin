</head>
<body>
<div class="container">
    <div class="row">
        <h2><?=$title?></h2>
        <div class="span20">
            <table class="table table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th>设备总量</th>
                    <th>今日新增</th>
                    <th>在线设备</th>
                    <th>工作设备</th>
                    <th>异常设备</th> 
                    <th>滤网到期</th>                     
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><a href="<?php echo site_url("equipment/reg_all") ?>" title="查看详情"><?=$num_all?></td>
                <td><a href="<?php echo site_url("equipment/reg_new") ?>" title="查看详情"><?=$num_new?></td>
                <td><a href="<?php echo site_url("equipment/online") ?>" title="查看详情"><?=$num_online?></td>
                <td><a href="<?php echo site_url("equipment/working") ?>" title="查看详情"><?=$num_working?></td>
                <td><a href="<?php echo site_url("equipment/alarm") ?>" title="查看详情"><?=$num_alarm?></td>
                <td><a href="<?php echo site_url("equipment/filter") ?>" title="查看详情"><?=$num_filter?></td>                
            </tbody>
           </table>
        </div>
    </div>
</div>