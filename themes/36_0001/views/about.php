<?php include '_header.php';?>
<div style="height:316px; width:100%;background:url(<?php echo $_uiurl?>images/ny_banner.jpg) no-repeat center top;"></div>
<div class="zhutibg">
  <div class="zhuti">
          <?php $colum = getColumn(1, 'product'); ?>
    <div class="left">
      <div class="left_top"><?php echo $colum['name'] ?>    /<span>News</span></div>
      <div class="left_dh">
        <ul>
            <?php foreach ($colum['list'] as $value) : ?>
                <li><a href="<?php echo $value['link'] ?>" ><?php echo $value['name'] ?></a></li>
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
      <div class="right_con">
        <h1><?php echo $_content['title'] ?></h1>
        <br />
        <?php echo $_content['content'] ?>
      </div>
    </div>
  </div>
</div>
<?php include '_footer.php';?>