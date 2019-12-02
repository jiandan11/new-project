<?php include '_header.php';?>
<!-- 通用主体 -->
<div class="dbgms_main_wrap">
 <!-- 通用块 -->
 <div class="dbgms_block_wrap" style="width: 730px; float: left;">
  <div class="dbgms_navigation"><?php echo $_navigation;?></div>
  <div class="sep10"></div>
  <div class="dbgms_article_wrap">
   <div class="dbgms_article">
    <h1><?php echo $_content['title'];?></h1>
    <div class="dbgms_article_info">作者：&nbsp;&nbsp;浏览量：<?php echo $_content['hits'];?>&nbsp;&nbsp;发布时间：<?php echo date("Y-m-d H:i",$_content['intime']);?></div>
    <div class="dbgms_article_content"><?php echo $_content['content'];?></div>
   </div>
   <div class="dbgms_article_pagebreak"></div>
   <div class="dbgms_article_updown">
    <div class="previous">
     上一篇： <a href="<?php echo $_prev['link'];?>"><?php echo $_prev['title'];?></a>
    </div>
    <div class="next">
     下一篇 ： <a href="<?php echo $_next['link'];?>"><?php echo $_next['title'];?></a>
    </div>
   </div>
   <div class="fn-clear"></div>
   <!--END-->
  </div>
  <div class="dbgms_boxlist8">
   <div class="dbgms_boxlist8_head">
    <h3>相关文章 dbgms_boxlist8_wrap</h3>
   </div>
   <div class="dbgms_boxlist8_list">
    <ul>
     <li><span class="line">•</span><span class="title"><a href="###" title="">dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap</a></span></li>
     <li><span class="line">•</span><span class="title"><a href="###" title="">dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap</a></span></li>
     <li><span class="line">•</span><span class="title"><a href="###" title="">dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap dbgms_boxlist8_wrap</a></span></li>
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