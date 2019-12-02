<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<title><?php echo $title;?>_DbgMs管理系统</title>
<style>
* {
	padding: 0;
	margin: 0
}

body {
	font-size: 12px;
	line-height: 1.5;
	color: #000;
}

.boxwrap {
	width: 400px;
	margin-top: 60px;
}

.box {
	border: 1px solid #ccc;
	background: #f6f6f6;
	padding: 0 10px;
	-moz-border-radius: 6px;
	-khtml-border-radius: 6px;
	-webkit-border-radius: 6px;
	border-radius: 6px;
	border-radius: 6px;
	-moz-box-shadow: rgba(0, 0, 0, 0.2) 2px 3px 3px;
	-webkit-box-shadow: rgba(0, 0, 0, 0.2) 2px 3px 3px;
	box-shadow: rgba(0, 0, 0, 0.2) 2px 3px 3px;
	filter: progid:DXImageTransform.Microsoft.Shadow(direction=155, Color=#dadada,
		Strength=3), progid:DXImageTransform.Microsoft.DropShadow(Color=#22aaaaaa,
		OffX=0, OffY=0);
}

.msg {
	padding: 18px 6px;
	color: #333
}

.href {
	border-bottom: 1px solid #ccc;
	padding-bottom: 10px;
}

.href a {
	color: #077AC7;
	text-decoration: none
}

.href a:hover {
	text-decoration: underline
}

.state {
	border-top: 1px solid #fff;
	padding: 3px 0;
	color: #bbb
}

.loader {
	width: 362px;
	height: 27px;
	border-right: 1px solid #fff;
	border-bottom: 1px solid #fff;
	position: relative;
}

.loader span {
	position: absolute;
	width: 362px;
	height: 27px;
	left: 0;
	top: 0;
	font-weight: bold;
	line-height: 30px;
	font-family: Verdana
}

.loader div {
	width: 360px;
	height: 25px;
	margin: 0 auto;
	overflow: hidden;
	background: #f8f8f8;
	border: 1px solid #bbb;
}

.loader b {
	display: block;
	height: 25px;
	float: left;
	background: #ddd;
	width: 20%;
	background: #ddd
		-moz-linear-gradient(center bottom, #dddddd 0%, #f8f8f8 100%) repeat
		scroll 0 0;
	background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0, #dddddd),
		color-stop(1, #f8f8f8));
}

.loaderp {
	width: 100%;
	text-align: center;
	padding-top: 10px;
	color: #808080
}
</style>
<script type="text/javascript">var dbgms_root = '<?php echo $_dbgms_baseurl;?>';</script>
<script type="text/javascript" src="<?php echo base_url()?>ui/js/jquery.min.js"></script>
<script type="text/javascript">function jumpto(url){
         window.location.href = url;
// 		$.ajax({ 
// 		   url:url,
// 		    type:"POST",
// 		    success:function(result){
// 		    	 $('#DbgMsBoxTitle').html(result.page);
// 		    }
// 	   });
}</script>
</head>
<body>
 <div style="text-align: center; margin: 0 auto; width: 500px; margin-top: 90px;">
  <div class="boxwrap" style="text-align: center; margin: 0 auto;">
   <div class="box">
    <div class="msg" id="DbgMsBoxTitle"><?php echo $ts;?></div>
    <div class="href">
  <?php if($extra):?>
         <?php echo $extra;?>
  <?php else:?>
         <?php if ($back=='-1'):?>
              <a href="javascript:history.go(-1);">[ 点这里返回上一页 ]</a>
     <script>//setTimeout("history.go(-1);",<?php echo $stime;?>);</script>
    	 <?php elseif ($url_back):?>
              <a href="<?php echo $url_back;?>">如果您的浏览器没有自动跳转，请点击这里</a>
     <script>setTimeout("jumpto('<?php echo $url_back;?>');",<?php echo $stime;?>);</script>
         <?php endif;?>
   <?php endif;?>
  </div>
    <div class="state">DbgMS</div>
   </div>
  </div>
 </div>
</body>
</html>