<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>	
	<center>
		<h1>此课需要付费观看</h1>
		<div style="float:left;height:200px;">
			<div style="width:1400px;heigth:1200px">
			<center>
				<?php foreach($items=$this->data as $k => $v){?>
				<!-- <img src="<?php echo IUrl::creatUrl("")."public/img/222.jpg";?>" height="200px" width="300px"style="color:red" > -->
				<div style="float:left;width:450px;heigth:80px" ><h3>所属分类</h3><?php echo isset($v['name'])?$v['name']:"";?></div>
				<div style="float:left;width:450px;heigth:80px"><h3>课程名称</h3><?php echo isset($v['one'])?$v['one']:"";?></div>
				<div style="float:left;width:450px;heigth:80px">
					<h3>基本概述</h3>
					<span><?php echo isset($v['desc'])?$v['desc']:"";?></span>
				</div>
				<?php }?>
			</center>
			</div>
		</div>
		
		<div >
			<div  style="width:400px;heigth:500px">
			<center>
			
			
				 <div style="float:left">
					
					<p style="color:red">￥<?php echo isset($v['price'])?$v['price']:"";?></p>
					<div>
						<a href="<?php echo IUrl::creatUrl("/course/purchase");?>&course_id=<?php echo isset($v['id'])?$v['id']:"";?>"><img src="<?php echo IUrl::creatUrl("")."public/img/a83d5923f59901027d1efcee3b9d18ce.png";?>"></a>
						<a href="<?php echo IUrl::creatUrl("/course/Buycar");?>&course_id=<?php echo isset($v['id'])?$v['id']:"";?>"><img src="<?php echo IUrl::creatUrl("")."public/img/379bce48dd8c911e48983b2f4f741cee.png";?>"></a>
					</div>
				</div> 
			
			
			</center>
			</div>

		</div>
	</center>	
	
</html>