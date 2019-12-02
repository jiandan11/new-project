<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo $_dbgms_init['base']['title'];?>-Dbg管理系统</title>
<meta name="description" content="Dbg Ms -第八感管理系统,该系统整合 cms,crm用户管理,微信接口开发,erp,权限管理等,功能全面,适合各种网站的开发与拓展!">
<meta name="keywords" content="dbgms,第八感,管理系统,cms,crm,erp,微信开发,用户管理,权限管理">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo $_dbgms_baseurl;?>ui/base/dbgms.login.css">
<script type="text/javascript" src="<?php echo $_dbgms_baseurl;?>ui/js/jquery.min.js"></script>
<style>
</style>
</head>
<body>
 <div class="login_warp">
  <div class="login_top"></div>
  <div class="login_main_warp">
   <div class="login_main">
    <input type="text" id="form_name" class="login_user" placeholder="账号" /> <input type="password" id="form_password" class="login_pwd" placeholder="密码" />
	<?php if($_dbgms_init['trait']['dbgmscaptcha']==TRUE):?>
	   <div style="float: left;">
     <input type="text" id="form_captcha" maxlength="4" name="form_captcha" class="login_check" placeholder="验证码" /> <img class="check_img" id="DbgMsLoginCaptchaImg" title="看不清楚?请点击刷新验证码" alt="看不清楚?请点击刷新验证码" />
    </div>
	<?php endif;?>
	</div>
  </div>
  <div class="login_btn">
   <input type="button" id="DbgMsLoginSubmit" value="登 陆 " class="dbgms_login_submit" />
  </div>
 </div>
 <div style="text-align: center; color: #999;">
  <a href="<?php echo $_baseurl;?>" target="_blank">网站首页</a>&nbsp;&nbsp;|&nbsp;&nbsp; Powered by <strong><a href="http://www.dbgms.cn" target="_blank">DbgMs.cn</a></strong> <em>v2</em> © 2016
 </div>
 <script type="text/javascript">
var dbgms_url ='<?php echo $_dbgms_url?>';
$(document).ready(function() {
	/* 刷新验证码 */
	var DbgMsLoginCaptchaImgObj = $('#DbgMsLoginCaptchaImg');
	DbgMsLoginCaptchaImgObj.on('click', function() {
		$('input[name=form_captcha]').val('');
		this.src = dbgms_url + 'index/captcha/login?t=' + (new Date().getTime());/* ?'+Math.random(); */
	});
	DbgMsLoginCaptchaImgObj.trigger('click');
	/* 登录 */
	var form_name = $('#form_name');
	var form_password = $('#form_password');
	var form_captcha = $('#form_captcha');
	var DbgMsLoginSubmit = $('#DbgMsLoginSubmit');
	DbgMsLoginSubmit.on('click', function() {
		if (form_name.val() == '') {
			alert('请输入用户名');
			form_name.focus();
		} else if (form_password.val() == '') {
			alert('请输入密码');
			form_password.focus();
		} else if (form_captcha.val() == '' && form_captcha != false) {
			alert('请输入验证码');
			form_captcha.focus();
		} else {
			$.ajax({
				url : dbgms_url + 'index/login/check',
				data : {
					form_name : form_name.val(),
					form_password : form_password.val(),
					form_captcha : form_captcha.val()
				},
				type : 'POST',
				async : false,
				success : function(result) {
					if (result == 1) {
						window.location.href = dbgms_url;
					} else if (result == 3) {
						alert('验证码有误！');
						DbgMsLoginCaptchaImgObj.trigger('click');
						form_captcha.focus();
						form_captcha.val('');
					} else {
						alert(result);
					}
				}
			});
		}
	});
	/* 焦点 */
	form_name.focus();
});
$(document).keyup(function(event) {
	/* 键盘事件 */
	if (event.keyCode == 13) {
		$("#DbgMsLoginSubmit").trigger("click");
		return false;
	}
});
</script>
</body>
</html>
