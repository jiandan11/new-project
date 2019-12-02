<?php include '_header.php';?>
   <div class="fw_content">
   <div class="fwmain_nleft edit_putHere" id="edit_putHere_area1" saveTitle="area1">
    <div class="label clear fwtop_nav6" id="355" rel="355" titles="竖形分类菜单">
     <div class="label_head">
      <div class="label_title"><?php echo $_channel['name']?></div>
     </div>
        <?php $colum = getColumn(1, 'product'); ?>
     <div class="label_content">
         <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
         foreach ($colum['list'] as $key=>$value) : ?>
             <h1 class = <?php  echo $value['sign']==$_column?"now":"";?>>
                 <a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>"  style="font-size: 16px"> <?php echo $value['name'] ?> </a>
                 <?php if(!empty($value['list'])):?>
                     <!-- 二级栏目 -->
                     <dl style="margin-left: 20px">
                         <?php foreach ($value['list'] as $val):?>
                             <dt><a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></dt>
                         <?php endforeach;?>
                     </dl>
                 <?php endif;?>
             </h1>
         <?php endforeach; ?>
     </div>
     <div class="label_foot"></div>
    </div>
    <div class="label clear" id="234" rel="234" titles="自定义内容">
     <div class="label_head">
      <div class="label_title">联系我们</div>
     </div>
     <div class="label_content">
      <div class="about_con clearfix">
       <ul id="udContent234">
        <li><?php $aaa= getFragment(1);echo $aaa['content'];?></li>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
    <div class="label clear" id="232" rel="232" titles="产品列表">
     <div class="label_content">
         <div  style="text-align:left; margin:0px auto; height:40px; line-height:40px; padding-left:24px;font-size: 18px;"><?php echo $_navigation?></div>
      <div class="pic_list1 pic_list_roll" id="pic_list232">
       <ul class="clearfix" id="prolist232">
            <?php foreach ($_list as $val):?>
            <li> <a title="<?php echo $val['title']?>" href="<?php echo $val['link']?>"><img src="<?php echo $val['thumb']?>" style='width: 220px; height: 340px;' alt="<?php echo $val['title']?>"/>
              <p class="title"><?php echo $val['title']?></p>
              </a> </li>
            <?php endforeach;?>
       </ul>
       <div class="clear holder pager232"><?php echo $_pagebreak;?></div>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="clear"></div>
  </div>
<?php include '_footer.php';?>