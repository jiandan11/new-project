<?php include '_header.php';?>

<style type="text/css">
    .zcd{
       margin-left: 30px;
    }
</style>

<div style="height:316px; width:100%;background:url(<?php echo $_uiurl?>images/ny_banner.jpg) no-repeat center top;"></div>
<div class="zhutibg">
  <div class="zhuti">
<!--    --><?php //$colum = getColumn(1, $_column,true); ?>
    <div class="left">
      <div class="left_top"><?php echo $colum['name'] ?>    /<span>News</span></div>
        <?php $colum = getColumn(1, 'product'); ?>

      <div class="left_dh">
        <ul>
            <?php foreach ($colum['list'] as $value) : ?>
                <li onmouseout="yczcd(this)" onmouseover="xszcd(this)" >
                    <div><a href="<?php echo $value['link'] ?>"><?php echo $value['name'] ?></a></div>
                    <?php if(!empty($value['list'])):?>
                        <!-- 二级栏目 -->
                        <div style="display: none" class="zcd">
                            <?php foreach ($value['list'] as $val):?>
                                <dt><a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></dt>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                </li>
            <?php endforeach; ?>
        </ul>
      </div>
      <div class="left_top">联系我们 <span>Contact Us</span></div>
      <img src="<?php echo $_uiurl?>images/lxtop.gif" height="119" />
      <div class="left_lx">
        <p></p>
        <?php $aaa = getFragment(1);echo $aaa['content']; ?>
      </div>
    </div>
    <div class="right">
      <div class="right_dh">
        <div class="right_dh_l"><?php echo $_navigation?></div>
      </div>
      <div class="right_conp">
          <?php foreach ($_list as $val): ?>
                <div class="propic">
                  <div class="proshow"><a href="<?php echo $val['link'] ?>"><img src="<?php echo $val['thumb'] ?>" width="220" height="220" alt="<?php echo $val['title'] ?>"></a></div>
                  <div class="proname"><?php echo $val['title'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="clear"></div>
        <div class="yema"><?php echo $_pagebreak; ?></div>
      </div>
    </div>
  </div>
</div>
<?php include '_footer.php';?>

<script type="text/javascript">
    function xszcd(obj) {
        if(obj.children.length>1){
            obj.children[1].style.cssText = 'display:inline-block;';
        }
    }

    function yczcd(obj) {
        if(obj.children.length>1){
            obj.children[1].style.cssText = 'display:none;';
        }
    }

</script>