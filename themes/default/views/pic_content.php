 <?php include '_header.php';?>
<!-- 通用主体 -->
<div class="dbgms_main_wrap">
 <!-- 通用块 -->
 <div class="dbgms_block_wrap" style="width: 730px; float: left;">
  <div class="dbgms_navigation"><?php echo $_navigation;?></div>
  <div class="sep10"></div>
  <div class="dbgms_product_wrap">
   <div class="dbgms_product_contentexpand">
    <div class="imagebox">
     <div class="pic">
      <img id="index_pic" src="<?php echo $_content['thumb']?>" width="320" height="240" alt="三星GALAXY S4 I9500">
     </div>
     <div class="tabs">
      <a href="javascript:void(0);"><img name="" src="<?php echo $_content['thumb']?>" width="85" height="70" alt=""></a>
      <!--  -->
      <a href="javascript:void(0);"><img name="" src="<?php echo $_content['thumb']?>" width="85" height="70" alt=""></a>
      <!--  -->
      <a href="javascript:void(0);"><img name="" src="<?php echo $_content['thumb']?>" width="85" height="70" alt=""></a>
      <!--  -->
      <a href="javascript:void(0);"><img name="" src="<?php echo $_content['thumb']?>" width="85" height="70" alt=""></a>
     </div>
    </div>
    <div class="info">
     <div class="title">
      <h1><?php echo $_content['title']?></h1>
     </div>
     <div class="description">描述：<?php echo $_content['description']?></div>
     <div class="list">
      <ul>
       <li><span class="name">价格：</span>111</li>
       <li><span class="name">颜色：</span>11</li>
      </ul>
     </div>
    </div>
    <div class="fn-clear"></div>
   </div>
   <div class="dbgms_product_content_wrap">
    <div class="dbgms_product_head">
     <h3>产品介绍 dbgms_product_wrap</h3>
    </div>
    <div class="dbgms_product_content"><?php echo $_content['content']?></div>
   </div>
   <div class="dbgms_product_pagebreak"></div>
   <div class="dbgms_product_updown">
    <div class="previous">上一篇： 暂无</div>
    <div class="next">
     下一篇 <a href="###">联想 A830</a>
    </div>
   </div>
   <div class="fn-clear"></div>
  </div>
  <div class="dbgms_boxlist8">
   <div class="dbgms_boxlist8_head">
    <h3>相关文章 dbgms_boxlist8_wrap</h3>
   </div>
   <div class="dbgms_boxlist8_list">
    <ul>
     <li><span class="line">•</span><span class="title"><a href="###" title="">zxc</a></span></li>
     <li><span class="line">•</span><span class="title"><a href="###" title="">zxczxc</a></span></li>
     <li><span class="line">•</span><span class="title"><a href="###" title="">cccc</a></span></li>
    </ul>
    <div class="fn-clear"></div>
   </div>
  </div>
   <?php include '_comment.php';?>
 </div>
<?php include '_right.php';?> 
 <div class="fn-clear"></div>
</div>
<?php include '_footer.php';?>