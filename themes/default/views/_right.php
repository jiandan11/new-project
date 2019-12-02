<!-- 通用块 -侧栏-->
<div class="dbgms_block_wrap" style="width: 230px; float: right;">
 <div class="dbgms_boxlist1">
  <div class="dbgms_boxlist1_head">
   <h3>栏目列表 dbgms_boxlist1</h3>
  </div>
  <div class="dbgms_boxlist1_list">
   <ul>
    <li><span class="title"><a href="123">123</a> </span></li>
    <li><span class="title"><a href="123>">123</a> </span></li>
<?php foreach ($channel['list'] as $key=>$val):?>
<li><span class="title"><a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a> </span></li>
<?php endforeach;?>
    </ul>
  </div>
 </div>

 <div class="dbgms_boxlist2">
  <div class="dbgms_boxlist2_head">
   <h3>热门内容 dbgms_boxlist2</h3>
  </div>
  <div class="dbgms_boxlist2_list">
   <ul>  
<?php $lists=getLists(1,'model|1;cid|1;row|5;');foreach($lists as $key=>$val):?>
<li><span class="num"><?php echo ($key+1);?></span><span class="title"><a href="<?php echo $val['link'];?>" title="<?php echo $val['title'];?>"><?php echo dbg_strcut($val['title'],35);?>...</a> </span></li>
 <?php endforeach;?>
    </ul>
  </div>
 </div>

 <div class="dbgms_boxlist2">
  <div class="dbgms_boxlist2_head">
   <h3>随机内容 dbgms_boxlist2</h3>
  </div>
  <div class="dbgms_boxlist2_list">
   <ul>
<?php $lists=getLists(1,'model|1;cid|1;row|5;');foreach($lists as $key=>$val):?>
<li><span class="num"><?php echo ($key+1);?></span><span class="title"><a href="<?php echo $val['link'];?>" title="<?php echo $val['title'];?>"><?php echo dbg_strcut($val['title'],35);?>...</a> </span></li>
<?php endforeach;?>
   </ul>
  </div>
 </div>
</div>