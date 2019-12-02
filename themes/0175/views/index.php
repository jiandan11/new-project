<?php include 'header.php';?>

<div class="fwmain">
  <div id="edit_putHere_area1" class="fwmain_left edit_putHere" savetitle="area1">
    <div class="label clear" id="665" rel="665" titles="新闻中心">
      <div class="label_head">
        <div class="label_title">新闻中心</div>
        <div class="link_more"><a class="more" href="<?php echo $_baseurl ?>zh/news/" title="新闻中心">更多</a></div>
      </div>

        <!--  首页调用其他页数据的代码  -->
        <?php $colum = getColumn(1, 'news'); ?>
      <div class="label_content">
        <div class="item_list id665">
          <ul class="clearfix" id="articlelist665">
              <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
              foreach ($lists as $value) :  ?>
                  <li><a title="<?php echo $value['title'] ?>" href="<?php echo $value['link'] ?>">
                          <?php echo $value['title'] ?></a>
                      <span class="datetime"><?php echo date('Y-m-d', $value['intime']); ?></span>
                  </li>
              <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="label_foot"></div>
    </div>
  </div>
  <div id="edit_putHere_area2" class="fwmain_center edit_putHere" savetitle="area2">
    <div class="label clear" id="667" rel="667" titles="自定义内容">
      <div class="label_head">
        <div class="label_title">公司简介</div>
          <div class="link_more"><a class="more" href="<?php echo $_baseurl ?>zh/about/" title="公司简介">更多</a></div>
      </div>
        <?php $colum = getColumn(1, 'about',true); ?>
        <div class="label_content">
        <div class="about_con clearfix" style="height: 250px">
          <ul id="udContent667">

            <li><img src="<?php echo $_uiurl;?>img/20131026155318751875.jpg" alt="" align="left" height="87" width="113" />
                <?php echo $colum['content']['content'] ?>
            </li>
          </ul>
        </div>
      </div>
      <div class="label_foot"></div>
    </div>
  </div>

    <?php $colum = getColumn(1, 'product'); ?>  <!--参与咨询列表-->
  <div id="edit_putHere_area3" class="fwmain_right edit_putHere" savetitle="area3">
    <div class="label clear fwtop_nav6" id="668" rel="668" titles="竖形分类菜单">
      <div class="label_head">
        <div class="label_title">产品管理</div>
      </div>
      <div class="label_content">
          <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
          foreach ($colum['list'] as $value) : ?>
              <h1>
                  <a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" > <?php echo $value['name'] ?> </a>
              </h1>
          <?php endforeach; ?>
      </div>
      <div class="label_foot"></div>
    </div>
  </div>
  <div class="clear"></div>
  <div id="edit_putHere_area4" class="fwmain_total edit_putHere" savetitle="area4">
    <div class="label clear" id="666" rel="666" titles="产品列表">
      <div class="label_head">
        <div class="label_title">最新产品</div>
        <div class="link_more"><a href="<?php echo $_baseurl ?>zh/product/" class="more">更多</a></div>
      </div>
        <?php $colum = getColumn(1, 'product'); ?>  <!-- 更改定位到产品页  -->
        <div class="label_content">
        <div class="pic_list1 pic_list_roll" id="pic_list666">
          <ul class="clearfix" id="prolist666">
              <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
               foreach ($lists as $val): ?>
              <li>
                  <?php echo $val['thumb']; ?>
                  <a title="<?php echo $val['title'] ?>" href="<?php echo $val['link'] ?>">
                      <img src="<?php echo $val['thumb'] ?>" style='width: 150px; height: 130px;' alt="<?php echo $val['title'] ?>"/>
                      <p class="title"><?php echo $val['title'] ?></p></a>
              </li>
              <?php endforeach; ?>
            <div class="clear"><?php echo $_pagebreak; ?></div>
          </ul>
        </div>
      </div>
      <div class="label_foot"></div>
    </div>
  </div>
  <div class="clear"></div>
</div>

<?php include 'foot.php';?>