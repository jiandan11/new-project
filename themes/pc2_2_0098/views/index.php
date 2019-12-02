<?php include '_head.php'?>

<style type="text/css">
    .productList54{
        background-position:center center;
        background-repeat:no-repeat;
        padding-top:0px;
        padding-right:0px;
        padding-bottom:0px;
        padding-left:0px;
    }
</style>

<div class="fwmain" style="position:relative;height:2452px;min-height:30px;" rel="7">
    <?php $colum = getColumn(1, 'product'); ?>
  <div class="edit_putHere  tLan" rel="52" id="52" saveTitle="area52" style="height:96px;z-index:auto;position:relative;background: url(<?php echo $_uiurl;?>images/module-section-title-line.png) no-repeat bottom left; ">
    <div class="label advertising" id="53" rel="53" titles="文字"  usestate="1" style='width:243px;height:88px;z-index:100;left:6px;top:6px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text53">
        <h2 style="margin:0px 0px 15px;padding:0px;font-size:30px;font-weight:normal;line-height:normal;color:#4D4D4D;font-family:'Microsoft YaHei', 微软雅黑, Arial, sans-serif;white-space:normal;"> <?php echo $colum['name'] ?> </h2>
        <h3 style="margin:0px 0px 15px;padding:0px;font-size:16px;font-weight:normal;line-height:normal;color:#999999;font-family:Arial, Helvetica, sans-serif;white-space:normal;"> THE LATEST PRODUCTS </h3>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('53','6')});</script>
    <div class="label advertising" id="55" rel="55" titles="文字"  usestate="1" style='width:87px;height:33px;z-index:100;left:1099.5px;top:59px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text55"><a href="<?php echo $_baseurl;?>zh/product/" ><span style="color:#666666;font-size:16px;font-family:'Microsoft YaHei';">更多&gt;&gt;</span></a></div>
    </div>
    <script type="text/javascript">$(function(){tlancv('55','1099.5')});</script> 
  </div>
  <div class="label clear" id="54" rel="54" titles="产品列表"  usestate="1" style='width:1200px;z-index:100;position:relative;margin:0 auto 40px;'>
    <div id="productList54" class="label_content productList54">
      <div class="pic_list1 pic_list_roll" id="pic_list54">
        <ul class="prolist54" id="prolist54">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|8");
            foreach ($lists as $key=>$value) : ?>
          <li>
              <a style="" title="产品中心" href="<?php echo $value['link'] ?>"><img style="width:278px;height:278px;margin-top:10px;margin-right:4px;margin-left:4px;" src="<?php echo $value['thumb'] ?>" alt="" title="" onMouseOver="" onMouseOut=""/>
            <p class="title" style=""><?php echo $value['title'] ?></p>
            </a>
          </li>
            <?php endforeach; ?>
          <div class="clear"></div>
        </ul>
      </div>
    </div>
    <div class="label_foot"></div>
  </div>

  <script type="text/javascript">$(function(){tlancv('54','0')});</script>

    <?php $colum = getColumn(1, 'gongsijianjie'); ?>
  <div class="edit_putHere  tLan" rel="56" id="56" saveTitle="area56" style="height:96px;z-index:120;position:relative;background: url(<?php echo $_uiurl;?>images/module-section-title-line.png) no-repeat bottom left;padding-bottom: 10px">
    <div class="label advertising" id="57" rel="57" titles="文字"  usestate="1" style='width:243px;height:88px;z-index:100;left:6px;top:20px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text57">
        <h2 style="margin:0px 0px 15px;padding:0px;font-size:30px;font-weight:normal;line-height:normal;color:#4D4D4D;font-family:'Microsoft YaHei', 微软雅黑, Arial, sans-serif;white-space:normal;"> <?php echo $colum['name'] ?> </h2>
        <h3 style="margin:0px 0px 15px;padding:0px;font-size:16px;font-weight:normal;line-height:normal;color:#999999;font-family:Arial, Helvetica, sans-serif;white-space:normal;"> COMPANY INTRODUCTION </h3>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('57','6')});</script>
  </div>
  <div class="edit_putHere  tLan" rel="59" id="59" saveTitle="area59" style="height:520px;z-index:auto;position:relative;top: -96px;background-color:rgb(247, 247, 247);">
    <div class="label advertising " id="60" rel="60" titles="图片"  usestate="1" style='width:553px;height:300px;z-index:100;left:8.5px;top:138px;position:absolute;margin-left:0px;'>
      <div class="advContent picture60"><img width="100%" height="100%" src="<?php echo  '/file' .$colum['icon'] ?>" alt=""/></div>
    </div>
    <script type="text/javascript">$(function(){tlancv('60','8.5')});</script>
    <div class="label advertising" id="61" rel="61" titles="文字"  usestate="1" style='width:600px;height:252px;z-index:100;left:574.5px;top:134px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text61">
        <p style="margin-top:0px;margin-bottom:15px;padding:0px;line-height:25.2000007629395px;color:#4D4D4D;font-family:'Microsoft YaHei', 微软雅黑, Arial, sans-serif;font-size:14px;white-space:normal;background-color:#F7F7F7;"> <span style="font-size:22px;"><?php echo $colum['name'] ?></span> </p>
        <p style="margin-top:0px;margin-bottom:15px;padding:0px;line-height:25.2000007629395px;color:#4D4D4D;font-family:'Microsoft YaHei', 微软雅黑, Arial, sans-serif;font-size:14px;white-space:normal;"><?php echo $colum['param']['zhdescription']  ?> </p>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('61','574.5')});</script>
    <div class="label advertising" id="63" rel="63" titles="文字"  usestate="1" style='width:164px;height:37px;z-index:100;left:568.5px;top:398px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text63"><a href="<?php echo $_baseurl;?>zh/about/" ><span style="font-size:14px;font-family:'Microsoft YaHei';">【查看详情】</span></a></div>
    </div>
    <script type="text/javascript">$(function(){tlancv('63','568.5')});</script> 
  </div>

    <?php $colum = getColumn(1, 'keshizhanshi'); ?>
  <div class="edit_putHere  tLan" rel="67" id="67" saveTitle="area67" style="height:96px;z-index:auto;position:relative;top: -76px;background: url(<?php echo $_uiurl;?>images/module-section-title-line.png) no-repeat bottom left; ">
    <div class="label advertising" id="68" rel="68" titles="文字"  usestate="1" style='width:243px;height:88px;z-index:100;left:6px;top:6px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text68">
        <h2 style="margin:0px 0px 15px;padding:0px;font-size:30px;font-weight:normal;line-height:normal;color:#4D4D4D;font-family:'Microsoft YaHei', 微软雅黑, Arial, sans-serif;white-space:normal;"> <?php echo $colum['name'] ?> </h2>
        <h3 style="margin:0px 0px 15px;padding:0px;font-size:16px;font-weight:normal;line-height:normal;color:#999999;font-family:Arial, Helvetica, sans-serif;white-space:normal;"> THE LATEST PROJECTS </h3>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('68','6')});</script>
    <div class="label advertising" id="69" rel="69" titles="文字"  usestate="1" style='width:87px;height:33px;z-index:100;left:1099.5px;top:59px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text69"><a href="<?php echo $_baseurl;?>zh/keshizhanshi/"><span style="color:#666666;font-size:16px;font-family:'Microsoft YaHei';">更多&gt;&gt;</span></a></div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('69','1099.5')});
    </script>
  </div>
  <div class="label clear" id="70" rel="70" titles="产品列表"  usestate="1" style='width:1230px;z-index:101;position:relative;top: -76px;margin:0 auto;'>
    <div id="productList70" class="label_content productList70">
      <div class="pic_list1 pic_list_roll" id="pic_list70">
        <ul class="prolist70" id="prolist70">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|8");
            foreach ($lists as $key=>$value) : ?>
              <li>
                  <a  style="font-size:14px;"  title="工程案例" href="<?php echo $value['link'] ?>">
                      <img style="width:270px;height:270px;margin-top:10px;margin-right:4px;margin-left:4px;" src="<?php echo $value['thumb'] ?>" alt="" title="" onMouseOver="" onMouseOut=""/>
                      <p class="title" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap; width: 270px; font-size:14px;" ><?php echo $value['title'] ?></p>
                  </a>
              </li>
            <?php endforeach; ?>
          <div class="clear"></div>
        </ul>
      </div>
    </div>
    <div class="label_foot"></div>
  </div>

    <?php $colum = getColumn(1, 'news'); ?>
  <script type="text/javascript">$(function(){tlancv('70','0')});</script>
  <div class="edit_putHere  tLan" rel="71" id="71" saveTitle="area71" style="height:96px;z-index:auto;position:relative; top: -56px;background: url(<?php echo $_uiurl;?>images/module-section-title-line.png) no-repeat bottom left; ">
    <div class="label advertising" id="72" rel="72" titles="文字"  usestate="1" style='width:243px;height:88px;z-index:100;left:6px;top:6px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text72">
        <h2 style="margin:0px 0px 15px;padding:0px;font-size:30px;font-weight:normal;line-height:normal;color:#4D4D4D;font-family:'Microsoft YaHei', 微软雅黑, Arial, sans-serif;white-space:normal;"> 最新资讯 </h2>
        <h3 style="margin:0px 0px 15px;padding:0px;font-size:16px;font-weight:normal;line-height:normal;color:#999999;font-family:Arial, Helvetica, sans-serif;white-space:normal;"> THE LATEST NEWS </h3>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('72','6')});</script>
    <div class="label advertising" id="73" rel="73" titles="文字"  usestate="1" style='width:87px;height:33px;z-index:100;left:1099.5px;top:-10px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text73"><a href="<?php echo $_baseurl;?>zh/news/"><span style="color:#666666;font-size:16px;font-family:'Microsoft YaHei';">更多&gt;&gt;</span></a></div>
    </div>
    <script type="text/javascript">$(function(){tlancv('73','1099.5')});</script> 
  </div>
  <div class="label clear" id="74" rel="74" titles="文章列表"  usestate="1" style='width:1200px;z-index:100;position:relative; top: -56px;margin:0 auto;'>
    <div id="allabelcontent1" class="label_content articleList74">
      <div class="item_list id74">
          <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|8");
          foreach ($lists as $key=>$value) : ?>
        <ul class="clearfix" id="articlelist74">
          <li>
              <a title="<?php echo $value['title'] ?>" href="<?php echo $value['link'] ?>"><?php echo $value['title'] ?></a>
              <span class="datetime" id="datetime74"><?php echo date('Y-m-d',$value['intime']) ?></span>
          </li>
        </ul>
          <?php endforeach; ?>
      </div>
    </div>
    <style type="text/css">
        background-position:center center;
        background-repeat:no-repeat;
        padding-top:0px;
        padding-right:0px;
        padding-bottom:0px;
        padding-left:0px;
        .articleList74{}
        #articlelist74 li a{font-size:14px;}
        #articlelist74 li{float:left;width:100%;}
        #datetime74{margin-right:5px;}
        #thum74{width:100px;height:100px;}
        #summary74{}
        #more74{;position:absolute;right:0;bottom:0;}
        #content_box74{}
        #moreNew74{;}
    </style>
    <div class="label_foot"></div>
  </div>
  <script type="text/javascript">$(function(){tlancv('74','0')});</script> 
</div>


<?php include '_foot.php'?>
