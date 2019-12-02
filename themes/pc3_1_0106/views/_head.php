<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit" />
		<meta name="robots" content="index, follow" />
		<title><?php echo $_seo['title']; ?></title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="order by website" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>skin/css/font-awesome.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>skin/css/bootstrap.min.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>skin/css/owl.carousel.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>skin/css/owl.theme.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>skin/css/settings.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>skin/css/style-red.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo $_uiurl;?>skin/css/tk.css" media="screen" />
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/owl.carousel.min.js"></script>
	</head>


	<body>
		<div id="container">
			<header class="clearfix" id="header-sec">
				<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
					<div class="top-line">
						<div class="container">
							<div class="row">
								<div class="col-md-8 col-sm-9 topbar-left">
									<ul class="info-list">
										<li class="tb-adword"> <i class="fa fa-anchor"></i> <span>厂家直销，玩具批发，加盟招商第一品牌</span> </li>
										<li class="tb-phone"> <i class="fa fa-phone"></i> 服务热线: <span><?php $aaa = getFragment(8);echo $aaa['content']; ?></span> </li>
										<li class="tb-email"> <i class="fa fa-envelope-o"></i> 电子邮箱: <span><?php $aaa = getFragment(6);echo $aaa['content']; ?></span> </li>
									</ul>
								</div>
								<div class="col-md-4 col-sm-3 topbar-right">
									<ul class="social-icons">
										<li>
											<a href="javascript:;" target="_blank"><i class="fa fa-weibo"></i></a>
										</li>
										<li>
											<a href="javascript:;" target="_blank"><i class="fa fa-tencent-weibo"></i></a>
										</li>
										<li>
											<a href="javascript:;" target="_blank"><i class="fa fa-qq"></i></a>
										</li>
										<li>
											<a href="javascript:;" target="_blank"><i class="fa fa-shopping-cart"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="container">
						<div class="navbar-header">
							<a class="navbar-toggle collapsed mmenu-btn" href="#mmenu">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
							<a class="navbar-brand" href="javascript:;">
                                <img src="<?php echo DBG_FILEURL . $_site['logo'] ?>" alt="<?php echo $_seo['title']; ?>" class="logo" />
<!--                                <img src="--><?php //echo $_uiurl;?><!--skin/images/logo-m.png" alt="" class="logo-m" />-->
                            </a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right" id="navigation">
								<li class="Lev1">
									<a href="<?php echo $_baseurl;?>" class="<?php echo $_column==''?'active menu1':'menu1'; ?>" >网站首页 </a>
								</li>

                                <?php foreach ($_navs as $key=>$val):?>
                                    <li class="Lev1">
                                        <a href="<?php echo !empty($val['list'])?'':$val['link'];?>"  class="<?php  echo $val['sign']==$_column?"active":"";?>" style="<?php echo !empty($val['list'])?'pointer-events: none':'';?>">
                                            <?php echo $val['name'];?>
                                            <?php if(!empty($val['list'])):?>
                                            <i class="fa fa-caret-down"></i>
                                            <?php endif;?>
                                        </a>
                                        <?php if(!empty($val['list'])):?>
                                            <!-- 二级栏目 -->
                                            <ul class="drop-down sub-menu2">
                                                <?php foreach ($val['list'] as $val2):?>
                                                    <li class="Lev2"><a href="<?php echo $val2['link'];?>"><?php echo $val2['name'];?></a></li>
                                                <?php endforeach;?>
                                            </ul>
                                        <?php endif;?>
                                    </li>
                                <?php endforeach;?>

<!--								<li class="search nav-search">-->
<!--									<a href="javascript:;" class="open-search"><i class="fa fa-search"></i></a>-->
<!--                                    <form class="form-search" id="searchform" name="formsearch" action="--><?php //echo $_baseurl; ?><!--so" method="get" target="_blank">-->
<!--                                        <input class="search-input inpys01 keypress" id="seachkeywords" type="text" placeholder="请输入关键词"  button="#sousuo" name="keyword" class="stxt" value="请输入关键词" onfocus="if (value == '请输入关键词') {-->
<!--                  value = ''-->
<!--              }" onblur="if (value == '') {-->
<!--                          value = '请输入关键词'-->
<!--                      }">-->
<!--                                        <button class="search-btn" ype="submit" value=" " id="sousuo"><i class="fa fa-search"></i></button>-->
<!--                                    </form>-->
<!--								</li>-->
							</ul>
						</div>
					</div>
				</nav>
			</header>


