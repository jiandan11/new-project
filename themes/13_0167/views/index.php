<?php include '_header.php';?>
 <div class="fwmain">
  <div class="fwmain_left edit_putHere" id="edit_putHere_area1" saveTitle="area1">
   <div class="label clear fwtop_nav6" id="446" rel="446" titles="竖形分类菜单">
    <div class="label_head">
     <div class="label_title">产品分类</div>
    </div>
    <div class="label_content">
    <?php $product = getColumn ( 1, 'product' );?>
    <?php foreach ($product['list'] as $key=>$val):?>
        <h1><a href="<?php echo $val['link']?>"><?php echo $val['name']?></a></h1>
    <?php endforeach;?>
    </div>
    <div class="label_foot"></div>
   </div>
   <div class="label clear" id="447" rel="447" titles="文章列表">
    <div class="label_head">
     <div class="label_title">最新文章</div>
     <div class="link_more">
      <a class="more" href="/zh/news/" title="最新文章" target="_blank">更多</a>
     </div>
    </div>
    <div class="label_content">
     <div class="item_list id447">
      <?php $newsc = getColumn ( 1, 'news' );$lists = getLists ( 1, "model|1;nostate|20;cid|{$newsc['clists']};sort|intime;sorttype|desc;row|5" );?> 
      <ul class="clearfix" id="articlelist447">
        <?php foreach ($lists as $key=> $val):?>
        <li><a title="<?php echo $val['title'];?>" href="<?php echo $val['link'];?>"><?php echo $val['title'];?></a> <span class="datetime"><?php echo date('Y-m-d',$val['intime']);?></span></li>
        <?php endforeach;?> 
      </ul>
     </div>
    </div>
    <div class="label_foot"></div>
   </div>

  </div>
  <div class="fwmain_center edit_putHere" id="edit_putHere_area2" saveTitle="area2">
   <div class="label clear" id="437" rel="437" titles="产品列表">
    <div class="label_head">
     <div class="label_title">产品展示</div>
     <div class="link_more">
      <a href="/zh/product/" class="more" title="产品展示" target="_blank">更多</a>
     </div>
    </div>
    <div class="label_content">
     <div class="pic_list1 pic_list_roll" id="pic_list437">
      <?php $product = getColumn ( 1, 'product' );$lists = getLists ( 1, "model|1;nostate|20;cid|{$product['clists']};sort|intime;sorttype|desc;row|3" );?>
      <ul class="clearfix" id="prolist437">
        <?php foreach ($lists as $key=> $val):?>
         <li><a title="<?php echo $val['title'];?>" href="<?php echo $val['link'];?>"><img src="<?php echo $val['thumb'];?>" style='width: 105px; height: 97px;' alt="<?php echo $val['title'];?>" title="<?php echo $val['title'];?>" />
                <p class="title"><?php echo $val['title'];?></p></a></li>
        <?php endforeach;?>
       <div class="clear"></div>
      </ul>
     </div>
    </div>
    <div class="label_foot"></div>
   </div>
   <div class="label clear" id="419" rel="419" titles="自定义内容">
    <div class="label_head">
     <div class="label_title">公司简介</div>
    </div>
    <div class="label_content">
     <div class="about_con clearfix">
      <ul id="udContent419">
       <li><?php $aaa= getFragment(2);echo $aaa['content'];?></li>
      </ul>
     </div>
    </div>
    <div class="label_foot"></div>
   </div>

  </div>
  <div class="fwmain_right edit_putHere" id="edit_putHere_area3" saveTitle="area3">
   <div class="label clear" id="439" rel="439" titles="文章列表">
    <div class="label_head">
     <div class="label_title">热门文章</div>
     <div class="link_more">
      <a class="more" href="#/118" title="热门文章" target="_blank">更多</a>
     </div>
    </div>
    <div class="label_content">
     <div class="item_list id439">
      <?php $newsc = getColumn ( 1, 'news' );$lists = getLists ( 1, "model|1;nostate|20;cid|{$newsc['clists']};sort|intime;sorttype|desc;row|4" );?>
      <ul class="clearfix" id="articlelist439">
        <?php foreach ($lists as $key=> $val):?>
        <li><a title="<?php echo $val['title'];?>" href="<?php echo $val['link'];?>"><?php echo $val['title'];?></a> <span class="datetime"><?php echo date('Y-m-d',$val['intime']);?></span></li>
        <?php endforeach;?> 
      </ul>
     </div>
    </div>
    <div class="label_foot"></div>
   </div>
   <div class="label clear" id="442" rel="442" titles="自定义内容">
    <div class="label_head">
     <div class="label_title">联系方式</div>
    </div>
    <div class="label_content">
     <div class="about_con clearfix">
      <ul id="udContent442">
       <li><?php $aaa= getFragment(1);echo $aaa['content'];?></li>
      </ul>
     </div>
    </div>
    <div class="label_foot"></div>
   </div>

  </div>
  <div class="clear"></div>
  <div class="fwmain_total edit_putHere" id="edit_putHere_area4" saveTitle="area4">
   <div class="label clear" id="443" rel="443" titles="产品列表">
    <div class="label_head">
     <div class="label_title">产品展示</div>
     <div class="link_more">
      <a href="/zh/product/" class="more" title="产品展示" target="_blank">更多</a>
     </div>
    </div>
    <div class="label_content">
     <div class="pic_list1 pic_list_roll" id="pic_list443">
      <?php $product = getColumn ( 1, 'product' );$lists = getLists ( 1, "model|1;nostate|20;cid|{$product['clists']};sort|intime;sorttype|desc;row|6" );?>
      <ul class="clearfix" id="prolist443">
        <?php foreach ($lists as $key=> $val):?>
         <li><a title="<?php echo $val['title'];?>" href="<?php echo $val['link'];?>"><img src="<?php echo $val['thumb'];?>" style='width: 160px; height: 150px;' alt="<?php echo $val['title'];?>" title="<?php echo $val['title'];?>" />
                <p class="title"><?php echo $val['title'];?></p></a></li>
        <?php endforeach;?>  
      </ul>
     </div>
    </div>
    <div class="label_foot"></div>
   </div>
   <script type='text/javascript'>
				jQuery('#pic_list443').slide({
					mainCell : 'ul',
					autoPlay : true,
					effect : 'leftMarquee',
					interTime : 50,
					vis : 6
				});
			</script>

  </div>
 </div>
<?php include '_footer.php';?>
