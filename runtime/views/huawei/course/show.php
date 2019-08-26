<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="<?php echo IUrl::creatUrl("")."public/jq.js";?>"></script>
	<link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">
	<script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."public/css/imooc.css";?>">
	<!-- <link rel="stylesheet" href="./imooc.css"> -->
</head>
<body>
	<!-- <table class="layui-hide" id="demo" lay-filter="test"></table> -->
	<div class="top">
		<h2 align="center">课程展示</h2>
	
		<p><label for="keyword"></label><input type="text" name="keyword" id="keyword" class="form-control"></p>
		<button class="btn btn-default" page=1>搜索</button>
		<div>
			<table class="cate" style="line-height: 40px;">
				<tr>
					<td><b>方向：</b></td>
					<td><span cid="all" id="all" class="default direction">全部</span><?php foreach($items=$this->cate as $k => $v){?> <?php if($v['lv']==1){?><span cid=<?php echo isset($v['id'])?$v['id']:"";?> pid=<?php echo isset($v['id'])?$v['id']:"";?> class="direction"><?php echo isset($v['name'])?$v['name']:"";?></span><?php }?>  <?php }?>
				</tr>
				<tr>
					<td><b>分类：</b></td>
					<td id="content"><span id="all" check=true class="default aaa data">全部</span><?php foreach($items=$this->cate as $k => $v){?><?php if($v['lv']==2){?><span cid=<?php echo isset($v['id'])?$v['id']:"";?> class="data"><?php echo isset($v['name'])?$v['name']:"";?></span><?php }?><?php }?>
				</tr>
			</table>
		</div>
	</div>
	

	<!-- <table class="table" style="text-align: center">
		<tr>
			<td>id</td>
			<td>名称</td>
			<td>分类名称</td>
		</tr>
		<tbody id="tbody">
		
		<tr>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		
		</tbody>
	</table> -->
	
	
	<div class="course-list">
		<div class="moco-course-list">
			<div class="clearfix">
			<div id="body">
			<?php foreach($items=$this->data as $k => $v){?>
				<div class="course-card-container">
					<a target="_blank" href="http://www.iwebshop.com?controller=course&action=is_buy&id=<?php echo isset($v['course_id'])?$v['course_id']:"";?>" class="course-card">

						<div class="course-card-top">
							<img class="course-banner lazy" data-original="//img3.mukewang.com/5d401257087ba77b06000338-240-135.jpg" style="display: inline;" src="//img3.mukewang.com/5d401257087ba77b06000338-240-135.jpg">
							<div class="course-teacher">
								<div class="teacher-img" style="background-image:url('<?php echo IUrl::creatUrl("")."public/img/jj.jpg";?>')">
								</div>
								<span class="teacher-name">神思者l</span>
							</div>
						</div>
						<div class="course-card-content">
							<h3 class="course-card-name"><?php echo isset($v['course_name'])?$v['course_name']:"";?></h3>
							<div class="clearfix course-card-bottom">
								<div class="course-card-info">
									<span>入门</span><span><i class="imv2-set-sns"></i>4071</span>
								</div>
								<p class="course-card-desc">0基础秒学告白神器，VBS版、前端版、Java版、小程序版,4款神器各取所需
								</p>

								
								<div class="course-card-price sales">
									<div class="price-box">
									<?php if($v['is_vip']==1){?>
										<span class="price red">￥8.80</span>
										<span class="cost-price">￥69.90</span>
										
										<div class="collect clearfix js-course-collect" data-cmd="follow" data-cid="1148" title="收藏"><i class="imv2-star"></i><span>收藏</span></div>
									</div>


									<span class="sales-tip">
										限时优惠

									</span>
									<?php }else{?>
										<span class="price red">免费</span>
										<div class="collect clearfix js-course-collect" data-cmd="follow" data-cid="1148" title="收藏"><i class="imv2-star"></i><span>收藏</span></div>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
					</a>
				</div>
				
				<?php }?>
				</div>
			</div>
		</div>
		
		<!-- <div class="page"><span class="disabled_page">首页</span><span class="disabled_page">上一页</span><a href="javascript:void(0)" class="active text-page-tag">1</a><a class="text-page-tag" href="/course/list?c=javascript&amp;page=2">2</a><a class="text-page-tag" href="/course/list?c=javascript&amp;page=3">3</a><a class="text-page-tag" href="/course/list?c=javascript&amp;page=4">4</a><a href="/course/list?c=javascript&amp;page=2">下一页</a><a href="/course/list?c=javascript&amp;page=4">尾页</a></div> -->
	</div>


	<div class="page">
		<button page="1" class="disabled_page">首页</button>
		<button id="prev" page="<?php echo $this->prev;?>" class="disabled_page">上一页</button>
		<div class="page_num" style="display: inline-block;">
		<?php for($v = 1 ; $v<=$this->pageCount ; $v = $v+1){?>
		<a   page="<?php echo isset($v)?$v:"";?>" class="text-page-tag a"><?php echo isset($v)?$v:"";?></a>
		<?php }?>
		</div>
		<button id="next" page="<?php echo $this->next;?>"  href="/course/list?c=javascript&amp;page=2">下一页</button>
		<button page="<?php echo $this->pageCount;?> href="/course/list?c=javascript&amp;page=4">尾页</button>
	</div>
		<!-- <button page="1" class="btn btn-default">首页</button>
		<button id="prev" page="<?php echo $this->prev;?>" class="btn btn-default">上一页</button>
		<button id="next" page="<?php echo $this->next;?>" class="btn btn-default">下一页</button>
		<button page="<?php echo $this->pageCount;?>" class="btn btn-default">尾页</button> -->
	<div id="demo2"></div>
	<script>
		$($(".a")[0]).addClass('active')
		$(".a").click(function(k,v){
			$(this).addClass('active');
			$(this).siblings().removeClass('active');
		})
		
		$(document).on("click",".data",function(){
			$(this).attr('check',true);
			$(this).siblings().removeAttr('check');
			changeColor($(this))


			var cid = $(this).attr('cid');
			$.ajax({
				type:'post',
				url:'<?php echo IUrl::creatUrl("course/show");?>',
				dataType:'json',
				data:{course:'course',cid:cid},
				success:function (res) {
					pages(res)
				}
			})
		})
		$(document).on("click","button,.a",function(){
			var page = $(this).attr('page');
			var keyword = $("#keyword").val();
			if (keyword == "") {
				$.each($("span"),function(k,v){
					if ($(v).attr('check') == "true") {
						cid = $(v).attr('cid');
					}
				})
				$.ajax({
					type:'post',
					url:'<?php echo IUrl::creatUrl("course/show");?>',
					dataType:'json',
					data:{course:'course',page:page,cid:cid,keyword:keyword},
					success:function(res){
						pages(res)
					}
				})
			}else{
				$.ajax({
					type:'post',
					url:'<?php echo IUrl::creatUrl("course/show");?>',
					dataType:'json',
					data:{course:'course',page:page,keyword:keyword},
					success:function(res){
						pages(res)
					}
				})
			}
			
		})
		function pages(res){
			var str = '';
			$.each(res.data,function(k,v){
					str += '<div class="course-card-container">\
					<a target="_blank" href="/course/introduction/id/1148" class="course-card">\
						<div class="course-card-top">\
							<img class="course-banner lazy" data-original="//img3.mukewang.com/5d401257087ba77b06000338-240-135.jpg" style="display: inline;" src="//img3.mukewang.com/5d401257087ba77b06000338-240-135.jpg">\
							<div class="course-teacher">\
								<div class="teacher-img" style="background-image:url("<?php echo IUrl::creatUrl("")."public/img/jj.jpg";?>")">\
								</div>\
								<span class="teacher-name">神思者l</span>\
							</div>\
						</div>\
						<div class="course-card-content">\
							<h3 class="course-card-name">'+v.course_name+'</h3>\
							<div class="clearfix course-card-bottom">\
								<div class="course-card-info">\
									<span>入门</span><span><i class="imv2-set-sns"></i>4071</span>\
								</div>\
								<p class="course-card-desc">0基础秒学告白神器，VBS版、前端版、Java版、小程序版,4款神器各取所需\
								</p>\
								<div class="course-card-price sales">\
									<div class="price-box">';
							if (v.is_vip == 1) {
								str += '\
										<span class="price red">￥8.80</span>\
										<span class="cost-price">￥69.90</span>\
										<div class="collect clearfix js-course-collect" data-cmd="follow" data-cid="1148" title="收藏"><i class="imv2-star"></i><span>收藏</span></div>\
									</div>\
									<span class="sales-tip">\
										限时优惠\
									</span>';
								}else{
									str += '\
										<span class="price red">免费</span>\
										<div class="collect clearfix js-course-collect" data-cmd="follow" data-cid="1148" title="收藏"><i class="imv2-star"></i><span>收藏</span></div>\
									</div>';
								}
									

						str += '</div>\
							</div>\
						</div>\
					</a>\
				</div>';
			})
			$("#body").html(str);
			$("#prev").attr('page',res.prev)
			$("#next").attr('page',res.next)
			$.each($(".a"),function(k,v){
				if ($(v).attr('page') == res.page) {
					$(this).addClass('active');
					$(this).siblings().removeClass('active');
				}
			})
		}
		function changeColor(_this){
			_this.siblings().css({
				"background" : "#fff",
				"border-radius" : "0px",
				"font-weight" : "normal",
				"color": "#000",
			})
			_this.css({
				"background" : "rgba(242,13,13,.06)",
				"border-radius" : "6px",
				"font-weight" : 700,
				"color": "#f20d0d",
			})
		}
		$(".direction").click(function(){
			changeColor($(this))
			var cid = $(this).attr('cid');
			// alert(pid);
			$.ajax({
				type:'post',
				url:'<?php echo IUrl::creatUrl("course/category");?>',
				dataType:'json',
				data:{cate:'cate'},
				success:function (res) {
					console.log(res)
					var str = '<span check=true class="data default">全部</span>';
					$.each(res,function(k,v){
						if (cid == 'all') {
							if (v.lv == 2){
								str += "<span cid=" + v.id + " class=data>" + v.name +"</span>";
							}
						}else{
							if (v.parent_id == cid) {
								str += "<span cid=" + v.id + " class=data>" + v.name +"</span>";
							}
						}

					})
					$("#content").html(str);
				}
			})
			$.ajax({
			type:'post',
				url:'<?php echo IUrl::creatUrl("course/show");?>',
				dataType:'json',
				data:{course:'course',pid:cid},
				success:function (res) {
					pages(res)
				}
		})
		})

	</script>
</body>
</html>