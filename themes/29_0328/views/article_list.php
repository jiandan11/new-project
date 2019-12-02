<?php include '_header.php';?>
  <div class="fw_content">
   <div class="fwmain_nleft edit_putHere" id="edit_putHere_area1" saveTitle="area1">
    <div class="label clear fwtop_nav6" id="357" rel="357" titles="竖形分类菜单">
     <div class="label_head">
      <div class="label_title"><?php echo $_channel["name"]?></div>
     </div>
     <div class="label_content">
           <?php foreach($_channel['list']  as $val):?>
            <h1><a href="<?php echo $val['link']?>" title="<?php echo $val['name']?>"><?php echo $val['name']?></a></h1>
        <?php endforeach;?>
     </div>
     <div class="label_foot"></div>
    </div>
    <div class="label clear" id="250" rel="250" titles="自定义内容">
     <div class="label_head">
      <div class="label_title">联系我们</div>
     </div>
     <div class="label_content">
      <div class="about_con clearfix">
       <ul id="udContent250">
        <li><?php $aaa= getFragment(1);echo $aaa['content'];?></li>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
    <div class="label clear" id="249" rel="249" titles="文章列表">
     <div class="label_content">
      <div class="item_list id249">
       <ul class="clearfix" id="articlelist249">
         <?php foreach ($_list as $val):?>
            <li><a title="<?php echo $val['title'];?>" href="<?php echo $val['link'];?>"><?php echo $val['title'];?></a> <span class="datetime"><?php echo date('Y-m-d',$val['intime']);?></span></li>
            <?php endforeach;?>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="clear"></div>
  </div>
<?php include '_footer.php';?>