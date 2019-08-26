<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<h1 style="color:red">确认订单</h1>
		
				<table>
					<tr>
						<th>所选课程</th>
						<th>单价</th>
						
					</tr>
					<?php foreach($items=$this->data as $k => $v){?>
					<tr>
						<td><?php echo isset($v['name'])?$v['name']:"";?></td>
						<td><?php echo isset($v['price'])?$v['price']:"";?></td>
					</tr>
					<?php }?>
				</table>
			<h2>请选择支付方式</h2>
			<div style="width:1400px;heigth:1200px">
				<a href="<?php echo IUrl::creatUrl("/course/pay");?>&pay_id=1"><img src="<?php echo IUrl::creatUrl("")."public/img/weixin.png";?>" style="witdh:100px;height:120px;" alt=""></a>
				<a href="<?php echo IUrl::creatUrl("/course/pay");?>&pay_id=2"><img src="<?php echo IUrl::creatUrl("")."public/img/alipay.png";?>" style="witdh:100px;height:120px;" alt=""></a>
				<a href="<?php echo IUrl::creatUrl("/course/pay");?>&pay_id=3"><img src="<?php echo IUrl::creatUrl("")."public/img/online.png";?>" style="witdh:100px;height:120px;" alt=""></a>
			
			</div>
	</center>
</body>
</html>