</div>


 <style type="text/css">
.footerwrap {
	width: 100%;
	margin: 0 auto;
	background: #332f30;
}

.footerwrap_bottomInfo {
	width: 1000px;
	margin: 0 auto;
	padding-top: 20px;
	padding-bottom: 20px;
	color: #D8CECE;
}

.footerwrap_bottomInfo a {
	color: #D8CECE;
}

.footerwrap_siteBottomNav span {
	margin: 0 6px 0 6px;
}

.footerwrap_siteBottomNav {
	width: 1000px;
	margin: 10px auto;
	clear: both;
	line-height: 22px;
}

.footerwrap_siteBottomNav p {
	align: center;
}

.copyright {
	width: 1000px;
	margin: 10px auto;
}
</style>
 <div class="footerwrap">
  <div class="footerwrap_bottomInfo">
  <div class="footerwrap_siteBottomNav">
    <p align="center" style="margin: 0 0 10px 0;">
     <a href="<?php echo $_baseurl;?>" target="_blank"> 首页</a> <?php foreach ($_navs as $key=>$val) :?>
        <span>|</span><a href="<?php echo $val['link'];?>" target="_blank"><?php echo $val['name'];?></a>
        <?php endforeach;?>
    </p>
    <p align="center">
     <?php echo $_site['copyright'];?>&nbsp; <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $_site['icp'];?></a>
    </p>
    <p align="center">
     网站推广&nbsp;|&nbsp;网站建设&nbsp; |&nbsp;技术支持：<a href="http://www.kuaisou360.com/" target="_blank">福州快搜网络技术有限公司</a>&nbsp;建站热线：400-8851-360.
    </p>
   </div>
   <div class="copyright"></div>
  </div>
 </div>
</body>
</html>