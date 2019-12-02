<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="author" content="DbgMs管理系统_http://www.dbgms.cn/">
<title><?php echo $con_title;?>_DbgMs管理系统</title>
<meta name="description" content="该系统整合cms,erp,cms,会员,博客,论坛,电商,微信接口开发,权限管理等,功能全面,简单高效,适合各种网站的开发与拓展!">
<meta name="keywords" content="cms,erp,cms,会员,博客,论坛,电商,微信,系统,开发与拓展,简单高效">
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="<?php echo $_dbgms_baseurl;?>favicon.ico" type="image/x-icon" />
<script type="text/javascript">var dbgms_root = '<?php echo $_dbgms_baseurl;?>';</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>ui/css/dbgms.css">
<script type="text/javascript" src="<?php echo base_url()?>ui/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>ui/js/dbgms.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>ui/js/msgbox.js"></script>
<!-- 图标网址 http://www.bootcss.com/p/font-awesome/#icons-web-app -->
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>plugin/FontAwesome/font-awesome.min.css">
</head>
<body>
<?php
// date_default_timezone_set ( 'PRC' );
// sleep ( 5 ); // php脚本睡5秒
// echo date ( 'Y-m-d H:i:s', time () ); // 获取当前系统时间的时间戳
// echo '<hr />';
// echo date ( 'Y-m-d H:i:s', $_SERVER['REQUEST_TIME'] ); // 得到请求此php脚本时的时间戳
if(! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
include $views;
?>
<div style="text-align: center; padding: 20px; color: #999; margin-top: 30px;">
  <p style="line-height: 30px;">system_runtime：{elapsed_time} memory_usage：<?php echo memory_get_usage();?>（{memory_usage}）</p>
  <p class="cp">Powered by <strong><a href="http://www.dbgms.cn" target="_blank">DbgMs.cn</a></strong> <em>v2</em> © 2016
  </p>
 </div>
</body>
</html>