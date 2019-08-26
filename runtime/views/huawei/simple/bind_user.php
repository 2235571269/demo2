<!DOCTYPE html>
<html lang="zh-CN" class="bg_cff">
<head>
	<title>第三方登录_<?php echo $this->_siteConfig->name;?></title>
	<meta charset="UTF-8">
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/autovalidate/validate.js?v=5.1"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/artdialog/skins/black.css" />
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."style/style.css";?>">
</head>
<body>

<header class="web">
	<h1 class="logo">
		<a href="<?php echo IUrl::creatUrl("");?>" title="<?php echo $this->_siteConfig->name;?>">
			<img src="<?php if($this->_siteConfig->logo){?><?php echo IUrl::creatUrl("")."".$this->_siteConfig->logo."";?><?php }else{?><?php echo $this->getWebSkinPath()."image/logo.png";?><?php }?>">
		</a>
	</h1>
</header>

<section class="web">
	<?php $type = IReq::get('bind_type')?>
	<?php if($type == 'exists'){?>
	<header class="login_header">
		<h3>登录已有账号进行绑定</h3>
		<p>绑定已有账号信息，您可以直接把第三方登录的用户信息与您已经注册过的账号进行绑定</p>
	</header>
	<section class="reg_box">
		<form action='<?php echo IUrl::creatUrl("/simple/bind_exists_user");?>' method='post' class="form-horizontal">
			<dl>
				<dt>用户名/邮箱/手机号：</dt>
				<dd><input type="text" name="login_info" class="input_text" pattern="required" alt="请输入正确的用户名或者邮箱地址"></dd>
			</dl>
			<dl>
				<dt>密码：</dt>
				<dd><input type="password" name='password' class="input_text" pattern="^\S{4,20}$" alt="请输入正确的密码4-20个字符" /></dd>
			</dl>
			<dl>
				<dt></dt>
				<dd>
					<input type="submit" value="登录绑定" class="input_submit" />
					<input type="button" value="没有账号" class="input_reset" onclick="window.location.href='<?php echo IUrl::creatUrl("/simple/bind_user");?>';" />
				</dd>
			</dl>

		</form>
	</section>
	<?php }else{?>
	<header class="login_header">
		<h3>完善基本的账号信息</h3>
		<p>完善了基本信息后，您可以直接把第三方登录的用户信息与您的注册账号进行绑定</p>
	</header>
	<section class="reg_box">
		<form action='<?php echo IUrl::creatUrl("/simple/bind_not_exists_user");?>' method='post' class="form-horizontal">
			
			<dl>
				<dt>邮箱：</dt>
				<dd>
					<input class="input_text" type="text" name='email' pattern="email" alt="填写正确的邮箱格式" />
					<span>填写正确的邮箱格式</span>
				</dd>
			</dl>
			
			<dl>
				<dt>用户名：</dt>
				<dd>
					<input class="input_text" name='username' type="text" value="<?php echo isset($email)?$email:"";?>" pattern="^[\w\u0391-\uFFE5]{2,20}$" alt="填写2-20个字符，可以为字母、数字、下划线和中文" />
					<span>格式为2-20个字符，可以为字母、数字、下划线和中文</span>
				</dd>
			</dl>
			<dl>
				<dt>设置密码：</dt>
				<dd>
					<input class="input_text" type="password" name='password' pattern="^\S{6,32}$" bind='repassword' alt='填写6-32个字符' />
					<span>填写登录密码，6-32个字符</span>
				</dd>
			</dl>
			<dl>
				<dt>确认密码：</dt>
				<dd>
					<input class="input_text" type="password" name='repassword' pattern="^\S{6,32}$" bind='password' alt='重复上面所填写的密码' />
					<span>重复上面所填写的密码</span>
				</dd>
			</dl>
			<dl>
				<dt>验证码：</dt>
				<dd>
					<input class='input_text' type='text' name='captcha' pattern='^\w{5,10}$' alt='填写图片所示的字符' />
					<img src='<?php echo IUrl::creatUrl("/simple/getCaptcha");?>' id='captchaImg' onclick="changeCaptcha();" />
					<span>填写图片所示的字符</span>
				</dd>
			</dl>
			<?php if($this->_siteConfig->reg_option == 3){?>
			<dl>
				<dt>手机号：</dt>
				<dd>
					<input class="input_text" type="text" name='mobile' pattern="mobi" alt="填写正确的手机格式" />
					<span>填写正确的手机格式</span>
				</dd>
			</dl>
			<dl>
				<dt>手机验证：</dt>
				<dd>
					<input class='input_text w100' type='text' name='mobile_code' pattern='^\w{4,6}$' />
					<input class="input_button" onclick="_sendMobileCode(this);" type="button" value="获取验证码" />
					<span>填写手机短信验证码</span>
				</dd>
			</dl>
			<?php }?>
			<dl>
				<dt></dt>
				<dd>
					<input type="submit" value="登录绑定" class="input_submit" />
					<input type="button" value="我有账号" class="input_reset" onclick="window.location.href='<?php echo IUrl::creatUrl("/simple/bind_user/bind_type/exists");?>';" />
				</dd>
			</dl>
		</form>
	</section>
	<?php }?>
</section>


</body>
</html>
