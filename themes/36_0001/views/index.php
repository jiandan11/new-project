<?php include '_header.php';?>
<style>
    .aTitle{
  text-overflow: ellipsis;
  width: 240px;
  overflow: hidden;
  white-space: nowrap;
  display:block;
}
</style>
<div class="focus" id="focus001">
  <ul>
       <?php $banner = getLists(1, "model|1;state|20;row|6;");
        foreach ($banner as $val): ?>      
            <li>
                <div style="width:100%; height:450px; background:url(<?php echo $val['slide']; ?>) center top no-repeat;"></div>
            </li>
        <?php endforeach; ?>
  </ul>
</div>
<div class="ztbg">
  <div class="zt">
    <div class="lmfl">
        <?php $colum = getColumn(1, 'product'); ?>
      <div class="lmfl_left">
        <div class="lmfl_left_title">产品分类  Products </div>
        <ul>
            <?php foreach ($colum['list'] as $value) : ?>
                  <li><a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" ><?php echo $value['name'] ?></a>
                  </li>
              <?php endforeach; ?>
        </ul>
      </div>
      <div class="lmfl_right">
        <div class="pro_title"><span><?php echo $colum['name'] ?>  Products</span> <a href="<?php echo $colum['link'] ?>">更多</a> </div>
        <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|asc;row|100");
            foreach ($lists as $value) :  ?>
            <?php if($value['columnid'] == 6 || $value['columnid'] == 15 || $value['columnid'] == 18) : ?>
                <div class="lmfl_cp">
                    <a href="<?php echo $value['link'] ?>"><img src="<?php echo $value['thumb'] ?>" height="150" width="225" alt="<?php echo $value['title'] ?>"></a>
                  <p><?php echo $value['title'] ?></p>
                </div>
            <?php endif ?>
            <?php endforeach; ?>
      </div>
    </div>
      
      
   <?php $colum = getColumn(1, 'product'); ?>
    <div class="anli">
      <div class="anli_title"><span><?php echo $colum['name'] ?>  Case</span> <a href="<?php echo $colum['link'] ?>">更多</a> </div>
      <div class="anli_content">
        <div class="ny2010">
          <div id="demo" class="gundong">
            <div id="demo1" style="width:1180px">
              <table cellspacing="0" cellpadding="0">
                <tbody>
                  <tr valign="top">
                    <td valign="top" nowrap=""><table>
                        <tbody>
                          <tr>
                       <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|asc;row|30");
                        foreach ($lists as $value) :  ?>
                              <td align="center"><a href="<?php echo $value['link'] ?>"><img src="<?php echo $value['thumb'] ?>" height="240" width="180"></a>
                              <p> <?php echo $value['title'] ?> </p></td>
                        <?php endforeach; ?>
                        </tbody>
                      </table></td>
                    <td width="0"><div id="demo2" style="width:1180px;">
                        <table cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr valign="top">
                              <td valign="top" nowrap=""><table>
                                  <tbody>
                                    <tr> </tr>
                                  </tbody>
                                </table></td>
                              <td width="0"><div id="demo2" style="width:1180px"> </div></td>
                            </tr>
                          </tbody>
                        </table>
                      </div></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <script type="text/javascript">
 document.getElementById("demo2").innerHTML = document.getElementById("demo1").innerHTML;
 MyMar=setInterval(Marquee,speed);
				</script> 
      </div>
    </div>
      
      <?php $colum = getColumn(1, 'news'); ?>

    <div class="hyxw">
      <div class="hyxw_title"><span><?php echo $colum['name'] ?>  News</span> <a href="<?php echo $colum['link'] ?>" target="_blank" rel="nofollow">更多</a> </div>
      <!--<div class="hyxwtop"> <img src="images/xwtop.gif" width="320" height="101"> </div>-->
      <div class="xw">
        <ul>
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|7");
            foreach ($lists as $value) :  ?>
            
            <li><span style="float:right"><?php echo date('Y-m-d', $value['intime']); ?></span>
                <a href="<?php echo $value['link'] ?>" target="_blank" class="aTitle"><?php echo $value['title'] ?> </a></li>
            <?php endforeach; ?>
        </ul>
      </div>
    </div>
      <?php $colum = getColumn(1, 'product'); ?>

     <div class="hyxw">
      <div class="hyxw_title"><span><?php echo $colum['name'] ?>  News</span> <a href="<?php echo $colum['link'] ?>" target="_blank" rel="nofollow">更多</a> </div>
      <!--<div class="hyxwtop"> <img src="images/xwtop.gif" width="320" height="101"> </div>-->
      <div class="xw">
        <ul>
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|7");
            foreach ($lists as $value) :  ?>
            
            <li><span style="float:right"><?php echo date('Y-m-d', $value['intime']); ?></span>
                <a href="<?php echo $value['link'] ?>" target="_blank" class="aTitle"><?php echo $value['title'] ?> </a></li>
            <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="gywm">
      <div class="gywm_title"><span>关于我们  About</span> <a href="/zh/about" target="_blank">更多</a> </div>
      <div class="gsjj">
         <!--  <img src="<?php echo $_uiurl?>images/gsjj.gif" width="269" height="202" align="left" style="margin-right:15px;"> -->
        <p> 公司简介: </p>
        <?php $aaa = getFragment(2);echo $aaa['content']; ?>
        <span><a href="/zh/about">详细介绍>></a></span> </div>
    </div>
  </div>
</div>
<?php include '_footer.php';?>
