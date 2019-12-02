<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $_seo['title']; ?></title>
<meta name="keywords" content="<?php echo $_seo['keywords']; ?>" />
<meta name="description" content="<?php echo $_seo['description']; ?>" />
<link href="<?php echo $_uiurl ?>css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo $_uiurl ?>js/gundong.js"></script>
<script type=text/javascript src="<?php echo $_uiurl ?>js/jquery.js"></script>
<script type=text/javascript src="<?php echo $_uiurl ?>js/sl-1.js"></script>
<script type="text/javascript">

	$(document).ready(function(){

	  	$.focus("#focus001");

	});

</script>
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a.js"></script>
<script>
DD_belatedPNG.fix('*');
</script>
<![endif]-->
</head>
<body>
<div class="Top_bg">
  <div class="w1200">
    <div class="logo"> <img src="<?php echo DBG_FILEURL . $_site['logo'] ?>" style="width: <?php echo empty($_site['logow']) ? 560 : $_site['logow']; ?>px;height:<?php echo empty($_site['logoh']) ? 108 : $_site['logoh']; ?>px;" alt="<?php echo $_seo['title']; ?>"/> </div>
    <div class="tel">
      <div class="haoma">18750178387（微信同号）</div>
    </div>
  </div>
</div>
<div class="Top">
  <div class="Nav_main">
    <ul>
        <li <?php echo $_column == '' ? 'class="open"' : ""; ?>><a href="<?php echo $_baseurl; ?>">网站首页</a></li>
        <?php foreach ($_navs as $val): ?>
            <li <?php echo $val['sign'] == $_column ? 'class="open"' : ""; ?>><a href="<?php echo $val['link']; ?>"><?php echo $val['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
  </div>
</div>