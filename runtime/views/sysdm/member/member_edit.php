<!DOCTYPE html>
<html>

<head>
    <title>后台管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
    <!--[if lt IE 9]>
	<script src="<?php echo $this->getWebViewPath()."javascript/html5shiv.min.js";?>"></script>
	<script src="<?php echo $this->getWebViewPath()."javascript/respond.min.js";?>"></script>
	<![endif]-->
    <meta name="robots" content="noindex,nofollow">
    <link rel="shortcut icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" />
    <script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script> <script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/iWebShop5.5/runtime/_systemjs/artdialog/skins/black.css" /> <script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/form/form.js"></script> <script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/iWebShop5.5/runtime/_systemjs/autovalidate/style.css" /> <script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script> <script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/cookie/jquery.cookie.js"></script>
    <script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/twitter-bootstrap/3.3.7/js/bootstrap.min.js";?>"></script>
    <script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/adminlte.min.js";?>"></script>
    <script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>"></script>
</head>

<body class="skin-blue fixed sidebar-mini" style="height: auto; min-height: 100%;">
    <div class="wrapper" style="height: auto; min-height: 100%;">
        <header class="main-header">
            <div class="logo">
                <span class="logo-mini"><b>iWeb</b></span>
                <span class="logo-lg"><b>iWebShop</b>后台管理</span>
            </div>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only"></span>
                </a>

                <!--顶部菜单 开始-->
                <div id="menu" class="navbar-custom-menu">
                    <ul class="nav navbar-nav" name="topMenu">
                        <?php $menuData=menu::init($this->admin['role_id']);?>
                        <?php foreach($items=menu::getTopMenu($menuData) as $key => $item){?>
                        <li><a hidefocus="true" href="<?php echo IUrl::creatUrl("".$item."");?>"><?php echo isset($key)?$key:"";?></a></li>
                        <?php }?>
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
                 <!--顶部菜单 结束-->
            </nav>
        </header>

		<!--左侧菜单 开始-->
        <aside id="admin_left" class="main-sidebar">
            <section class="sidebar" style="height: auto;">
                <div class="user-panel">
                    <div class="pull-left image">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="pull-left info">
                        <p><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></p>
                        <a href="#"><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></a>
                    </div>
                </div>

                <?php $leftMenu=menu::get($menuData,IWeb::$app->getController()->getId().'/'.IWeb::$app->getController()->getAction()->getId());$modelName = key($leftMenu);$modelValue = current($leftMenu);?>
                <ul class="sidebar-menu tree" data-widget="tree">
                    <li class="header"><?php echo isset($modelName)?$modelName:"";?>模块菜单</li>
                    <?php foreach($items=$modelValue as $key => $item){?>
                    <li class="treeview">
                        <a href="#">
                        	<i class="fa" name="ico" menu="<?php echo isset($key)?$key:"";?>"></i>
                            <span><?php echo isset($key)?$key:"";?></span>
                            <span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
                        </a>
                        <ul class="treeview-menu" name="leftMenu">
                            <?php foreach($items=$item as $leftKey => $leftValue){?>
                            <li><a href="<?php echo IUrl::creatUrl("".$leftKey."");?>"><i class="fa fa-circle-o"></i><?php echo isset($leftValue)?$leftValue:"";?></a></li>
                            <?php }?>
                        </ul>
                    </li>
                    <?php }?>

                    <?php foreach($items=Api::run('getQuickNavigaAll') as $key => $item){?>
                    <li class="header">快速导航</li>
                    <li><a href="<?php echo isset($item['url'])?$item['url']:"";?>"><i class="fa fa-star-o"></i> <span><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></span></a></li>
                    <?php }?>
                </ul>
            </section>
        </aside>
        <!--左侧菜单 结束-->

		<!--右侧内容 开始-->
        <div id="admin_right" class="content-wrapper">
            <script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/editor/kindeditor-min.js"></script><script type="text/javascript">window.KindEditor.options.uploadJson = "/iWebShop5.5/index.php?controller=pic&action=upload_json";</script>
<script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type="text/javascript" charset="UTF-8" src="/iWebShop5.5/runtime/_systemjs/areaSelect/areaSelect.js"></script>
<div class="breadcrumbs" id="breadcrumbs">
	<ul class="breadcrumb">
		<li>
			<i class="home-icon fa fa-home"></i>
			<a href="#">会员</a>
		</li>
		<li>
			<a href="#">会员管理</a>
		</li>
		<li class="active">编辑会员</li>
	</ul>
</div>
<div class="content">
	<form action="<?php echo IUrl::creatUrl("/member/member_save");?>" method="post" name="memberForm">
		<input name="user_id" value="" type="hidden" />
		<table class="table form-table">
			<colgroup>
				<col width="130px" />
				<col />
			</colgroup>

			<tbody>
				<tr>
					<th>用户名：</th>
					<td><input class="form-control" name="username" type="text" value="" pattern="required" placeholder="用户名不能为空" /></td>
				</tr>
				<tr>
					<th>邮箱：</th>
					<td><input type="text" class="form-control" name="email" pattern="email" empty /></td>
				</tr>
				<tr>
					<th>密码：</th><td><input class="form-control" name="password" type="password" /></td>
				</tr>
				<tr>
					<th>确认密码：</th><td><input class="form-control" name="repassword" type="password" /></td>
				</tr>
				<tr>
					<th>会员组：</th>
					<td>
						<select class="form-control" name="group_id">
							<option value=''>请选择</option>
                            <?php foreach($items=Api::run('getUserGroupListAll') as $key => $item){?>
							<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['group_name'])?$item['group_name']:"";?></option>
							<?php }?>
						</select>
					</td>
				</tr>
				<tr>
					<th>姓名：</th>
					<td><input class="form-control" name="true_name" type="text" value="" placeholder="真实的姓名" /></td>
				</tr>
				<tr>
					<th>性别：</th>
					<td>
                        <label class="radio-inline">
                            <input type="radio" name="sex" value="1" checked=checked>男
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="sex" value="2">女
                        </label>
					</td>
				</tr>
				<tr>
					<th>电话：</th><td><input class="form-control" name="telephone" type="text" value="" empty pattern="phone" placeholder="固定座机号码如010-66668888-123" /><p class="help-block">格式：（地区号-）用户号（-分机号）如010-66668888-123</p></td>
				</tr>
				<tr>
					<th>手机：</th><td><input class="form-control" name="mobile" type="text" value="" empty pattern="mobi" placeholder="手机号码" /></td>
				</tr>
				<tr>
					<th>地区：</th>
					<td>
                        <div class="row">
                            <div class="col-xs-3">
                                <select name="province" class="form-control" child="city,area"></select>
                            </div>
                            <div class="col-xs-3">
                                <select name="city" class="form-control" child="area"></select>
                            </div>
                            <div class="col-xs-3">
                                <select name="area" class="form-control"></select>
                            </div>
                        </div>
					</td>
				</tr>
				<tr>
					<th>地址：</th><td><input class="form-control" name="contact_addr" type="text" value="" /></td>
				</tr>
				<tr>
					<th>邮编：</th><td><input class="form-control" name="zip" type="text" value="" empty pattern="zip"  /></td>
				</tr>
				<tr>
					<th>QQ：</th><td><input class="form-control" name="qq" type="text" value="" empty pattern="qq"  /></td>
				</tr>
				<tr>
					<th>经验值：</th><td><input class="form-control" name="exp" type="text" value="" /></td>
				</tr>
				<tr>
					<th>积分：</th><td><input class="form-control" name="point" type="text" value="" /></td>
				</tr>
				<tr>
					<th>状态：</th>
					<td>
						<select name="status" class="form-control">
							<option value="1">正常</option>
							<option value="2">删除</option>
							<option value="3">锁定</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td><td><button class='btn btn-primary' type="submit">确 定</button></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<script language="javascript">
//DOM加载完毕
$(function(){
var areaInstance = new areaSelect('province');

//修改模式
var formObj = new Form('memberForm');
formObj.init(<?php echo JSON::encode($userData);?>);

//地区初始化
<?php if($userData && $userData['area']){?>
<?php $area = explode(',',trim($userData['area'],','))?>
areaInstance.init({"province":"<?php echo isset($area[0])?$area[0]:"";?>","city":"<?php echo isset($area[1])?$area[1]:"";?>","area":"<?php echo isset($area[2])?$area[2]:"";?>"});
<?php }else{?>
areaInstance.init();
<?php }?>
});
</script>
        </div>
        <!--右侧内容 结束-->

		<!--顶部弹出菜单 开始-->
	    <aside class="control-sidebar control-sidebar-dark">
	        <ul class="control-sidebar-menu">
	            <li><a href="<?php echo IUrl::creatUrl("/admin/logout");?>"><i class="fa fa-circle-o text-red"></i> 退出管理</a></li>
	            <li><a href="<?php echo IUrl::creatUrl("/system/admin_repwd");?>"><i class="fa fa-circle-o text-yellow"></i> 修改密码</a></li>
	            <li><a href="<?php echo IUrl::creatUrl("/system/default");?>"><i class="fa fa-circle-o text-green"></i> 后台首页</a></li>
	            <li><a href="<?php echo IUrl::creatUrl("");?>" target='_blank'><i class="fa fa-circle-o text-aqua"></i> 商城首页</a></li>
	            <li><a href="<?php echo IUrl::creatUrl("/system/navigation");?>"><i class="fa fa-circle-o"></i> 快速导航</a></li>
	        </ul>
	    </aside>
	    <!--顶部弹出菜单 结束-->
    </div>
</body>
<script type='text/javascript'>
//图标配置
var icoConfig = {"商品管理":"fa-inbox","商品分类":"fa-list","品牌":"fa-registered","模型":"fa-cubes","搜索":"fa-search","会员管理":"fa-user-o","商户管理":"fa-group","信息处理":"fa-comment-o","订单管理":"fa-file-text","单据管理":"fa-files-o","发货地址":"fa-address-card-o","促销活动":"fa-bullhorn","营销活动":"fa-bell-o","优惠券管理":"fa-ticket","基础数据统计":"fa-bar-chart-o","后台首页":"fa-home","日志操作记录":"fa-file-code-o","商户数据统计":"fa-pie-chart","支付管理":"fa-credit-card","第三方平台":"fa-share-alt","配送管理":"fa-truck","地域管理":"fa-street-view","权限管理":"fa-unlock-alt","数据库管理":"fa-database","文章管理":"fa-file-o","帮助管理":"fa-question-circle-o","广告管理":"fa-flag","公告管理":"fa-bookmark-o","网站地图":"fa-sitemap","插件管理":"fa-cogs","网站管理":"fa-wrench"};
$('i[name="ico"]').each(function()
{
	var menuName = $(this).attr('menu');
	if(menuName && icoConfig[menuName])
	{
		$(this).addClass(icoConfig[menuName]);
	}
	else
	{
		//默认图标
		$(this).addClass("fa-circle");
	}
});

//兼容IE系列
$("[name='leftMenu'] [href^='javascript:']").each(function(i)
{
	var fun = $(this).attr('href').replace("javascript:","");
	$(this).attr('href','javascript:void(0)');
	$(this).on("click",function(){eval(fun)});
});

//按钮高亮
var topItem = "<?php echo $modelName;?>";
$("[name='topMenu']>li:contains('"+topItem+"')").addClass("active");

//获取左侧菜单项
function matchLeftMenu(leftItem)
{
    var matchObject = $('[name="leftMenu"]>li a[href="'+leftItem+'"]');
    if(matchObject.length > 0)
    {
        $.cookie('lastUrl', leftItem);
        return matchObject;
    }

    var lastUrl = $.cookie('lastUrl');
    if(lastUrl)
    {
        return $('[name="leftMenu"]>li a[href="'+lastUrl+'"]');
    }
    return null;
}

//左边栏菜单高亮
var leftItem   = "<?php echo IUrl::getUri();?>";
var matchObject = matchLeftMenu(leftItem);
if(matchObject)
{
    matchObject.parent().addClass("active").parent('ul').show().parent('.treeview').addClass('menu-open');
}
</script>
</html>