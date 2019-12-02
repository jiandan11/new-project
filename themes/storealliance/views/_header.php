<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="yes" name=" apple-mobile-web-app-capable"/>
    <meta content="no" name="apple-touch-fullscreen"/>
    <meta content="black" name=" apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <title>小程序超级营销工具</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <link rel="stylesheet" href="<?php echo $_uiurl;?>css/animate.min.css">
    <link rel="stylesheet" href="<?php echo $_uiurl;?>css/css.css">
    <script src="<?php echo $_uiurl;?>js/rem.js"></script>
    <script src="<?php echo $_uiurl;?>js/check.js"></script>

</head>
<body>
<!--nav-->
<section>
    <div class="nav">
        <div class="safe clear">
            <div class="logo left"><a href="<?php echo $_baseurl;?>">超级小程序</a></div>
            <div class="meun right">
                <ul>
                  <li <?php echo $_column==''?'class="current"':"";?>><div class="navon">
                      <a href="<?php echo $_baseurl;?>">首页</a>
                      </div></li>
                   <?php foreach ($_navs as $key=>$val):?>
                      <li <?php echo $val['sign']==$_column?'class="current"':"";?>><div class="title">
                          <a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
                          </div>
                    <?php endforeach;?>
                </ul>
            </div>
            <div class="miniicon right" onclick="check_display()">
              <img src="<?php echo $_uiurl;?>images/miniicon.png" alt="">
            </div>
            <div class="mmeun" style="display: none;">
                 <ul>
                    <li <?php echo $_column==''?'class="current"':"";?>><div class="navon">
                      <a href="<?php echo $_baseurl;?>">首页</a>
                      </div></li>
                   <?php foreach ($_navs as $key=>$val):?>
                      <li <?php echo $val['sign']==$_column?'class="current"':"";?>><div class="title">
                          <a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
                          </div>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</section>




