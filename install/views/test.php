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
    <li>欢迎使用DbgMs</li>
    <li>阅读协议</li>
    <li class="selected">环境测试</li>
    <li>数据库信息</li>
    <li>安装完毕</li>
    <li><a href="http://www.dbgms.cn/" target="_blank" style="font-size: 12px; color: blue;">更多信息~www.dbgms.cn</a></li>
   </ul>
  </div>
  <div class="install_content">
   <div class="title">欢迎使用DbgMs管理系统安装向导</div>
   <div class="central">
    <h1>服务器信息</h1>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
     <tr>
      <th width="150" align="left"><strong>参数</strong></th>
      <th align="left"><strong>值</strong></th>
     </tr>
     <tr>
      <td>服务器域名/IP地址</td>
      <td><?php echo $data['name']."/".$data['host']; ?></td>
     </tr>
     <tr>
      <td>服务器操作系统</td>
      <td><?php echo $data['os']; ?></td>
     </tr>
     <tr>
      <td>服务器解译引擎</td>
      <td><?php echo $data['server'];?></td>
     </tr>
     <tr>
      <td>PHP版本</td>
      <td><?php echo $data['phpv'];?></td>
     </tr>
     <tr>
      <td>安装路径</td>
      <td><?php echo dirname(_DBGMS_INSTALL_);?></td>
     </tr>
     <tr>
      <td>脚本超时时间</td>
      <td><?php echo $data['max_execution_time'];?> 秒</td>
     </tr>
    </table>
    <h1>系统环境要求</h1>
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table">
     <tr>
      <th width="230"><strong>变量函数</strong></th>
      <th width="100"><strong>系统要求</strong></th>
      <th><strong>实际状态及建议</strong></th>
     </tr>
     <tr>
      <td>GD 支持</td>
      <td>支持</td>
      <td><?php echo $data['gd'];?></td>
     </tr>
     <tr>
      <td>MySQL 支持</td>
      <td>支持</td>
      <td><?php echo $data['mysql'];?></td>
     </tr>
     <tr>
      <td>upload</td>
      <td>支持</td>
      <td><?php echo $data['uploadSize'];?></td>
     </tr>
     <tr>
      <td>session</td>
      <td>支持</td>
      <td><?php echo $data['session'];?></td>
     </tr>
    </table>
    <h1>目录权限检测</h1>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
     <tr>
      <th width="230"><strong>目录名</strong></th>
      <th width="100"><strong>系统要求</strong></th>
      <th><strong>实际状态及建议</strong></th>
     </tr>
          <?php
										foreach($data['dir_list'] as $dir)
										{
											$test_dir = dirname ( _DBGMS_INSTALL_ ) . '/' . $dir;
											if(is_writable ( $test_dir ))
											{
												$w = '<font color=green>[√]写</font>';
											}
											else
											{
												$w = '<font color=red>[×]写</font>';
												$err ++;
											}
											if(is_readable ( $test_dir ))
											{
												$r = '<font color=green>[√]读</font>';
											}
											else
											{
												$r = '<font color=red>[×]读</font>';
												$err ++;
											}
											?>
          <tr>
      <td><?php echo $dir; ?></td>
      <td>读写</td>
      <td><?php echo $r." ".$w; ?></td>
     </tr>
      <?php } ?>
        </table>
   </div>
   <div class="bottuns">
<?php if($err>0):?>
        环境不符合无法继续安装，请调试后<a href="javascript:;" onClick="window.location.reload()">刷新</a>
<?php else:?>
   <button type="button" onclick="window.location.href='<?php echo $_baseurl?>/install/index.php?con=database'"></button>
<?php endif;?>
   </div>
  </div>
 </div>
</body>
</html>
