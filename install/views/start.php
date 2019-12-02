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
<link rel="shortcut icon" href="<?php echo $_baseurl;?>/install/ui/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>/install/ui/base.css">
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>/install/ui/install.css">
</head>
<body>
 <div class="install_main">
  <div class="install_menu">
   <ul>
    <li class="selected">欢迎使用DbgMs</li>
    <li>阅读协议</li>
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
    <p>感谢您使用DbgMs。DbgMs是一款轻量级的基于PHP+Mysql的管理系统。</p>
    <p>请按照说明完成安装步骤。整个过程只需要几分钟时间。</p>
    <p>如果您在安装过程中遇到问题，您可以访问<a href="http://www.dbgms.cn/" target="_blank">DbgMs官方网站</a>查询相关文档获得帮助。
    </p>
   </div>
   <div class="bottuns">
    <button type="button" onclick="window.location.href='<?php echo $_baseurl;?>/install/index.php?con=copyright'"></button>
   </div>
  </div>
 </div>
</body>
</html>
