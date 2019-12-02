<?php include '_header.php';?>

 <div class="fwmain">
     <?php $colum = getColumn(1, 'product',true); ?>
  <div class="fwmain_nleft edit_putHere" id="edit_putHere_area1" saveTitle="area1">

   <div class="label clear fwtop_nav6" id="139" rel="139" titles="竖形分类菜单">

    <div class="label_head">

     <div class="label_title"><?php echo $colum['name'];?></div>

    </div>

    <div class="label_content">

        <?php foreach ($colum['list'] as $val):?>

         <h1><a href="<?php echo $val['link']?>"><?php echo $val['name']?></a></h1>

        <?php endforeach;?>

    </div>

    <div class="label_foot"></div>

   </div>

   <div class="label clear" id="387" rel="387" titles="自定义内容">

    <div class="label_head">

     <div class="label_title">联系我们</div>

    </div>

    <div class="label_content">

     <div class="about_con clearfix">

      <ul id="udContent387">

       <li><?php $aaa= getFragment(1);echo $aaa['content'];?></li>

      </ul>

     </div>

    </div>

    <div class="label_foot"></div>

   </div>

  </div>

  <div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">

   <div class="label clear" id="390" rel="390" titles="产品列表">

    <div class="label_head">

     <div class="label_title">产品展示</div>

    </div>

    <div class="label_content">

     <div class="pic_list1 pic_list_roll" id="pic_list390">

      <ul class="clearfix" id="prolist390">

        <?php foreach ($_list as $val):?>

         <li><a title="<?php echo $val['title']?>" href="<?php echo $val['link']?>"><img src="<?php echo $val['thumb']?>" style='width: 160px; height: 160px;' alt="<?php echo $val['title']?>" title="<?php echo $val['title']?>" />

          <p class="title"><?php echo $val['title']?></p></a></li>

        <?php endforeach;?>



      </ul>

      <div class="clear holder pager390"><?php echo $_pagebreak;?></div>



     </div>

    </div>

    <div class="label_foot"></div>

   </div>



  </div>

  <div class="clear"></div>

 </div>

 <?php include '_footer.php';?>

