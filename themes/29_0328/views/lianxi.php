<?php include '_header.php';?>
 <div class="fw_content">
   <div class="fwmain_nleft edit_putHere" id="edit_putHere_area1" saveTitle="area1">
    <div class="label clear fwtop_nav6" id="334" rel="334" titles="竖形分类菜单">
     <div class="label_head">
      <div class="label_title">联系我们</div>
     </div>
     <div class="label_content">
          <h1><a href="<?php echo $_baseurl;?>">网站首页</a></h1>
         
          <?php  foreach ($_navs as $key=>$val):?>
          
           <?php if(!$val['list']):?>
                <h1 <?php echo $val['sign'] == $_column?'class="selectCheck"':"";?>><a href="<?php echo $val['link']?>"><?php echo $val['name']?></a></h1>
           <?php else :?> 
            <h1 id='h3342' onClick="javascript:ShowMenu(this,'<?php echo 'no334'+ $val["id"]?>')"><a href="javascript:void(0)"><?php echo $val['name']?></a></h1> 
            <span id="<?php echo 'no334'+ $val["id"]?>" class="no">
                <?php  foreach ($val['list'] as $key1=>$val1):?>
                    <h2><a href="<?php echo $val1['link']?>"><?php echo $val1['name']?></a></h2>
                <?php endforeach;?>
            </span>
           <?php  endif?>
           <?php endforeach?>

     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
    <div class="label clear" id="333" rel="333" titles="自定义内容">
     <div class="label_head">
      <div class="label_title"><?php echo $_channel["name"]?></div>
     </div>
     <div class="label_content">
      <div class="about_con clearfix">
       <ul id="udContent333">
        <li><p><?php echo $_content['content']?></p></li>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="clear"></div>
  </div>
<?php include '_footer.php';?>
