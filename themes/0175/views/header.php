<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $_seo['title']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link type="text/css" rel="stylesheet" href="<?php echo $_uiurl?>css/style.css" />
    <style type="text/css">
        body {
            background-color:#ECF0FB;
            background-image:url(<?php echo $_uiurl?>img/bg-loop.jpg);
            background-repeat:repeat-x;
        }
    </style>
</head>
<body>

<div id="BNreturnTopDiv"></div>
<div class="fwtop">
    <div class="fwtop_logo">
        <div class="top_logo" id="top_logo"> <img src="<?php echo $_uiurl?>img/logo.png" width="305" alt="网站Logo" title="test"/> </div>
    </div>
    <div class="clear"></div>
    <div class="fwtop_mainNav">
            <!--        头部banner-->
        <div class="siteMainNav fwtop_nav fwnavlink" id="siteMainNav" >
            <ul>
                <li <?php echo $_column==''?'class="current"':"";?>><div class="title">
                        <a href="<?php echo $_baseurl;?>">首页</a>
                    </div></li>
                <?php foreach ($_navs as $key=>$val):?>
                    <li <?php echo $val['sign']==$_column?'class="current"':"";?>><div class="title">
                            <a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
                        </div>
                        <?php if(!empty($val['list'])):?>
                            <!-- 二级栏目 -->
                            <ul class="nav_menu" style="display: none;">
                                <?php foreach ($val['list'] as $val2):?>
                                    <li><a href="<?php echo $val2['link'];?>"><?php echo $val2['name'];?></a></li>
                                    <li class="line">|</li>
                                <?php endforeach;?>
                            </ul>
                        <?php endif;?>
                    </li>
                <?php endforeach;?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="fwtop_banner">
        <div class="siteBanner" id="siteBanner"> <img src="<?php echo $_uiurl;?>img/788427500885.jpg" width="1002" height="375" alt="banner" title="banner"/> </div>
    </div>
</div>