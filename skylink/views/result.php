<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>计算结果</title>
</head>
<body>

<div id="container">
	<h1>计算结果</h1>
	<div id="body">
            <p>平放时间：<?=$time[1]?>秒,合计<?=floor($time[1]/3600) ?>小时</p>
            <p>立放时间：<?=$time[0]?>秒,合计<?=floor($time[0]/3600) ?>小时</p>
            <p>平放/立放：<?=printf("%.2f",($time[1]/$time[0])) ?></p>
            <p>平放人数：<?=$ping ?></p>
            <p>统计人数：<?=$count ?></p>            
            <p>平放比例：<?=printf("%.2f",$ping/$count) ?></p>
            
	</div>
</div>

</body>
</html>