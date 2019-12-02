
<?php include '_head.php';?>

<?php $colum = getColumn(1, 'product'); ?>
<div class="sy_artcil">
  <div class="center">
    <div class="sy_pro">
      <div class="sy_l fl">
        <div id="subnavs">
          <h2><?php echo $colum['name']?></h2>
          <ul class="expmenu">
              <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
              foreach ($colum['list'] as $key=>$value) : ?>
              <li>
                  <div class="header"><span class="arrow down"></span>
                      <h3><a href='<?php echo $value['link']?>'><?php echo $value['name']?></a></h3>
                  </div>
                  <ul class="menu" style="display:'';" >
                      <?php foreach ($value['list'] as $val):?>
                          <li><a href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a></li>
                      <?php endforeach;?>
                  </ul>
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
            <h2> <span><a href="<?php echo $_baseurl; ?>zh/product/" target="_blank"><img src="images/about-more.jpg" title="更多"></a></span> <a href="" target="_blank"><?php echo $colum['name']?></a> </h2>
          </div>
          <ul class="pro-c">
              <!--$colum['list']取菜单  $lists取商品-->
              <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
              foreach ($lists as $key=>$value) : ?>
                  <li>
                      <a href="<?php echo $value['link'] ?>" target="_blank"><img src="<?php echo $value['thumb'] ?>" width="272" height="230"></a><span><?php echo $value['title'] ?></span>
                  </li>
              <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <!--案例展示-->
    <div class="main">
      <div class="tit">
        <h2>案例展示</h2>
        <span>The case shows</span> </div>
      <div class="partFourM"> <a class="left ctrl"></a> <a class="right ctrl"></a>
        <div class="partFourCon" id="ScrollBox">
          <ul class="pro">
              <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
              foreach ($lists as $key=>$value) : ?>
                  <li>
                      <a href="<?php echo $value['link'] ?>" target="_blank" class="proimg"><img src="<?php echo $value['thumb'] ?>" width="200" height="190"></a>
                      <div class="protxt"><?php echo $value['title'] ?></div>
                  </li>
              <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>

      <?php $colum = getColumn(1, 'kehujianzheng'); ?>
    <!--客户见证-->
    <div class="jz">
      <h2 class="til01">
          <span class="more01 fr"><a href="<?php echo $_baseurl; ?>zh/news/"><img src="<?php echo $_uiurl;?>images/about-more.jpg"></a></span>
          <a target="_blank" href="" style="background:url(<?php echo $_uiurl;?>images/ico03.gif) 10px no-repeat;padding-left:66px;"><?php echo $colum['name']?></a><em><?php echo $colum['ename']?></em></h2>
      <div class="jz_c">
          <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|4");
          foreach ($lists as $key=>$val) : ?>
          <dl class="<?php echo $key%2==1?'jzl1':'' ?>">
              <dt>
                  <a target="_blank" href="<?php echo $val['link'] ?>"><img src="<?php echo $val['thumb'] ?>" width="151" height="141"></a>
              </dt>
              <dd>
                  <h3><a target="_blank" href="<?php echo $val['link'] ?>"><?php echo $val['title'] ?></a></h3>
                  <p><?php echo $val['content'] ?></p>
<!--                  <span><a target="_blank" href=""><img src="images/ico_gd.gif"></a></span> </dd>-->
          </dl>
          <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php $colum = getColumn(1, 'news'); ?>
<!--关于我们-->
<div class="sy_ab">
  <div class="center">
    <h2><?php echo $colum['param']['zhtitle'] ?></h2>
    <span><?php echo $colum['content'] ?></span>
  </div>
</div>
<!--新闻-->
<div class="news_main_cont">
  <div class="center">
      <?php foreach ($colum['list'] as $key=>$value) : ?>
          <?php if($key>=2) break ?>
         <div class="<?php echo $key==0?'news_cont fl':'news_cont fr' ?>">
             <div class="case_title textl"> <a href="<?php echo $value['link'] ?>"><?php echo $value['name']?><span><?php echo $value['ename']?></span></a> </div>
             <ul class="index_news_list">
                 <?php $colum_zcd = getColumn(1, $value['sign']); ?>
                 <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum_zcd['clists']};sort|intime;sorttype|desc;row|6");
                 foreach ($lists as $val) : ?>
                 <li>
                     <a href="<?php echo $val['link']?>">
                         <span>
                             <b><?php echo substr(gmdate('Y-m-d', $val['intime']),8,2) ?></b>
                             <br><?php echo substr(gmdate('Y-m-d', $val['intime']),0,7) ?>
                         </span>
                         <div class="index_news_text">
                             <p class="n1"><?php echo $val['title'] ?></p>
                             <p style="overflow: hidden;text-overflow:ellipsis;white-space: nowrap;" ><?php echo $val['content']?></p>
                         </div>
                     </a>
                 </li>
                 <?php endforeach; ?>
             </ul>
         </div>
      <?php endforeach; ?>
  </div>
</div>
<!--友情链接-->
<div class="youlian">
  <div class="center"> <span>友情链接：</span> <a href="">360搜索</a><a href="">360搜索</a> </div>
</div>

<?php include '_foot.php';?>
