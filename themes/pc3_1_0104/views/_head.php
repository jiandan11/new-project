<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $_seo['title']; ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo $_uiurl;?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Bx-Slider StyleSheet CSS -->
    <link href="<?php echo $_uiurl;?>css/jquery.bxslider.css" rel="stylesheet">
    <!-- Font Awesome StyleSheet CSS -->
    <link href="<?php echo $_uiurl;?>css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $_uiurl;?>css/svg-style.css" rel="stylesheet">
    <!-- Pretty Photo CSS -->
    <link href="<?php echo $_uiurl;?>css/prettyPhoto.css" rel="stylesheet">
    <!-- Widget CSS -->
    <link href="<?php echo $_uiurl;?>css/widget.css" rel="stylesheet">
    <!-- DL Menu CSS -->
	<link href="<?php echo $_uiurl;?>js/dl-menu/component.css" rel="stylesheet">
    <!-- Typography CSS -->
    <link href="<?php echo $_uiurl;?>css/typography.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="<?php echo $_uiurl;?>css/animate.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link href="<?php echo $_uiurl;?>css/owl.carousel.css" rel="stylesheet">
    <!-- Shortcodes CSS -->
    <link href="<?php echo $_uiurl;?>css/shortcodes.css" rel="stylesheet">
	<!-- Custom Main StyleSheet CSS -->
    <link href="<?php echo $_uiurl;?>style.css" rel="stylesheet">
    <!-- Color CSS -->
    <link href="<?php echo $_uiurl;?>css/color.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="<?php echo $_uiurl;?>css/responsive.css" rel="stylesheet">
 
  </head>

  <body>

<!--Wrapper Start-->  
<div class="ct_wrapper">
	
    <!--Header Wrap Start-->
    <header>
    	<!--Top Strip Wrap Start-->
        <div class="top_strip">
        	<div class="container">
                <div class="top_location_wrap">
                    <!--  碎片  -->
                    <p><i class="fa fa-map-marker"></i> <?php $aaa = getFragment(7);echo $aaa['content']; ?></p>
                </div>
                <div class="top_ui_element">
                    <ul>
                        <li><i class="fa fa-envelope"></i><a> <span style="color: white;background-color: "><?php $aaa = getFragment(6);echo $aaa['content']; ?></span></a></li>
                        <li><i class="fa fa-phone"></i><a> <?php $aaa = getFragment(8);echo $aaa['content']; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Top Strip Wrap End-->
        
        <!--Navigation Wrap Start-->
        <div class="logo_nav_outer_wrap">
        	<div class="container">
                <div class="logo_wrap">
                    <a href="<?php echo $_baseurl ?>">
                        <img src="<?php echo DBG_FILEURL . $_site['logo'] ?>"  style="width: <?php echo empty($_site['logow']) ? 130 : $_site['logow']; ?>px;height:<?php echo empty($_site['logoh']) ? 27 : $_site['logoh']; ?>px;" alt="<?php echo $_seo['title']; ?>" />
                    </a>
                </div>
                
                <nav class="main_navigation">
                    <ul>
                        <li><a href="<?php echo $_baseurl;?>"  class=<?php echo $_column==''?'active':''; ?>>网站首页</a></li>
                        <?php foreach ($_navs as $key=>$val):?>
                            <li>
                                <a href="<?php echo $val['link'];?>"  class = <?php  echo $val['sign']==$_column?"active":"";?>><?php echo $val['name'];?></a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </nav>
                <!--DL Menu Start-->
                <div id="kode-responsive-navigation" class="dl-menuwrapper">
                    <button class="dl-trigger">Open Menu</button>
                    <ul class="dl-menu">
                        <li><a href="<?php echo $_baseurl;?>" class=<?php echo $_column==''?'active':''; ?>>网站首页</a></li>
                        <?php foreach ($_navs as $key=>$val):?>
                            <li class="menu-item kode-parent-menu">
                                <a href="<?php echo $val['link'];?>" class = <?php  echo $val['sign']==$_column?"active":"";?>><?php echo $val['name'];?></a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <!--DL Menu END-->
            </div>
        </div>
        <!--Navigation Wrap End-->
    </header>
    <!--Header Wrap End-->

