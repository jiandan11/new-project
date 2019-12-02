<?php include '_header.php';?>
<!-- 通用主体 -->
<div class="dbgms_main_wrap">
 <!-- 通用块 -->
 <div class="dbgms_block_wrap" style="width: 750px; float: left;">
  <div class="index_wrap">
   <!--幻灯片-->
   <div class="slideshow fn-left">
    <ul>
<?php $banner= getLists ( 1, "model|1;state|20;row|3;" );foreach ($banner as $val):?>
<li><a href="<?php echo $val['link'];?>" title="#" target="_blank"><img src="<?php echo $val['slide'];?>" width="300" height="300" alt="<?php echo $val['title'];?>"></a></li>
<?php endforeach;?>
</ul>
<?php foreach ($banner as $val):?>
    <div class="smallslider-tex smallslider-lay"></div>
    <div class="smallslider-btns"></div>
<?php endforeach;?>
<script type="text/javascript">
$(document).ready(function() {
 /* 幻灯片效果 */
 $('.slideshow').smallslider({
  textrecommend : 'top',
  textAlign : 'center',
  textSwitch : 2
 });
});</script>
   </div>
   <!--END-->
   <!--首页推荐-->
   <div class="indexhot">
<?php $lists=getLists(1,'model|1;cid|1;row|3;');foreach($lists as $key=> $val):?>
<div class="hotbox">
     <h2 style="overflow: hidden;">
      <a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>"><?php echo $val['title'];?></a>
     </h2>
     <p><?php echo dbg_strcut($val['content'],100);?></p>
    </div>
    <div class="sep10"></div>
<?php endforeach;?>
	<div class="hotlist">
     <ul>
     </ul>
    </div>
   </div>
   <!--END-->
   <div class="fn-clear"></div>
  </div>
  <!--END-->
  <div class="fn-clear"></div>

  <div class="dbgms_list3">
   <!--图片列表-->
   <div class="dbgms_list3_head">
    <h3>产品库 dbgms_list3</h3>
   </div>
   <div class="dbgms_list3_list">
    <ul>
<?php
$newslist = getColumn ( 1, 'news' );
$lists = getLists ( 1, "model|1;nostate|20;cid|{$newslist['clists']};sort|intime;sorttype|desc;row|4" );
?>
<?php foreach ($lists as $key=> $val):?>
  <li>
      <div class="pic">
       <a href="<?php echo $val['link'];?>" target="_blank" title="联想 A830"><img src="<?php echo $val['thumb'];?>" width="155" height="110" alt="<?php echo $val['title'];?>"></a>
      </div>
      <div class="title">
       <a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>"><?php echo $val['title'];?></a>
      </div>
     </li>
<?php endforeach;?>
      </ul>
    <div class="fn-clear"></div>
   </div>
  </div>
  <!--END-->
  <div class="sep10"></div>


  <!--栏目模块-->
  <div class="dbgms_list3">
   <div class="dbgms_list3_head">
    <h3>栏目列表 dbgms_list3</h3>
   </div>
   <div id="classbox">
<?php
$newslist = getColumn ( 1, 'news' );
$lists = getLists ( 1, "model|1;nostate|20;cid|{$newslist['clists']};sort|intime;sorttype=desc;row|5" );
?>
   <div class="dbgms_list4">
     <div class="dbgms_list4_head">
      <h3><a href="###" title="新闻资讯">新闻资讯 dbgms_list4</a></h3> <span class="more"><a href="###" title="新闻资讯">more</a></span>
     </div>
     <div class="dbgms_list4_pic">
      <div class="pic">
       <a href="<?php echo $lists[0]['link'];?>" target="_blank" title=""><img src="<?php echo $lists[0]['thumb'];?>" width="110" height="90" alt="<?php echo $lists[0]['title'];?>"></a>
      </div>
      <div class="info">
       <div class="title">
        <a href="<?php echo $lists[0]['link'];?>" target="_blank" title=""><?php echo $lists[0]['title'];?></a>
       </div>
       <p><?php echo dbg_strcut($lists[0]['content'], 50);?></p>
      </div>
     </div>
     <div class="dbgms_list4_list">
      <ul>
<?php foreach ($lists as $key=> $val):?>
<?php if($key==0){continue;}?>
<li><span class="line">•</span><span class="title"><a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>"><?php echo $val['title'];?></a> </span> <span class="time"><?php echo date('Y-m-d',$val['intime']);?></span></li>
<?php endforeach;?>
     </ul>
     </div>
    </div>
   
<?php
$coulmn = getColumn ( 1, 'product' );
$lists = getLists ( 1, "model|1;nostate|20;cid|{$coulmn['clists']};sort|intime;sorttype=desc;row|5" );
?>   
   <div class="dbgms_list4">
     <div class="dbgms_list4_head">
      <h3><a href="###" title="产品中心">产品中心 dbgms_list4</a></h3> <span class="more"><a href="###" title="产品中心">more</a></span>
     </div>
     <div class="dbgms_list4_pic">
      <div class="pic">
       <a href="<?php echo $lists[0]['link'];?>" target="_blank" title=""><img src="<?php echo $lists[0]['thumb'];?>" width="110" height="90" alt="<?php echo $lists[0]['title'];?>"></a>
      </div>
      <div class="info">
       <div class="title">
        <a href="<?php echo $lists[0]['link'];?>" target="_blank" title=""><?php echo $lists[0]['title'];?></a>
       </div>
       <p><?php echo dbg_strcut($lists[0]['content'], 50);?></p>
      </div>
     </div>
     <div class="dbgms_list4_list">
      <ul>
<?php foreach ($lists  as $key=> $val):?>
<?php if($key==0){continue;}?>
<li><span class="line">•</span><span class="title" style="width: 200px; overflow: hidden;"><a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>"><?php echo $val['title'];?></a> </span> <span class="time"><?php echo date('Y-m-d',$val['intime']);?></span></li>
<?php endforeach;?>
     </ul>
     </div>
    </div>
    <div class="fn-clear"></div>
   </div>
   <!--END-->
  </div>

<?php
$coulmn = getColumn ( 1, 'product' );
$lists = getLists ( 1, "model|1;nostate|20;cid|{$coulmn['clists']};sort|intime;sorttype=desc;row|5" );
?>   
  <div class="dbgms_list5">
   <div class="dbgms_list5_head">
    <h3>当前内容列表样式 dbgms_list5</h3>
   </div>
   <div class="dbgms_list5_list">
    <ul>
<?php foreach ($lists  as $key=> $val):?>
<li><a title="<?php echo $val['title'];?>" href="<?php echo $val['link'];?>"><img src="<?php echo $val['thumb'];?>" style="width: 210px; height: 150px;" alt="<?php echo $val['title'];?>" title="<?php echo $val['title'];?>">
       <p class="title"><?php echo $val['title'];?></p></a></li>
<?php endforeach;?>    
    </ul>
    <div class="fn-clear"></div>
   </div>
  </div>

  <div class="dbgms_list6">
   <div class="dbgms_list6_head">
    <h3>当前内容列表样式 dbgms_list6</h3>
   </div>
   <div class="dbgms_list6_list" id="DbgMsList6" style="overflow: hidden; width: 710px; margin: 0 auto;">
    <ul>
<?php foreach ($lists  as $key=> $val):?>
<li style="float: left; width: 215px;" class="clone"><a title="<?php echo $val['title'];?>" href="#"><img src="<?php echo $val['thumb'];?>" style="width: 200px; height: 150px;" alt="<?php echo $val['title'];?>" title="<?php echo $val['title'];?>">
       <p class="title"><?php echo $val['title'];?></p></a></li> 
<?php endforeach;?>  
      </ul>
   </div>
   <script type="text/javascript">
     jQuery('#DbgMsList6').slide({
      mainCell : 'ul',
      autoPlay : true,
      effect : 'leftMarquee',
      interTime : 50,
      vis : 5
     });
    </script>
   <div class="fn-clear"></div>
  </div>


 </div>

 <!--边栏-->
 <div class="dbgms_block_wrap" id="sidebar" style="width: 250px; float: right;">
  <div class="dbgms_box1">
   <div class="dbgms_box1_head">
    <h3>公告信息 dbgms_box1</h3>
   </div>
   <div class="dbgms_box1_content"><?php $aaa= getFragment(1);echo $aaa['content'];?></div>
  </div>

  <div class="dbgms_boxlist2">
   <div class="dbgms_boxlist2_head">
    <h3>热门内容 dbgms_boxlist2</h3>
   </div>
   <div class="dbgms_boxlist2_list">
    <ul>  
<?php $coulmn=getColumn(1,'news');$lists=getLists(1,"model|1;cid|{$coulmn['clists']};sort|intime;sorttype=desc;row|5" );?>
<?php foreach ($lists as $key=> $val):?>
<li><span class="num"><?php echo ($key+1);?></span><span class="title"><a href="<?php echo $val['link'];?>" title="<?php echo $val['title'];?>"><?php echo dbg_strcut($val['title'],35);?>...</a> </span></li>
 <?php endforeach;?>
    </ul>
   </div>
  </div>

  <div class="dbgms_boxlist2">
   <div class="dbgms_boxlist2_head">
    <h3>相关内容 dbgms_boxlist2</h3>
   </div>
   <div class="dbgms_boxlist2_list">
    <ul>  
<?php $coulmn=getColumn(1,'product');$lists=getLists(1,"model|1;cid|{$coulmn['clists']};sort|intime;sorttype=desc;row|5" );?>
<?php foreach ($lists as $key=> $val):?>
<li><span class="num"><?php echo ($key+1);?></span><span class="title"><a href="<?php echo $val['link'];?>" title="<?php echo $val['title'];?>"><?php echo dbg_strcut($val['title'],35);?>...</a> </span></li>
 <?php endforeach;?>
    </ul>
   </div>
  </div>

 </div>
 <div class="fn-clear"></div>
</div>
<?php include '_footer.php';?>