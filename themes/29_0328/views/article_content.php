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
    <div class="label clear" id="254" rel="254" titles="自定义内容">
     <div class="label_head">
      <div class="label_title">联系我们</div>
     </div>
     <div class="label_content">
      <div class="about_con clearfix">
       <ul id="udContent254">
        <li><?php $aaa= getFragment(1);echo $aaa['content'];?></li>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
    <div class="label labelDis news_detail" id="1" rel="1" titles="文章内容">
     <div class="news_detail_title"><?php echo $_content['title'];?></div>
     <div class="news_detail_info">
      <div class="news_detail_time"><?php echo date('Y-m-d',$_content['intime']);?></div>
      <div class="news_detail_from">来源:<?php echo $_content['source']?></div>
      <div class="news_detail_tool">点击数:&nbsp;<?php echo $_content['username']?>;作者:<?php echo $_content['username']?></div>
      <div class="clear"></div>
     </div>
     <div id="mcontent" class="news_detail_cont">
      <ul id="articleContent">
          <li>
               <?php echo str_replace('<img', '<img style="max-width:690px;"', $_content['content']);?>
          </li>
      </ul>
     </div>
     <div class="articleContent_other">
       <div class="prev-article">
      <a href='<?php echo $_prev['link'];?>'>上一篇:<?php echo $_prev['title'];?></a>
     </div>
     <div class="next-article" style="float: right; margin-top: -18px;">
      <a href='<?php echo $_next['link'];?>'>下一篇:<?php echo $_next['title'];?></a>
     </div>
     </div>
    </div>

   </div>
   <div class="clear"></div>
  </div>
<?php include '_footer.php';?>
