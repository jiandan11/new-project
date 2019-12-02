<div class="Foot_endbg">
  <div class="Foot_end">
    <div class="Foot_endtitle">
      <div class="Foot_endtitleL">

        <?php foreach ($_navs as $key => $val) : ?>
          <div class="Foot_endtitleL_Nav"> <a href="<?php echo $val['link']; ?>"><?php echo $val['name']; ?></a> </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="Foot_end_left">
        <?php foreach ($_navs as $key => $val) : ?>
            <div class="Foot_nav">
                <ul>
                 <?php foreach ($val['list'] as $sub) : ?>
                  <li><a href="<?php echo $sub['link']; ?>"> <?php echo $sub['name']; ?> </a></li>
                  <?php endforeach; ?>
                </ul>
          </div>
        <?php endforeach; ?>
     </div>
  </div>
</div>
<div class="Foot_banq">
  <div class="Foot_bq">
    <p align="center" style="color: #FFFFFF;"><?php echo $_site['copyright']; ?> &nbsp;<a href="http://www.beian.miit.gov.cn/" target="_blank" style="color: #FFFFFF;" ><?php echo $_site['icp']; ?></a></p>
        <p align="center" style="color: #FFFFFF;">网站推广&nbsp;|&nbsp;网站建设&nbsp;：<strong><a href="http://www.kuaisou360.com/" target="_blank" style="color: #FFFFFF;">福州快搜网络技术有限公司</a></strong> &nbsp;建站热线：400-8851-360.</p> 
 </div>
</div>
<?php include '_tool.php';?>
</body>
</html>

