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
 <?php if($data['state']=='success'):?>
  <div class="install_main">
  <div class="install_menu">
   <ul>
    <li>欢迎使用DbgMs</li>
    <li>阅读协议</li>
    <li>环境测试</li>
    <li>数据库信息</li>
    <li class="selected">安装完毕</li>
   </ul>
  </div>
  <div class="install_content">
   <div class="title">欢迎使用 DbgMs管理系统 安装向导</div>
   <div class="central">
    <p>恭喜您，成功安装 DbgMs管理系统</p>
    <p>您可以&nbsp;<a href="<?php echo $_baseurl;?>" target="_blank"> 进入首页 </a>&nbsp;
    </p>
    <p>也可以&nbsp;<a href="<?php echo $_baseurl;?>/dbgms" target="_blank">网站后台</a>&nbsp;进行设置管理
    </p>
    <p>请及时关注<a href="http://www.dbgms.cn" target="_blank">官网首页</a>了解最新的教程与程序升级。
    </p>
   </div>
  </div>
 </div>
 <?php elseif($data['state']=='loading'):?>
  <div class="install_main">
  <div class="install_menu">
   <ul>
    <li>欢迎使用DbgMs</li>
    <li>阅读协议</li>
    <li>环境测试</li>
    <li>数据库信息</li>
    <li class="selected">安装中</li>
   </ul>
  </div>
  <div class="install_content">
   <div class="title">...安装中...</div>
   <div class="central">...安装中...：<?php echo $data['msg'];?></div>
  </div>
 </div>
 <?php else:?>
 <div class="install_main">
  <div class="install_menu">
   <ul>
    <li>欢迎使用DbgMs</li>
    <li>阅读协议</li>
    <li>环境测试</li>
    <li>数据库信息</li>
    <li class="selected">安装完毕</li>
   </ul>
  </div>
  <div class="install_content">
   <div class="title">非常抱歉，程序安装失败</div>
   <div class="central">失败原因：<?php echo $data['errormsg'];?></div>
  </div>
 </div>
 <?php endif;?>
</body>
</html>
