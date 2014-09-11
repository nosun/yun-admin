</head>
<body>
<div class="container">
    <div class="row">
        <h2><?=$title?></h2>
        <div class="span20">
            <table class="table table-bordered" cellspacing="0">
            <thead>
                <tr>
                    <th>120小时</th>
                    <th>90小时</th>
                    <th>60小时</th>
                    <th>30小时</th>
                    <th>已到期</th>          
                </tr>
            </thead>
            <tbody>
                <tr>
                <td><a href="<?php echo site_url("equipment/list_s/120") ?>" title="查看清单"><?=$filter120?></td>                      
                <td><a href="<?php echo site_url("equipment/list_s/90") ?>" title="查看清单"><?=$filter90?></td>                      
                <td><a href="<?php echo site_url("equipment/list_s/60") ?>" title="查看清单"><?=$filter60?></td>                      
                <td><a href="<?php echo site_url("equipment/list_s/30") ?>" title="查看清单"><?=$filter30?></td>                      
                <td><a href="<?php echo site_url("equipment/list_s/0") ?>" title="查看清单"><?=$filter0?></td>                
            </tbody>
           </table>
        </div>
    </div>
</div>