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
          <ul class="pro-c">
              <?php foreach ($_list as $val): ?>
                  <li>
                      <a href="<?php echo $val['link'] ?>" target="_blank"><img src="<?php echo $val['thumb'] ?>" width="272" height="230"></a>
                      <span><?php echo $val['title'] ?></span>
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

      <?php $colum = getColumn(1, 'news'); ?>
    <div class="xgnews"> <i>推荐资讯</i>
      <ul>
          <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
          foreach ($lists as $key=>$value) : ?>
              <li>
                  <span><?php echo date('Y-m-d',$value['intime']) ?></span>
                  <a href="<?php echo $value['link'] ?>"><?php echo $value['title'] ?></a>
              </li>
          <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<?php include '_foot.php'; ?>
