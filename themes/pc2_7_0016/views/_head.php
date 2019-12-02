
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $_seo['title']; ?></title>
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/style.css" />
<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/main.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/LiScroll.js"></script>

<!--[if IE 6]>
<script type="text/javascript" src=<?php echo $_uiurl;?>"js/dd_belatedpng.js"></script>
<![endif]-->
</head>
<body style="background:#fbf9e4;">
<div class="header">
  <div class="center">
    <div class="logo">
        <img src="file/logo.png" width="328" alt="" />
    </div>
    <div class="nav">
      <ul>
        <li><a href="<?php echo $_baseurl;?>" class="cur">网站首页</a></li>

          <?php foreach ($_navs as $key=>$val):?>
              <li class = <?php  echo $val['sign']==$_column?"active dropdown":"dropdown";?>>
                  <a href="<?php echo $val['link'];?>" ><?php echo $val['name'];?></a>
                  <?php if(!empty($val['list'])):?>
                      <!-- 二级栏目 -->
                      <ul class="dropdown-menu">
                          <?php foreach ($val['list'] as $val2):?>
                              <li><a href="<?php echo $val2['link'];?>"><?php echo $val2['name'];?></a></li>
                          <?php endforeach;?>
                      </ul>
                  <?php endif;?>
              </li>
          <?php endforeach;?>
      </ul>
    </div>
    <script>
		$(document).ready(function(){
		   $(".nav ul li").mouseover(function(){
		      $(this).children(".nav ul li ul").slideDown("slow");
		   });
		   $(".nav ul li").mouseleave(function(){
		      $(this).children(".nav ul li ul").slideUp("fast");
		   });
		 });
	</script>
  </div>
</div>
<div class="banner">
  <span></span>
  <ul class="slides">
      <?php $banner = getLists(1, "model|1;state|20;row|6;");?>
      <?php foreach ($banner as $key=>$val): ?>
          <li>
              <img src="<?php echo $val['slide']; ?>"  title="<?php echo $val['title']; ?>"  />
          </li>
      <?php endforeach; ?>
  </ul>
</div>
<script src="<?php echo $_uiurl;?>js/jquery.flexslider-min.js"></script>
<script>
$(function(){
  $('.banner').flexslider({
	directionNav: true,
	pauseOnAction: false
  });
});
</script>
<div class="inotice">
  <div class="center1">
	<span class="igg fl">做最好的蛋糕 只为每一个浪漫的爱情故事</span>
    <span class="itel fr">24小时咨询热线：<b>400-xxx-xxxx</b></span> </div>
</div>

