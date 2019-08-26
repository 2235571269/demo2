<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<h2>购物车展示页面</h2>
		<table>
			<tr>
				<th></th>
				<th>所选课程</th>
				<th>课程描述</th>
				<th>单价</th>
				<th>支付</th>
			</tr>
			<?php foreach($items=$this->data as $k => $v){?>
			<tr>
			<td><input type="checkbox"></td>
			<td><?php echo isset($v['name'])?$v['name']:"";?></td>
			<td><?php echo isset($v['desc'])?$v['desc']:"";?></td>
			<td><?php echo isset($v['price'])?$v['price']:"";?></td>
			<td><a href="<?php echo IUrl::creatUrl("/course/Purchase");?>&course_id=<?php echo isset($v['course_id'])?$v['course_id']:"";?>"><button>去支付</button></a></td>
			</tr>
			<?php }?>
		</table>
	</center>
</body>
</html>