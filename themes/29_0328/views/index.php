<?php include '_header.php';?>
 <div class="fw_content">
   <div id="edit_putHere_area1" class="fwmain_left edit_putHere" savetitle="area1">
    <div class="label clear" id="327" rel="327" titles="自定义内容">
     <div class="label_head">
      <div class="label_title">PRODUCT</div>
      <div class="link_more">
       <a href="/zh/product" target="_blank" class="more">更多</a>
      </div>
     </div>
        <?php $colum = getColumn(1, 'product'); ?>
     <div class="label_content">
      <div class="about_con clearfix">
       <ul id="udContent327">
        <li><table class="ke-zeroborder" border="0" width="100%">
          <tbody>
           <tr align="center">
               <!--    产品分类   -->
               <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");foreach ($colum['list'] as $key=>$value) : ?>
               <td>
                   <a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>">
                       <div><img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/file' . $value['icon'] ?>" style="width:200px;height:300px;" alt="<?php echo $value['title'] ?>"/></div>
                       <div><?php echo $value['name'] ?></div>
                   </a>
               </td>
               <?php if($key==2)  break ?>
               <?php endforeach; ?>
           </tr>
          </tbody>
         </table>
        </li>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>


   <div id="edit_putHere_area4" class="fwmain_total edit_putHere" savetitle="area4">
    <div class="label clear" id="302" rel="302" titles="文章列表">
     <div class="label_head">
      <div class="label_title">新闻资讯</div>
      <div class="link_more">
       <a class="more" href="/zh/news" title="新闻资讯" target="_blank">更多</a>
      </div>
     </div>
     <div class="label_content">
      <div class="item_list2 id302">
       <ul class="clearfix" id="articlelist302">
       <?php
        function subTitle($content,$length)
           {
               $content = preg_replace("/<.*?>/", "", $content);
               if(strlen($content) > $length)
                   return mb_substr($content,0, $length) . "...";

               return $content;
           }
       $news = getColumn ( 1, 'news' );$lists = getLists ( 1, "model|1;nostate|20;cid|{$news['clists']};sort|intime;sorttype|desc;row|5" );?>
        <?php foreach ($lists as $key=> $val):?>
           <li><strong>01</strong>
            <div>
             <h4>
              <span class="datetime"><?php echo date('Y-m-d',$val['intime']);?></span><a title="<?php echo $val['title'];?>" href="<?php echo $val['link'];?>"><?php echo subTitle($val['title'],8);?></a>
             </h4>
             <p><?php echo subTitle($val['content'],50);?></p>
         </div></li>
        <?php endforeach;?>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>
    <script type="text/javascript">
	item_list2("302");
    </script>

   </div>

   <div id="edit_putHere_area2" class="fwmain_center edit_putHere" savetitle="area2"></div>
   <div id="edit_putHere_area3" class="fwmain_right edit_putHere" savetitle="area3">
    <div class="label clear" id="353" rel="353" titles="产品列表">
        <?php $product = getColumn ( 6, 'dianzichanpin' );;$lists = getLists ( 6, "model|6;nostate|20;cid|{$product['clists']};sort|intime;sorttype|desc;row|3" );?>
     <div class="label_head">
      <div class="label_title" style="padding-left: 500px;"><?php echo $product["sign"]?></div>
      <div class="link_more">
       <a href="<?php echo $product["link"]?>" class="more" title="<?php echo $product["sign"]?>" target="_blank">更多</a>
      </div>
     </div>

    <!--   轮播     -->
    <?php $colum = getColumn(1, 'product'); ?>
     <div class="label_content">
      <div class="pic_list1 pic_list_roll" id="pic_list353">
       <ul class="clearfix" id="prolist353">
<!--           --><?php //foreach ($lists as $key=> $val):?>
<!--                <li><a title="--><?php //echo $val['title'];?><!--" href="--><?php //echo $val['link'];?><!--"><img src="--><?php //echo $val['thumb'];?><!--" style='width: 225px; height: 310px;' alt="--><?php //echo $val['title'];?><!--" title="" />-->
<!--               <p class="title">--><?php //echo $val['title'];?><!--</p></a></li>-->
<!--            --><?php //endforeach;?>

           <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|10");
           foreach ($lists as $val): ?>
               <li>
                   <a title="<?php echo $val['title'] ?>" href="<?php echo $val['link'] ?>"><img src="<?php echo $val['thumb'] ?>" style="width:200px;height:300px;" alt="<?php echo $val['title'] ?>"/>
                       <p class="title"><?php echo $val['title'] ?></p></a>
               </li>
           <?php endforeach; ?>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>
    <script type='text/javascript'>
					jQuery('#pic_list353').slide({
						mainCell : 'ul',
						autoPlay : true,
						effect : 'left',
						vis : 6,
						scroll : 1,
						autoPage : true,
						pnLoop : false
					});
				</script>

   </div>
   <div class="clear"></div>

  </div>

 <?php include '_footer.php';?>