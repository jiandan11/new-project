 <div class="fwbottom">
  <div class="fwbottom_bottomInfo">
   <div class="siteBottomNav">
    <ul>
        <?php foreach ($_navs as $key=>$val) :?>
            <li><a href="<?php echo $val['link'];?>" target="_blank" style="color:#ffffff;margin-right:20px;"><?php echo $val['name'];?></a></li>
        <?php endforeach;?>  
     <div class="clear"></div>
    </ul>
   </div>
   <div class="bottomInfo clear">
    <p align="center">
     <?php echo $_site['copyright'];?>&nbsp; <a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo $_site['icp'];?></a>
    </p>
    <p align="center">
     网站推广&nbsp;|&nbsp;网站建设&nbsp; |&nbsp;技术支持：<a href="http://www.kuaisou360.com/" target="_blank">福州快搜网络技术有限公司</a>&nbsp;建站热线：400-8851-360.
    </p>
   </div>
  </div>
  <div class="clear"></div>
 </div>
</body>
</html>
