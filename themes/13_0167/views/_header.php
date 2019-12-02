<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php echo $_seo['title'];?></title>
<meta name="keywords" content="<?php echo $_seo['keywords'];?>" />
<meta name="description" content="<?php echo $_seo['description'];?>" />
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/style.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>css/updatestyle.css" />
<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/style.js"></script>
<script type="text/javascript" src="<?php echo $_uiurl;?>js/updatestyle.js"></script>
<style type="text/css">
body {
	background-color: #d9d9d9;
	background-image: url(<?php echo $_uiurl;?>images/bg.jpg);
	background-repeat: repeat-x;
}
</style>
<script type="text/javascript">
	window.top["BNPage"] = 0;
</script>
</head>
<body>
 <div class="fwtop">
  <div class="fwtop_cont">
   <div class="fwtop_logo">
    <div class="top_logo" id="top_logo">
         <a href="<?php echo $_baseurl?>"><img src="<?php echo DBG_FILEURL.$_site['logo']?>" style="width: <?php echo empty($_site['logow'])?1000:$_site['logow'];?>px;height:<?php echo empty($_site['logoh'])?120:$_site['logoh'];?>px;" alt="网站Logo" title="test" /></a>
    </div>
   </div>
<!--   <div class="fwtop_info">
    <div class="topLanguage" id="topLanguage">
     <div class="language">
      <div id="languageContent">选择语言:</div>
      <div class="languageSelect" onmouseover="displayLanguage($(this))" onmouseout="hideLanguage(event,$(this))" id="language">
       <span class="select_languageInfo" id="select_languageInfo"><a href="javascript:void(0)" rel="1">简体中文</a></span> <span class="select_language" id="select_language">
        <ul>
         <li><a href="javascript:void(0)" rel="1">简体中文</a></li>
        </ul>
       </span>
      </div>
     </div>
     <script type="text/javascript">
						siteLanguage()
					</script>
    </div>
    <div class="topSearch clear" id="topSearch">
     <div class="search">
      <input type="text" id="siteSearchContent" value="请输入关键字..." class="enter">
       <div class="select" onmouseover="displaySiteSearch($(this))" onmouseout="hideSiteSearch(event,$(this))" id="search">
        <span class="select_info" id="siteSelect_info"><a href="javascript:void(0)" rel="新闻">新闻</a></span> <span class="select_search" id="select_siteSearch">
         <ul>
          <li><a href="javascript:void(0)" rel="新闻">新闻</a></li>
          <li><a href="javascript:void(0)" rel="产品">产品</a></li>
          <li><a href="javascript:void(0)" rel="下载">下载</a></li>
          <li><a href="javascript:void(0)" rel="招聘">招聘</a></li>
         </ul>
        </span>
       </div> <input id="siteSearchSubmit" type="button" class="btn" />
     </div>
     <script type="text/javascript">
						siteSearch()
					</script>
     <script type="text/javascript">
						$("#siteSearchContent").focus(function() {
							if (this.value == "请输入关键字...") {
								this.value = ""
							}
						});
						$("#siteSearchContent").blur(function() {
							if (this.value == "") {
								this.value = "请输入关键字...";
							}
						});
					</script>
    </div>
   </div>-->
   <div class="clear"></div>
   <div class="fwtop_mainNav">
    <div class="siteMainNav fwtop_nav fwnavlink" id="siteMainNav">
     <ul>
        <li <?php echo $_column==''?'class="open"':NULL;?>> <a href="<?php echo $_baseurl;?>">网站首页</a> </li>
              <?php $i=0; foreach ($_navs as $v1):?>
            <li onmouseover="visible(<?php echo $i; ?>);" onmouseout="invisible(<?php echo $i; ?>);" style="width:140px;"><span><a href="<?php echo $v1['link'];?>"><?php echo $v1['name'];?></a> <!-- 2 -->
               <ul id="invisible<?php echo $i; $i++;?>" class="invisible">
              <?php foreach ($v1['list'] as $v2):?>
              <li class="smallli"><span><a href="<?php echo $v2['link']?>"><?php echo $v2['name']?></a> <!-- 3 -->
                <ul><?php foreach ($v2['list'] as $v3):?><li><a href="<?php echo $v3['link'];?>"><?php echo $v3['name'];?></a></li><?php endforeach;?>
                </ul></span></li>
            <?php endforeach;?> </ul></li>
            <?php endforeach;?>
               <script>
                   function visible(ii){
                       $('#invisible'+ii).attr('class','visible');
                   }
                   function invisible(ii){
                       $('#invisible'+ii).attr('class','invisible');
                   }
               </script>
     </ul>
       <style>
           .smallli{margin-bottom:-8px; width:100%;background-color: #46A7F2;overflow:hidden; }
           .visible{display:block;width:190px;height: auto;position: absolute;z-index: 2;overflow: hidden;}
           .invisible{display:none;width:190px;height: auto;position: absolute;z-index: 2;}
       </style>
     <div class="clear"></div>
    </div>
   </div>
   <div class="clear fwtop_banner">
    <div class="siteBanner" id="siteBanner">
     <div class="hd">
      <ul>
       <li>1</li>
       <li>2</li>
       <li>3</li>
      </ul>
     </div>
     <div class="bd" id="bd">
        <ul>
        <?php $banner=getLists ( 1, "model|1;state|20;" );foreach ($banner as $val):?>
        <li><img style="width: 1000px; height: 400px;" src="<?php echo $val['slide'];?>" title="幻灯1"></li>
        <?php endforeach;?>    
        </ul>
     </div>
     <a class="prev" href="javascript:void(0)"></a> <a class="next" href="javascript:void(0)"></a>
    </div>
    <script type="text/javascript">
					var ary = location.href.split("&");
					jQuery("#siteBanner").slide({
						mainCell : "#bd ul",
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
  </div>
 </div>