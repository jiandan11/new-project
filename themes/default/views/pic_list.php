<?php include '_header.php';?>
<!-- 通用主体 -->
<div class="dbgms_main_wrap">
 <!-- 通用块 -->
 <div class="dbgms_block_wrap" style="width: 730px; float: left;">
  <div class="dbgms_navigation"><?php echo $_navigation;?></div>
  <div class="sep10"></div>
  <script type="text/javascript">
        $(document).ready(function () {
            <?php if(!empty($_so)):?>
            $('body,html').animate({ scrollTop: 400 }, 1500);
            <?php endif;?>
        });
    </script>
  <form id="DbgMsChannelSo" name="DbgMsChannelSo" method="post">
   <div class="dbgms_expand1">
    <div class="dbgms_expand1_head">
     <h3>多维分类 dbgms_expand1</h3>
    </div>
    <div class="dbgms_expand1_select">
     <label class="dbgms_expand1_select_title">您已选择：</label>
     <!--  -->
<?php foreach ($_channel['expand'] as $val):?>
<?php if(!empty($val['list'])):?>
 <?php foreach ($val['list'] as $val2):?>
   <?php if(in_array($val2['sign'],$_so)):?>
     <a href="#" class="dbgms_expand1_select_a"><?php echo $val2['title']?><em class="dbgms_expand1_select_em">x</em></a>
   <?php endif;?>
 <?php endforeach;?>
   <?php endif;?>
<?php endforeach;?>
    </div>
    <div class="fn-clear"></div>
    <div class="dbgms_expand1_filter">
<?php foreach ($_channel['expand'] as $val):?>
<?php if(!empty($val['list'])):?>
 <ul>
 <?php foreach ($val['list'] as $val2):?>
 <?php if($val['type']==0):?>
    <li class="title"><label><input type="radio" <?php echo in_array($val2['sign'],$_so)?'checked':'';?> name="so[<?php echo $val['sign']?>][]" value="<?php echo $val2['sign']?>"><?php echo $val2['title']?></label></li>
 <?php elseif($val['type']==1):?>
   <li class="title"><label><input type="checkbox" <?php echo in_array($val2['sign'],$_so)?'checked':'';?> name="so[<?php echo $val['sign']?>][]" value="<?php echo $val2['sign']?>"><?php echo $val2['title']?></label></li>
 <?php endif;?>
 <?php endforeach;?>
 <div class="fn-clear"></div>
     </ul>  
   <?php endif;?>
<?php endforeach;?>
    <div class="fn-clear"></div>
    </div>
    <input type="button" class="dbgms_expand1_submit" id="DbgMsChannelSoSubmit" value="多维搜索">
    <script type="text/javascript">
    $(document).ready(function(){
       var channel_url = '<?php echo $_channel['link']?>'; 
       var base_url = '<?php echo $_baseurl;?>'; 
       $('#DbgMsChannelSoSubmit').on('click',function(){
           var curr_so_expand = window.location.href.split("#")[0];
           $.ajax({
               url:base_url+'zh/getchannelsourl',
               type:'post',
               data:$('#DbgMsChannelSo').serialize(),
               dataType:'json',
               success:function(result){
            	   if(curr_so_expand.indexOf("?") != -1){
                	   curr_so_expand += result.url;
                   }else{
                	   curr_so_expand += '?so=channel'+ result.url; 
                   } 
                   document.DbgMsChannelSo.action  = '?so=channel'+ result.url; 
                   console.log(curr_so_expand );
            	   document.DbgMsChannelSo.submit(); 
               }
           });
       });
    });
   </script>
   </div>
  </form>
  <div class="sep10"></div>
  <div class="dbgms_expand1">
   <div class="dbgms_expand1_head">
    <h3>多维筛选 dbgms_expand2</h3>
   </div>
   <div class="dbgms_expand1_filter">
<?php foreach ($_channel['expand'] as $val):?>
<?php if(!empty($val['list'])):?>
 <ul>
 <?php foreach ($val['list'] as $val2):?>
   <li class="title"><a href="?<?php echo $val2['link'];?>"><?php echo $val2['title']?></a></li>
 <?php endforeach;?>
 <div class="fn-clear"></div>
    </ul>  
   <?php endif;?>
<?php endforeach;?>
   </div>
  </div>
  <div class="sep10"></div>
  <div class="dbgms_list1">
   <div class="dbgms_list1_head">
    <h3>产品库 dbgms_list1</h3>
   </div>
   <div class="dbgms_list1_list">
    <ul>
<?php foreach ($_list as $val):?>
<li>
      <div class="pic">
       <a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>"><img src="<?php echo $val['thumb'];?>" width="140" height="120" alt="s"></a>
      </div>
      <div class="info">
       <div class="title">
        <a href="<?php echo $val['link'];?>" target="_blank" title="<?php echo $val['title'];?>"><?php echo $val['title'];?></a>
       </div>
       <div class="description">基本参数</div>
       <div class="ext">价格：1099 &nbsp;&nbsp;</div>
      </div>
      <div class="right_btn">
       <div class="title">
        <a href="<?php echo $val['link'];?>">加入购物车</a>
       </div>
       <div class="title">
        <a href="<?php echo $val['link'];?>">添加收藏</a>
       </div>
       <div class="ext">立即查看：1099 &nbsp;&nbsp;</div>
      </div>
     </li>
<?php endforeach;?>
   </ul>
    <div class="fn-clear"></div>
   </div>
  </div>
  <div class="pagenum"><?php echo $_pagebreak;?></div>
 </div>
  <?php include '_right.php';?>
 <div class="fn-clear"></div>
</div>
<?php include '_footer.php';?>
