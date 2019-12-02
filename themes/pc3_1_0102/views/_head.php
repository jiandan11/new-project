<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $_seo['title']; ?></title>
    <meta name="keywords" content="<?php echo $_seo['title']; ?>" />
    <meta name="description" content="<?php echo $_seo['title']; ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $_uiurl;?>css/bootstrap.min.css" tppabs="css/bootstrap.min.css"  rel="stylesheet" type="text/css" />
    <link href="<?php echo $_uiurl;?>css/style.css" tppabs="css/style.css"  rel="stylesheet" type="text/css" />
    <link href="<?php echo $_uiurl;?>css/jquery.bxslider.css" tppabs="css/jquery.bxslider.css"  rel="stylesheet" />


</head>
<body>
<div class="top hidden-xs">
    <div class="container">
        <div class="top-fl">Hi，欢迎来到<?php echo $_seo['title']; ?>！</div>
        <div class="top-fr">客服热线：0591-123456789</div>
    </div>
</div>
<header class="header-frontend">
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo $_baseurl ?>" class="navbar-brand">
                    <img src="<?php echo DBG_FILEURL . $_site['logo'] ?>"  style="width: <?php echo empty($_site['logow']) ? 327 : $_site['logow']; ?>px;height:<?php echo empty($_site['logoh']) ? 41 : $_site['logoh']; ?>px;" alt="<?php echo $_seo['title']; ?>" />
                </a>
            </div>
            <div class="navbar-collapse collapse" style="height: 1px;">
                <ul class="nav navbar-nav">
                    <li <?php echo $_column==''?'class="active"':"";?>>
                        <a href="<?php echo $_baseurl;?>">首页</a>
                    </li>
                    <?php foreach ($_navs as $key=>$val):?>
                        <li class = <?php  echo $val['sign']==$_column?"active dropdown":"dropdown";?>>
                            <a href="<?php echo $val['link'];?>" ><?php echo $val['name'];?></a>
                            <?php if(!empty($val['list'])):?>
                                <!-- 二级栏目 -->
                                <ul class="dropdown-menu">
                                    <?php foreach ($val['list'] as $val2):?>
                                        <li><a href="<?php echo $val2['link'];?>"><?php echo $val2['name'];?></a></li>
                                        <li class="line">|</li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</header>
<!--图片轮播-->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php $banner = getLists(1, "model|1;state|20;row|6;");
        foreach ($banner as $key=>$val): ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key; ?>" class="<?php echo $key==0?'active':'' ?>"></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php $banner = getLists(1, "model|1;state|20;row|6;");?>
        <?php foreach ($banner as $key=>$val): ?>
            <div class="<?php echo $key==0?'item active':'item' ?>">
                <img src="<?php echo $val['slide']; ?>"  title="<?php echo $val['title']; ?>"  />
            </div>
        <?php endforeach; ?>
    </div>



