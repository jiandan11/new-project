<?php
if(! defined ( '_DBGMS_INSTALL_' ))
{
	exit ( 'No direct script access allowed' );
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title>安装向导_DbgMs管理系统</title>
<meta name="description" content="Dbg Ms -第八感管理系统,该系统整合 cms,crm用户管理,微信接口开发,erp,权限管理等,功能全面,适合各种网站的开发与拓展!">
<meta name="keywords" content="dbgms,第八感,管理系统,cms,crm,erp,微信开发,用户管理,权限管理">
<link rel="shortcut icon" href="<?php echo $_baseurl?>/install/ui/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl?>/install/ui/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl?>/install/ui/install.css">
</head>
<body>
 <div class="install_main">
  <div class="install_menu">
   <ul>
    <li>欢迎使用DbgMs</li>
    <li class="selected">阅读协议</li>
    <li>环境测试</li>
    <li>数据库信息</li>
    <li>安装完毕</li>
    <li><a href="http://www.dbgms.cn/" target="_blank" style="font-size: 12px; color: blue;">更多信息~www.dbgms.cn</a></li>
   </ul>
  </div>
  <div class="install_content">
   <div class="title">欢迎使用 DbgMs管理系统 安装向导</div>
   <div class="central">
    <p>版权所有(C) 2015~ DbgMs.cn 保留所有权利。</p>
    <p>为了保证您和他人的利益请遵循以下几条使用规则</p>
    <p>1、您可以完全遵循本协议的情况下，将本软件用于商业用途，而不必支付软件的使用费用，但我们也不承诺对非赞助用户提供任何形式的技术支持与帮助。</p>
    <p>2、使用本程序您可以不用在明显页面保留程序版权信息，但程序最终版权归原作者所有，为了程序能持续发展建议您在网站底部注明：powered by dbgms.cn 。</p>
    <p>3、您可以免费使用本软件，但是禁止对软件进行再次发布，禁止以任何形式对DbgMs形成竞争。</p>
    <p>4、您可以对程序进行二次开发，但是二次开发后的软件也禁止公开发布，可以自己分配使用版权参考第三条。</p>
    <p>5、非赞助用户我们可能不会提供程序方面支持与改写。</p>
    <p>如果您无法遵守以上协议请立即关闭本页面，以免对您和软件方产生版权纠纷。</p>
   </div>
   <div class="bottuns">
    <button type="button" onclick="window.location.href='<?php echo $_baseurl?>/install/index.php?con=test'"></button>
   </div>
  </div>
 </div>
</body>
</html>
