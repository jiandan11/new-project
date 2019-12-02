<?php include '_header.php';?>
<div class="fw_content">
   <div class="fwmain_nleft edit_putHere" id="edit_putHere_area1" saveTitle="area1">
    <div class="label clear fwtop_nav6" id="356" rel="356" titles="竖形分类菜单">
     <div class="label_head">
      <div class="label_title"><?php echo $_channel["name"]?></div>
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
    <div class="label clear" id="238" rel="238" titles="自定义内容">
     <div class="label_head">
      <div class="label_title">联系我们</div>
     </div>
     <div class="label_content">
      <div class="about_con clearfix">
       <ul id="udContent238">
        <li><?php $aaa= getFragment(1);echo $aaa['content'];?></li>
       </ul>
      </div>
     </div>
     <div class="label_foot"></div>
    </div>

   </div>
   <div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
    <div class="label labelContent product_detail" id="2" rel="2" titles="产品内容">
     <div class="product_intro" id="product_intro2">
      <div class="product_preview2" id="product_preview22">
       <div class="product_preview_sub2" id="product_preview_sub22" style='width: 300px; height: 450px;'>
        <ul>
            <li><img src="<?php echo $_content['thumb']?>" style='width: 300px; height: 450px;' alt="" title="" /></li>
<!--        --><?php //foreach($_content['imgs']  as $val):?>
<!--            <li><img src="--><?php //echo $val['url']?><!--" style='width: 300px; height: 450px;' alt="--><?php //echo $val['msg']?><!--" title="" /></li>-->
<!--        --><?php //endforeach;?>
        </ul>
       </div>
       <div class="product_preview_sub3" id="product_preview_sub32">
        <ul>
        <?php foreach($_content['imgs']  as $val):?>
            <li><img src="<?php echo $val['url']?>" style='width: 50; height: 50;' alt="<?php echo $val['msg']?>" title="" /></li>
        <?php endforeach;?>
        </ul>
       </div>
       <div class="clear"></div>
      </div>
      <script type="text/javascript">jQuery('#product_preview22').slide({ titCell:'#product_preview_sub32 li', mainCell:'#product_preview_sub22 ul',effect:'top', delayTime:200, autoPlay:false,triggerTime:0});</script>
      <div class="product_info2">
       <div class="product_name2"><?php echo $_content['title'];?></div>
       <div class="product_summary">
        <ul>
         <li><span>点击数:</span><span><?php echo $_content['hits'];?></span></li>
         <li><span>产品类别:</span><span><?php echo $_content['columnname'];?></span></li>
         <li><span>产品描述:</span><span><?php echo $_site['description']?></span></li>
        </ul>
       </div>
      </div>
      <div class="clear"></div>
     </div>
        
        <div class="productContent_other">
        <div class="prev-product">
         <a href='<?php echo $_prev['link']?>'>&nbsp;[→]&nbsp;<?php echo $_prev['title']?></a>
        </div>

        <div class="next-product">
         <a href='<?php echo $_next['link']?>'>&nbsp;[←]&nbsp;<?php echo $_next['title']?></a>
        </div>
   </div>
     <div class="product_detailmore">
      <div class="product_detailmore_title tab-hd">
       <ul class="tab-nav">
        <li><a href="javascript:void(0)">产品详情</a></li>
       </ul>
      </div>
      <div class="clear"></div>
      <div class="tab-bd">
       <div class="tab-pal">
        <div class="product_detailmore_content">
         <ul id="proContent">
          <li><?php echo $_content['content'] ?></li>
         </ul>
        </div>
       </div>

      </div>
     </div>
    </div>
    <script type="text/javascript">
$(".jqzoom").imagezoom();
jQuery(".product_detailmore").slide({ titCell:".tab-hd li", mainCell:".tab-bd",delayTime:0 });
$(function(){$('div.pager2dis58').jPages({containerID  : 'discuss2dis58',first: '首页',last: '尾页',previous: '上页',next: '下页',perPage:10,startPage: 1,startRange: 2,midRange: 5,endRange: 2,animation: 'wobble',scrollBrowse : false,keyBrowse: false,callback    : undefined});});
</script>

   </div>
   <div class="clear"></div>
  </div>

<?php include '_footer.php';?>