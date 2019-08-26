<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		*{list-style: none;}
		body{
			width: 1200px;
			margin:0px auto ;
		}
		li{line-height: 30px;height: 30px;margin-left:100px;}
/*		.ul*/
	</style>
</head>
<body>
	<h1 class="h1">列表详情</h1>
	<h3>课程名称:<?php echo $this->name;?></h3>
	<h4><?php echo $this->desc;?></h4>
	<ul>
		<?php foreach($items=$this->list as $k => $v){?>
		<li><a href="<?php echo IUrl::creatUrl("course/video");?>&id=<?php echo isset($v['id'])?$v['id']:"";?>"><?php echo isset($v['name'])?$v['name']:"";?></a></li>
		<?php }?>
	</ul>
</body>
</html>