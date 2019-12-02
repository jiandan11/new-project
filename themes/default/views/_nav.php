<!-- 通用导航 -->
<div class="dbgms_wrap">
 <div id="nav">
  <ul>
   <li <?php echo $_column==''?'class="current"':"";?>><div class="title">
     <a href="<?php echo $_baseurl;?>">首页</a>
    </div></li>
<?php foreach ($_navs as $key=>$val):?>
    <li <?php echo $val['sign']==$_column?'class="current"':"";?>><div class="title">
     <a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
    </div>
<?php if(!empty($val['list'])):?>
     <!-- 二级栏目 -->
    <ul class="nav_menu" style="display: none;">
<?php foreach ($val['list'] as $val2):?>
       <li><a href="<?php echo $val2['link'];?>"><?php echo $val2['name'];?></a></li>
     <li class="line">|</li>
<?php endforeach;?>
     </ul>
<?php endif;?>
    </li>
<?php endforeach;?>
    </ul>
  <div class="fn-clear"></div>
 </div>
 <div id="navmenu"></div>
 <script type="text/javascript">
   $(document).ready(function() {
    /*导航菜单*/
    $("#nav li").hover(function() {
      $(this).parent().find('.menucur').hide();
      $(this).find('.nav_menu').show();
     }, function() {
      $(this).find('.nav_menu').hide();
      $(this).parent().find('.menucur').show();
    });

   });
   $(document).ready(function() {
    var li_arr = $('.dbgnavul li a');
    li_arr.each(function(i) {
     if ($(this).html() == '瑜伽课程') {
      $(this).attr("id", "dbgshownav");
     }
    });
    //这个是鼠标滑动菜单栏
    $("#xiake_nav,#dbgshownav").mouseenter(function() {
     $("#xiake_nav").css({
      "top" : ($("#dbgshownav").offset().top + 30) + "px",
      "left" : $(this).offset().left + "px",
      "height" : "auto",
      "visibility" : "visible"
     });
    });
    $("#xiake_nav,#dbgshownav").mouseleave(function(event) {
     $("#xiake_nav").css({
      "height" : "0px",
      "overflow" : "hidden",
      "visibility" : "hidden"
     });
    });
   });
  </script>
 <div class="fn-clear"></div>
</div>
<?php include '_banner.php';?>