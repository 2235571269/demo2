<section class="web">
	<header class="login_header">
		<h3>已注册用户，请登录</h3>
		<p>欢迎来到我们的网站，如果您已是本站会员请登录</p>

	</header>
	<section class="login_box">
		<form action='<?php echo IUrl::creatUrl("/user/login");?>' method='post'>
			<?php if($this->getError()){?>
			<div class="prompt">
				<?php echo $this->getError();?>
			</div>
			<?php }?>
			<dl>
				<dt>用户名/邮箱/手机：</dt>
				<dd><input class="input_text" type="text" name="login_info" value="<?php echo ICookie::get('loginName');?>" pattern='required' alt='填写用户名或邮箱' /></dd>
			</dl>
			<dl>
				<dt>密码：</dt>
				<dd><input class="input_text" type="password" name="password" pattern='^\S{6,32}$' alt='填写密码' /></dd>
			</dl>
			<dl>
				<dt></dt>
				<dd>
					<label><input type="checkbox" name="remember" value='1'> 记住登录名</label>
					<a class="getpassowrd_link" href="<?php echo IUrl::creatUrl("/simple/find_password/");?>"><i class="fa fa-lock"></i>忘记密码</a>
				</dd>
			</dl>
			<?php $items=Api::run('getOauthList')?>
			<?php if($items){?>
			<dl>
				<dt></dt>
				<dd>
					<?php foreach($items as $key => $item){?>
					<a href="<?php echo IUrl::creatUrl("/simple/oauth_login/id/".$item['id']."");?>"><img src='<?php echo IUrl::creatUrl("")."".$item['logo']."";?>' /></a>
					<?php }?>
				</dd>
			</dl>
			<?php }?>
			<dl>
				<dt></dt>
				<dd><input class="input_submit" type="submit" value="登录" /></dd>
				<a href="<?php echo IUrl::creatUrl("/simple/abc");?>"><img src="<?php echo IUrl::creatUrl("")."public/img/qq.png";?>" alt=""></a>
			</dl>
		</form>
		<?php if(IReq::get('tourist') === null){?>
		<div class="login_show">
			<p><strong>您还不是 <span><?php echo $this->_siteConfig->name;?></span> 用户</strong></p>
			<p>现在免费注册成为<?php echo $this->_siteConfig->name;?>商城用户，便能立即享受便宜又放心的购物乐趣。<a href="<?php echo IUrl::creatUrl("");?>">网站首页>></a></p>
			<p><a class="reg_btn" href="<?php echo IUrl::creatUrl("/simple/reg");?>">注册新用户</a></p>
		</div>
		<?php }else{?>
		<div class="login_show">
			<p>
				<strong>您还不是 <span><?php echo $this->_siteConfig->name;?></span> 用户</strong><br>
				<em>使用游客身份结账或注册</em>
			</p>
			<p><label class="attr"><input class="radio" type='radio' name='next_step' value='acount' />使用游客身份结账</label></p>
			<p><label class="attr"><input class="radio" type='radio' name='next_step' value='reg' checked='checked' />注册新用户</label></p>
			<p>现在免费注册成为 <?php echo $this->_siteConfig->name;?> 商城用户，便能立即享受便宜又放心的购物乐趣。<a href="<?php echo IUrl::creatUrl("");?>">网站首页>></a></p>
			<p><a class="next_step" href="javascript:next_step();">下一步</a></p>
		</div>
		<?php }?>
	</section>
</section>
<script>

//下一步操作
function next_step(){
	var step_val = $('[name="next_step"]:checked').val();
	if(step_val == 'acount'){
		<?php $url = plugin::trigger('getCallback')."/tourist/yes"?>
		window.location.href = '<?php echo IUrl::creatUrl("".$url."");?>';
	}
	else if(step_val == 'reg'){
		window.location.href = '<?php echo IUrl::creatUrl("/simple/reg");?>';
	}
}
</script>
