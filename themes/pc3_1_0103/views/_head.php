<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $_seo['title']; ?></title>
		<meta name="keywords" content=<?php echo $_seo['title']; ?> />
		<meta name="description" content=<?php echo $_seo['title']; ?> />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo $_uiurl;?>css/animate.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $_uiurl;?>css/bootstrap.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $_uiurl;?>css/style.css" type="text/css" />
		<script src="<?php echo $_uiurl;?>js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo $_uiurl;?>js/bootstrap.min.js"></script>
		<script src="<?php echo $_uiurl;?>js/core.js"></script>
		<script src="<?php echo $_uiurl;?>js/home_index.js"></script>
		<script src="<?php echo $_uiurl;?>js/pt_macro_home.js"></script>
	</head>
	<body>
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
                        <img src="<?php echo DBG_FILEURL . $_site['logo'] ?>"  style="width: <?php echo empty($_site['logow']) ? 130 : $_site['logow']; ?>px;height:<?php echo empty($_site['logoh']) ? 27 : $_site['logoh']; ?>px;" alt="<?php echo $_seo['title']; ?>" />
                    </a>
                </div>
                <div class="navbar-collapse collapse" style="height: 1px;">
                    <ul class="nav navbar-nav">
                        <li class =<?php echo $_column==''?'active':"";?>><a href="<?php echo $_baseurl;?>">首页</a></li>
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


