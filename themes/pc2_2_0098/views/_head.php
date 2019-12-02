<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta name="format-detection" content="telephone=no" />
<!--[if lte IE 7]><script>window.location.href='/manager/ie6.html?referrer='+location.href;</script><![endif]-->

<title><?php echo $_seo['title']; ?></title>
<meta content="<?php echo $_seo['title']; ?>" name="keywords"/>
<meta content="<?php echo $_seo['title']; ?>" name="description"/>
<link href="<?php echo $_uiurl;?>images/favicon.ico" type="image/x-icon" rel="icon">
<link href="<?php echo $_uiurl;?>images/favicon.ico" type="image/x-icon" rel="shortcut icon">
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/common.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/style.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/upDateStyle.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/coupon.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/animate.min.css" />
<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/offlights.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/ckplayer.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/md5.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/updateStyle.js"></script>
<script src="<?php echo $_uiurl;?>js/jquery.SuperSlide.source.js"></script>
<script src="<?php echo $_uiurl;?>js/layer.js"></script>
<script src="<?php echo $_uiurl;?>js/laypage.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/layer.ext.js"></script>
<script src="<?php echo $_uiurl;?>js/style.asp"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/wow.min.js"></script>
<script>new WOW().init();</script>
<script type="text/javascript">
window.top["BNPage"]=0;
</script>
<style type="text/css">
    body {
        width: 1200px;
        margin: 0 auto;
        background:url(<?php echo $_uiurl;?>images/bright_squares.png) repeat;
    }
    html {
        overflow-x: hidden;
        overflow-y: auto;
    } /*用来隐藏html的滚动条*/
    .fwtop {
        background: none repeat scroll 0 0;
    }
    .fwbottom {
        background: none repeat scroll 0 0;
    }
    .navBarUlStyle48 li{;;}
    .navBarUlStyle48 .on{background-color:#525252;;}
    .navBarUlStyle48 .on a{color:#ffffff;}
    .navBarUlStyle48 li a{color:#ffffff;;}
    .navBarUlStyle48 li a:hover{color:#ffffff;}

</style>
</head>
<body  onLoad="setTimeout(function() { window.scrollTo(0, 1) }, 100);">
<div id="BNreturnTopDiv"></div>
<div class="fwtop" style="position:relative;height:516px;width:100%;min-height:30px;" rel="5">
  <div class="edit_putHere  tLan" rel="46" id="46" saveTitle="area46" style="height:90px;z-index:auto;top:0px;position:absolute;background-color: rgb(4,185,192); ">
    <div class="label advertising " id="47" rel="47" titles="图片"  usestate="1" style='width:250px;height:70px;z-index:100;left:23px;top:13px;position:absolute;margin-left:0px;'>
      <div class="advContent picture47">
          <img width="100%" height="100%" src="<?php echo $_uiurl;?>images/8bf20d27-b11c-468e-b0b5-92a988d8d612_0_70.png" alt=""/>
      </div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('47','23')});
    </script>
    <div class="label " id="48" rel="48" titles="导航菜单"  usestate="1" style='height:90px;z-index:100;left:300px;top:0px;position:absolute;margin-left:0px;' DH="0">
      <ul class="navBarUlStyle navBarUlStyle48" style="border-radius:0px; -moz-border-radius:0px; -webkit-border-radius:0px;font-family:Microsoft YaHei;display:table-cell;vertical-align:middle;">
          <li style="width:120px;height:90px;line-height:90px;border-radius:0px; -moz-border-radius:0px; -webkit-border-radius:0px;float:left;display:inline-block;text-align:center;" class="<?php  echo$_column==''?'m on':'m';?> ">
              <a class="" style="font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;width:120px;height:90px;display:block;"  bid="553"  href="<?php echo $_baseurl;?>">首页</a>
          </li>
          <?php foreach ($_navs as $key=>$val):?>
              <li style="width:120px;height:90px;line-height:90px;border-radius:0px; -moz-border-radius:0px; -webkit-border-radius:0px;float:left;display:inline-block;text-align:center;" class="<?php  echo $val['sign']==$_column?"m on":"m";?> ">
                  <a class="" style="font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;width:120px;height:90px;display:block;"  bid="<?php echo ($key + 554) ?>"  href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
              </li>
          <?php endforeach;?>
      </ul>
      <div class="clear"></div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('48','473.5')});
    </script>
  </div>
  <div class="edit_putHere  tLan" rel="49" id="49" saveTitle="area49" style="height:427px;z-index:auto;top:89px;position:absolute; ">
    <div class="label slideBox slide50" id="50" rel="50" titles="幻灯片"  usestate="1" style='width:100%;height:427px;z-index:100;left:-111.5px;top:0px;position:absolute;margin-left:0px;'>
      <div class="hd">
        <ul>
            <?php $banner = getLists(1, "model|1;state|20;row|6;");
            foreach ($banner as $key=>$val): ?>
                <li><?php echo $key; ?></li>
            <?php endforeach; ?>
        </ul>
      </div>
      <div class="bd" id="bd50">
        <ul>
            <?php foreach ($banner as $key=>$val): ?>
                <li>
                    <div style="text-align:center;">
                        <img style="width:100%; height:427px;text-align:center;display:table-cell" src="<?php echo $val['slide']; ?>" alt=""/>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
      </div>
      <a class="prev" href="#"></a> <a class="next" href="#"></a> </div>
    <script type="text/javascript">
        $(function(){
            var ary = location.href.split(" &");
            jQuery(".slide50").slide( { mainCell:"#bd50 ul", effect:"leftLoop",autoPlay:"true",trigger:"mouseover",easing:"swing",delayTime:"1000",mouseOverStop:"true",pnLoop:"true",interTime:"5000"});
            var labelWidth = $(".slide50").width();
            var winW = $(window).width();
            var bodyWidth = $(".fwtop,.fwmain,.fwbottom").width();
            var slideWidth = winW > bodyWidth ? winW :bodyWidth;
            if (labelWidth >= slideWidth)
            {
            $(".slide50").css({"width":slideWidth + "px"});
            }
            var hd_li_length = $(".slide50 .hd ul li").length;
            var hd_length = hd_li_length*30 + (hd_li_length-1)*3;
            var half_hd_length = hd_length/2;
            $(".slide50 .hd").css({"marginLeft":"-"+half_hd_length+"px"});
        });
    </script>
    <script type="text/javascript">
        $(function(){tlancv('50','-111.5')});
    </script>
  </div>
</div>
