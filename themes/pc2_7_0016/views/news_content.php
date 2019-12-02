<?php include '_head.php';?>

<?php $colum = getColumn(1, $_channel["sign"]); ?>
<div class="sy_artcil">
  <div class="center">
    <div class="sy_pro">
      <div class="sy_l fl">
        <div class="lm_lb">
            <h2><?php echo $colum['name'] ?></h2>
            <ul>
                <?php foreach ($colum['list'] as $key=>$value) : ?>
                    <li><a href="<?php echo $value['link'] ?>"><?php echo $value['name'] ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="sy_lx">
          <h2>联系我们</h2>
            <!--   地址碎片   -->
            <div class="sy_lxwm">
                <?php $aaa = getFragment(3);echo $aaa['content']; ?>
            </div>
        </div>
      </div>
      <!--产品展示-->
      <div class="sy_r fr">
        <div class="pro">
          <div class="pro-tit">
            <h2> <?php echo $_navigation?></h2>
          </div>
          <div class="about_us">
            <div class="about_tit"><?php echo $_content['title'] ?></div>
            <div class="about_dat">时间：<?php echo date('Y-m-d',$_content['intime']); ?></div>
            <div class="about_img"><img src="<?php echo $_content['thumb'] ?>" id="imgs"/></div>
            <div class="about_cen"><?php echo $_content['content'] ?></div>
            <div class="fanye">
                <span class="fys">上一篇： <a href='<?php echo $_prev['link'] ?>'><?php echo $_prev['title'] ?></a></span>
                <span class="fyx">下一篇： <a href='<?php echo $_next['link'] ?>'><?php echo $_next['title'] ?></a></span>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<?php include '_foot.php'; ?>
