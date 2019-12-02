<!-- 通用友情链接 -->
<div class="dbgms_flink_wrap">
 <div class="dbgms_flink_title">
  <h2>友情链接</h2>
  <div style="line-height: 40px; padding-left: 100px;">
   注：友情链接可选图片模式。<strong>(通用友情链接 dbgms_flink)</strong>
  </div>
 </div>
 <ul>
  <li><a href="http://www.so.com">360搜索</a></li> 
<?php $flink = getFlink();foreach ($flink as $val):?>
<li><a href="<?php echo $val['link']?>" target="_blank"><?php echo $val['title']?></a></li>
<?php endforeach;?> 
 </ul>
</div>
<!-- 通用南部网站地图 -->
<div class="dbgms_sitemap_wrap">
 <div class="dbgms_sitemap">
  <div class="dbgms_sitemap_div1">
   <h2 class="dbgms_sitemap_h2">产品 (通用南部网站地图 dbgms_sitemap)</h2>
   <div class="dbgms_sitemap_link">
    <a class="link_a1" href="###">CMS内容管理系统</a><a href="###">模型管理</a><a href="###">栏目管理</a><a href="###">内容管理</a><a href="###">站点设置</a><a href="###">数据统计</a><a href="###">权限管理</a><a href="###">管理员管理</a> <a href="###">碎片管理</a> <a href="###" style="color: #333;">查看更多..</a>
   </div>
   <div class="dbgms_sitemap_link">
    <a class="link_a1" href="###">MEMBER会员系统</a><a href="###">会员统计</a><a href="###">内容管理</a><a href="###">购物清单</a><a href="###">会员组</a><a href="###">会员管理</a><a href="###">会员设置</a><a href="###" style="color: #333;">查看更多..</a>
   </div>
   <div class="dbgms_sitemap_link">
    <a class="link_a1" href="###">TOOL工具</a><a href="###">广告管理</a><a href="###"></a> <a href="###">附件管理</a> <a href="###">数据采集</a> <a href="###">SEO助手</a> <a href="###">文件压缩</a> <a href="###">插件管理</a> <a href="###">数据库管理</a> <a href="###" style="color: #333;">查看更多..</a>
   </div>
   <div class="clear"></div>
  </div>
  <div class="dbgms_sitemap_div2">
   <h2 class="dbgms_sitemap_h2">关于业务</h2>
   <div class="dbgms_sitemap_link">
    <a class="link_a1" href="###">服务</a><a href="###">网站推广</a><a href="###">网站建设</a><a href="###">售后服务</a><a href="###">技术支持</a><a href="###" style="color: #333;">查看更多..</a>
   </div>
  </div>
  <div class="dbgms_sitemap_div3">
   <h2 class="dbgms_sitemap_h2">关于我们</h2>
   <div class="dbgms_sitemap_link">
    <a href="###" class="link_a1">公司简介</a><a href="###">企业文化</a><a href="###">公司荣誉</a><a href="###">公司环境</a><a href="###">员工风采</a><a href="###" style="color: #333;">查看更多..</a>
   </div>
  </div>
  <div class="clear"></div>
 </div>
</div>

<!-- 通用底部 -->
<div class="dbgms_footer_wrap">
<?php foreach ($_navs as $key=>$val):?>
 <a href="<?php echo $val['link'];?>" target="_blank"><?php echo $val['name'];?></a> |    
<?php endforeach;?> 
 <a href="http://www.kuaisou360.com/">网站推广</a> | <a href="http://www.kuaisou360.com/">网站建设</a> | <a href="http://www.dbgms.cn/" target="_blank">版权声明</a> | <a href="http://www.soacme.com/" target="_blank">更多资讯</a> | <a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=team@dbgms.cn" target="_blank">意见反馈</a>
 <p class="cp"><?php echo $_site['copyright'];?> &nbsp;<a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $_site['icp'];?></a></p>
 <!--  <p class="cp">网站推广&nbsp;|&nbsp;网站建设&nbsp;：<strong><a href="http://www.kuaisou360.com/" target="_blank">福州快搜网络技术有限公司</a></strong> &nbsp;咨询热线：400-8851-360. </p>-->
 <p class="cp">Powered by <strong><a href="http://www.dbgms.cn" target="_blank">DbgMs.cn</a></strong> <em>v2</em> © 2016
 </p>
</div>


<script type="text/javascript" src="<?php echo $_uiurl?>/js/jquery.qqscroll.js"></script>
<div class="review">
 <div class="review-box" id="review-box">
  <h2>往期回顾</h2>
  <div class="review-box-lists inner" id="reviewlist">
  <?php
		$coulmn = getColumn ( 1, 'product' );
		$lists = getLists ( 1, "model|1;nostate|20;cid|{$coulmn['clists']};sort|rand;sorttype=desc;row|5" );
		?>  
   <ul class="cf list" id="review-con">
   
<?php foreach ($lists  as $key=> $val):?>
    <li class="split"><a target="_blank" href="<?php echo $val['link'];?>" title="<?php echo $val['title'];?>"><img width="233" height="163" src="<?php echo $val['thumb'];?>" alt="<?php echo $val['title'];?>">
      <div class="bg"></div>
      <p><?php echo $val['title'];?></p></a></li>
 <?php endforeach;?>   
   </ul>
  </div>
  <span class="btn prev">&lt;</span> <span class="btn next">&gt;</span>
 </div>
 <!-- 版权页面片 开始-->
 <style>
.tcopyright {
	width: 960px;
	margin: 0 auto;
	padding: 30px 0;
	font-size: 12px;
	line-height: 28px;
	color: #333;
	text-align: center;
	overflow: hidden;
	clear: both;
}

.tcopyright .en {
	font-family: Arial;
}

.tcopyright a {
	color: #333;
	text-decoration: none;
}

.tcopyright a:hover {
	color: #bd0a01;
	text-decoration: underline;
}
</style>
 <div id="tcopyright" class="tcopyright" bosszone="footer" role="contentinfo">
  <div>
   <a href="http://www.kuaisou360.com/">网站推广</a> | <a href="http://www.kuaisou360.com/">网站建设</a> | <a href="http://www.dbgms.cn/" target="_blank">版权声明</a> | <a href="http://www.soacme.com/" target="_blank">更多资讯</a> | <a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=team@dbgms.cn" target="_blank">意见反馈</a>
  </div>
  <div class="en"><?php echo $_site['copyright'];?> &nbsp;<a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $_site['icp'];?></a>
  </div>
  <div>
   Powered by <strong><a href="http://www.dbgms.cn" target="_blank">DbgMs.cn</a></strong> <em>v2</em> © 2016
  </div>
 </div>
 <!--[if !IE]>|xGv00|ebd6fb0d7fdd1cfabfeda4cf113fa32e<![endif]-->
 <!-- 版权页面片 结束 -->
</div>

<script type="text/javascript">
  $("#review-box").qqScroll({
        direction: "right",
        auto: true,
        step: 4
    });
  
  var len = $("#review-con .split").length;
    if( len <= 4){
      if( len == 0 ){
        $("#review-box").hide();
      }else{
       $("#review-box .btn").hide();
      }
    } 
</script>
<?php include '_tool.php';?>
