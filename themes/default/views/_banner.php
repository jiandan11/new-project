<!-- 通用 banner幻灯 是否100% -->
<div class="dbgms_wrap" style="width: 100%;">
 <!-- 幻灯预览 -->
 <div class="dbgms_banner_wrap" style="">
  <div class="siteBanner" id="DbgMsBanner">
   <div class="bd" id="bd">
    <ul style="position: relative; width: 1000px; height: 250px;">
<?php $banner= getLists ( 1, "model|1;state|20;sort|id;sorttype|desc;row|3;" );foreach ($banner as $val):?>
<li><img style="width: 1000px; height: 250px;" src="<?php echo $val['slide'];?>" title="幻灯1"></li>
<?php endforeach;?>
     </ul>
   </div>
   <div class="hd">
    <ul>
<?php foreach ($banner as $key=>$val):?>
<li><?php echo ($key+1);?></li>
<?php endforeach;?>    
    </ul>
   </div>
   <a class="prev" href="javascript:void(0)"></a> <a class="next" href="javascript:void(0)"></a>
  </div>
  <script type="text/javascript">
    var ary = location.href.split("&");
    jQuery("#DbgMsBanner").slide({
     mainCell : "#bd ul",
     effect : "fold",
     autoPlay : "true",
     trigger : "mouseover",
     easing : "swing",
     delayTime : "1000",
     mouseOverStop : "true",
     pnLoop : "true"
    });
   </script>
 </div>
</div>