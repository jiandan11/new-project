<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php echo $_seo['title']?></title>
<meta name="description" content="<?php echo $_seo['description']?>">
<meta name="keywords" content="<?php echo $_seo['keywords']?>">

<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/style.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/upDateStyle.css" />
<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/style.js"></script>
<style type="text/css">
body {
	background-color: #f7f7f7;
	background-image: url(<?php echo $_uiurl;?>images/top.gif);
	background-repeat: repeat-x;
}
</style>
</head>
<body>

 <div id="BNreturnTopDiv"></div>
 <div class="fwtop">

  <div class="fwtop_head">
   <div class="fwtop_info"></div>
   <!--<div class="clear"></div>-->
   <div class="fwtop_logo">
    <div class="top_logo" id="top_logo">
     <a href="<?php echo $_baseurl?>"><img src="<?php echo DBG_FILEURL.$_site['logo']?>"  alt="网站Logo" title="网站logo"  style="width: <?php echo empty($_site['logow'])?219:$_site['logow'];?>px;height:<?php echo empty($_site['logoh'])?85:$_site['logoh'];?>px;" /></a>
    </div>

   </div>

   <div class="fwtop_mainNav">
    <div class="siteMainNav fwtop_nav2" id="siteMainNav">
     <ul class="fwnavlink2 clearfix">
      <li class="m m0 <?php echo $_column == '' ?'on':''?>">
       <h3><a href="<?php echo $_baseurl;?>">首页</a></h3>
      </li>         
          <?php  foreach ($_navs as $key=>$val):?>
        <li class="m m1 <?php echo $val['sign']== $_column ? 'on':"";?>">
            <h3><a href="<?php echo $val['link']?>"><?php echo $val['name']?></a></h3>
            <?php if($val['list']):?>
            <ul class="sub" style="display: none;">
                <?php  foreach ($val['list'] as $key1=>$val1):?>
                    <li><a href="<?php echo $val1['link']?>"><?php echo $val1['name']?></a></li>
             <?php endforeach;?>
            </ul>
            <?php endif;?>
           </li>
        <?php endforeach;?>
     </ul>
        
     <div class="clear"></div>
    </div>
    <script type="text/javascript">
					//navStyle("0", "2");
				</script>
   </div>
   <div class="clear"></div>
  </div>

 </div>
 <div class="fwmain">
  <div id="edit_putHere_area5" class="fwmain_total edit_putHere index_banner" saveTitle="area5">
   <div class="label slideBox slide291" id="291" rel="291" titles="幻灯片">
    <div class="bd" id="bd291">
     <ul>
         <?php $banner=getLists ( 1, "model|1;state|20;row|3;" );foreach ($banner as $val):?>
        <li><img style="width:1020px; height:491px;" src="<?php echo $val['slide'];?>" title="<?php echo $val['title'];?>"></li>
        <?php endforeach;?>
     </ul>
    </div>
    <div class="hd">
      <ul>
        <?php foreach ($banner as $key=>$val):?>
        <li><?php echo ($key+1);?></li>
        <?php endforeach;?>   
      </ul>
    </div>
       
    <a class="prev" href="javascript:void(0)"></a> <a class="next" href="javascript:void(0)"></a>
   </div>
   <script type="text/javascript">
				var ary = location.href.split("&");
				jQuery(".slide291").slide({
					mainCell : "#bd291 ul",
					effect : "fold",
					autoPlay : "true",
					trigger : "mouseover",
					easing : "swing",
					delayTime : "1000",
					mouseOverStop : "true",
					pnLoop : "true"
				});
			</script>

  </div>
