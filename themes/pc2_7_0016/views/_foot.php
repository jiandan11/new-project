
<div class="footer">
  <div class="center">
    <ul class="d_nav">
        <?php foreach ($_navs as $key=>$val):?>
            <li>
                <a href="<?php echo $val['link'];?>" ><?php echo $val['name'];?></a>
            </li>
        <?php endforeach;?>
    </ul>
    <div class="f_cen">
        <p><?php echo $_site['copyright'] ?></p>
        <p><?php echo $_site['icp']; ?></p>
    </div>
  </div>
</div>
</body>
</html>
