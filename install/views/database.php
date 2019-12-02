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
<script type="text/javascript" src="<?php echo $_baseurl?>/install/ui/jquery.min.js"></script>
</head>
<body>
 <div class="install_main">
  <div class="install_menu">
   <ul>
    <li>欢迎使用DbgMs</li>
    <li>阅读协议</li>
    <li>环境测试</li>
    <li class="selected">数据库信息</li>
    <li>安装完毕</li>
    <li><a href="http://www.dbgms.cn/" target="_blank" style="font-size: 12px; color: blue;">更多信息~www.dbgms.cn</a></li>
   </ul>
  </div>
  <div class="install_content">
   <div class="title">欢迎使用 DbgMs管理系统 安装向导</div>
   <form action="<?php echo $_baseurl?>/install/index.php?con=install" method="post" id="form">
    <div class="central">
     <div class="m-form">
      <fieldset>
       <div class="formitm">
        <label class="lab">数据库主机：</label>
        <div class="ipt">
         <input name="DB[DB_HOST]" type="text" class="u-ipt" id="DB_HOST" value="localhost" style="width: 185px;" onblur="test_data()" /> <input name="DB[DB_PORT]" type="text" class="u-ipt" id="DB_PORT" value="3306" style="width: 100px;" onblur="test_data()" />
        </div>
       </div>
       <div class="formitm">
        <label class="lab">用户名：</label>
        <div class="ipt">
         <input name="DB[DB_USER]" type="text" class="u-ipt" id="DB_USER" value="root" onblur="test_data()" />
        </div>
       </div>
       <div class="formitm">
        <label class="lab">密码：</label>
        <div class="ipt">
         <input name="DB[DB_PWD]" type="text" class="u-ipt" id="DB_PWD" value="" onblur="test_data()" />
        </div>
       </div>
       <div class="formitm">
        <label class="lab">数据库名：</label>
        <div class="ipt">
         <input name="DB[DB_NAME]" type="text" class="u-ipt" id="DB_NAME" value="" style="width: 185px;" onblur="test_data()" /> &nbsp;&nbsp;&nbsp;<input name="create" id="create" type="checkbox" value="1" checked="checked" onclick="test_data()"> 创建
        </div>
       </div>

       <!--   <div class="formitm">
        <label class="lab">表前缀：</label>
        <div class="ipt">
         <input name="DB[DB_PREFIX]" type="text" class="u-ipt" id="DB_PREFIX" value="dbg_" />
        </div>
       </div>
       <div class="formitm">
        <label class="lab">COOKIE特征码：</label>
        <div class="ipt">
         <input name="APP[COOKIE_PREFIX]" type="text" class="u-ipt" value="<?php echo md5(5); ?>_" />
        </div>
       </div>
       <div class="formitm">
        <label class="lab">安全加密码：</label>
        <div class="ipt">
         <input name="APP[SAFE_KEY]" type="text" class="u-ipt" value="<?php echo md5(20); ?>" />
        </div>
       </div>-->
       <div class="formitm">
        <label class="lab">安装测试数据：</label>
        <div class="ipt">
         <input name="test" type="checkbox" value="1" checked> 安装
        </div>
       </div>
      </fieldset>
     </div>
    </div>
    <div class="bottuns">
     <div class="msg">
      <span style="color: #666">请先填写信息...</span>
     </div>
    </div>
   </form>
  </div>
 </div>
 <script type="text/javascript">
 
function test_data(){
	 val=$('#create').attr("checked");
     if(val){
		 create=1;
     }else{
     	create=0;
     } 
	 $.post('<?php echo $_baseurl?>/install/index.php?con=test_data',
	 {
		 DB_HOST:$('#DB_HOST').val(),
		 DB_PORT:$('#DB_PORT').val(),
		 DB_NAME:$('#DB_NAME').val(),
		 DB_USER:$('#DB_USER').val(),
		 DB_PWD:$('#DB_PWD').val(),
		 create:create
	 },
	 function(html){
		 if(html==1){
			 $('.msg').html('<button  type="submit" > </button>');
		 }else{
			 $('.msg').html('<span style="color:red">'+html+'</span>');
		 }
	 },'html');
}

</script>
</body>
</html>
