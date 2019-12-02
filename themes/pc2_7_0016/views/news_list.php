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
          <ul class="en_news">
              <?php foreach ($_list as $val): ?>
              <li>
                  <span><?php echo date('Y-m-d',$val['intime']); ?></span>
                  <a href="<?php echo $val['link'] ?>"><?php echo $val['title'] ?></a>
              </li>
              <?php endforeach; ?>
        </ul>
          <div class="Page clearfix">
              <!--分页-->
              <?php echo $_pagebreak; ?>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<?php include '_foot.php'; ?>
