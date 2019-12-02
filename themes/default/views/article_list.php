<?php include '_header.php';?>
<!-- 通用主体 -->
<div class="dbgms_main_wrap">
 <!-- 通用块 -->
 <div class="dbgms_block_wrap" style="width: 730px; float: left;">
  <div class="dbgms_navigation"><?php echo $_navigation;?></div>
  <div class="sep10"></div>
  <div class="dbgms_list2">
   <div class="dbgms_list2_head">
    <h3>当前内容列表 dbgms_list2</h3>
   </div>
   <div class="dbgms_list2_list">
    <ul>
<?php foreach ($_list as $val):?>
<li><span class="line">•</span><span class="title"><a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>"><?php echo $val['title'];?></a> </span> <span class="time"><?php echo date("Y-m-d",$val['intime']);?></span></li>
<?php endforeach;?>
   </ul>
   </div>
  </div>
  <div class="pagenum"><?php echo $_pagebreak;?></div>
 </div>
 <?php include '_right.php';?>
 <div class="fn-clear"></div>
</div>
<?php include '_footer.php';?>