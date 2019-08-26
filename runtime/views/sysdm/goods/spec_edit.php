<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>规格修改</title>
<script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iWebShop5.5/runtime/_systemjs/artdialog/skins/black.css" />
<script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/form/form.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/iWebShop5.5/runtime/_systemjs/autovalidate/style.css" />
<script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type='text/javascript' src='<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>'></script>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<link rel="stylesheet" href="<?php echo IUrl::creatUrl("")."public/css/twitter-bootstrap/3.3.7/css/bootstrap.min.css";?>">
</head>

<body style="width:400px;min-height: 460px;">
<div class="container">
	<form action='<?php echo IUrl::creatUrl("/goods/spec_update");?>' method='post' id='specForm' name='specForm'>
		<input type="hidden" name="seller_id" value="<?php echo isset($seller_id)?$seller_id:"";?>" />
		<input type="hidden" name="id" value="<?php echo isset($id)?$id:"";?>" />

		<div class="form-group">
			<label class="control-label">规格名称：</label>
			<input class="form-control" name="name" style="width:auto" value="<?php echo isset($name)?$name:"";?>" type="text" pattern="required" alt="名字不能为空" />
		</div>

		<div class="form-group">
			<label class="control-label">显示类型：</label>
			<div>
				<label class="radio-inline"><input name="type" type="radio" value="1" <?php if($type==1 || $type==null){?>checked=checked<?php }?> onchange="changeType();" />文字</label>
				<label class="radio-inline"><input name="type" type="radio" value="2" <?php if($type==2){?>checked=checked<?php }?> onchange="changeType();" />图片</label>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label">说明：</label>
			<input class="form-control" type="text" style="width:auto" name="note" value="<?php echo isset($note)?$note:"";?>" />
		</div>

		<div class="form-group">
			<button type="button" class="btn btn-default" onclick="addSpec();"><span class="glyphicon glyphicon-plus"></span> 添加规格</button>
		</div>

		<div class="table-responsive">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th>规格值</th>
						<th>提示信息(非重复)</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody id='spec_box'></tbody>
			</table>
		</div>
	</form>
</div>

<!--规格模板-->
<script id="specTemplate" type='text/html'>
<tr>
	<td>
		<%var textType = type == 1 ? "show":"none";%>
		<%var imgType  = type == 2 ? "show":"none";%>

		<input style="display:<%=textType%>;" type="text" class="form-control" name="showText[]" value="<%if(type == 1){%><%=show%><%}%>" pattern="required" />

		<div style="display:<%=imgType%>" name="imageBox" class="text-center">
			<div class="imgbox"><img class="img-thumbnail" src='<%=webroot(show)%>' width='50px' height='50px' <%if(!show || type != 2){%>style="display:none;"<%}%> /></div>
			<input type="hidden" name="showImage[]" value="<%if(type == 2){%><%=show%><%}%>" />
			<button type="button" class="btn btn-default" onclick="photoUpload(this);">选择图片</button>
		</div>
	</td>
	<td>
		<input type="text" class="form-control" name="valueData[]" value="<%=value%>" pattern="required" />
	</td>
	<td>
		<button alt="向上" onclick="upChange(this);" type="button"><span class="glyphicon glyphicon-arrow-up"></span></button>
		<button alt="向下" onclick="downChange(this);" type="button"><span class="glyphicon glyphicon-arrow-down"></span></button>
		<button alt="删除" onclick="delItem(this);" type="button"><span class="glyphicon glyphicon-remove"></span></button>
	</td>
</tr>
</script>

<script type='text/javascript'>
//页面加载
jQuery(function()
{
	var specValue = <?php echo $value ? $value : "[]";?>;
	for(var index in specValue)
	{
		var data = {"type":"<?php echo isset($type)?$type:"";?>","value":index,"show":specValue[index]};
		$('#spec_box').append(template('specTemplate', data));
	}
});
//切换规格方式
function changeType()
{
	$('[name="showText[]"]').toggle();
	$('[name="imageBox"]').toggle();
}

//向上移动
function upChange(_self)
{
	var toIndex = $(_self).closest("tr").prev().index();
	$('#spec_box tr:eq('+toIndex+')').before($(_self).closest("tr"));
}

//向下移动
function downChange(_self)
{
	var toIndex = $(_self).closest("tr").next().index();
	$('#spec_box tr:eq('+toIndex+')').after($(_self).closest("tr"));
}

//删除自身
function delItem(_self)
{
	art.dialog.confirm('确定要删除么？',function(){$(_self).closest('tr').remove();});
}

//添加规格数据
function addSpec()
{
	var type = $('[name="type"]:checked').val();
	var data = {"type":type};
	$('#spec_box').append(template('specTemplate', data));
}

//规格图片上传回调函数
function updatePic(indexValue,srcValue)
{
	var imageUrl = webroot(srcValue);
	$('#spec_box tr:eq('+indexValue+')').find(".img-thumbnail").attr("src",imageUrl);
	$('#spec_box tr:eq('+indexValue+')').find(".img-thumbnail").show();
	$('#spec_box tr:eq('+indexValue+')').find("[name='showImage[]']").val(srcValue);
	art.dialog({id:'uploadIframe'}).close();
}

//上传按钮html
function photoUpload(_self)
{
	var specIndex = $(_self).closest("tr").index();
	var tempUrl = '<?php echo IUrl::creatUrl("/block/pic/specIndex/@specIndex@");?>';
	tempUrl     = tempUrl.replace('@specIndex@',specIndex);
	art.dialog.open(tempUrl,
	{
		'id':"uploadIframe",
		'title':'选择图片上传的方式',
		'ok':function(iframeWin, topWin)
		{
	    	iframeWin.document.forms[0].submit();
	    	return false;
		}
	});
}
</script>
</body>
</html>
