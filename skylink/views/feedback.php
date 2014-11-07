<?php include_once 'header.php'; ?>
<div class="container mainbox">
    <p class="row" id='path'><a href="#">首页</a> &gt; <a href="/account/">用户中心</a> &gt; 在线反馈</p>
    <div class="row" id='panelbox'>
        <section class='col-sm-2' id='u_menu'>
            <?php include_once 'uleft.php'; ?>
        </section>
        <section class='col-sm-10' id='u_content'>
            <h3 id="u_title"><i class="account_icon"></i>个人中心</h3>
            <div class="u_box" id="fb_list">
                <div><h2>反馈列表</h2><a href="<?php echo site_url('user/feedback_add') ?>" target="_self">增加反馈</a></div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="col-sm-1">编号</th>
                                <th class="col-sm-5">标题</th>
                                <th class="col-sm-2">类别</th>
                                <th class="col-sm-2">状态</th>
                                <th class="col-sm-2">时间</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($feedback as $row) { ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><a href="<?php echo site_url('user/feedback_view/'.$row['id']) ?>" target="_slef"><?php echo $row['title'] ?></a></td>
                                    <td><?php echo $row['category'] ?></td>
                                    <td><?php echo $row['status'] ?></td>  
                                    <td><?php echo date('Y-m-d',$row['addtime']) ?></td>                
                                </tr>
                            <?php } ?>  
                        </tbody>
                    </table>
                </table>

            </div>
        </section>
    </div>
</div>
<?php include_once 'footer.php'; ?>
</body>
</html>
