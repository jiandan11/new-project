<?php include '_head.php' ?>

<?php $colum = getColumn(1, 'news'); ?>

<div class="fwmain" style="position:relative;height:531px;min-height:10px;position:relative;" rel="18">
  <div class="edit_putHere  block_area" rel="234" id="234" saveTitle="area234" style="width:260px;height:400px;z-index:101;left:0px;top:0px;position:absolute; ">
    <div class="label advertising" id="235" rel="235" titles="文字"  usestate="1" style='width:260px;height:57px;z-index:100;left:0px;top:15px;position:absolute;background-color:#efbc0c;margin-left:0px;'>
      <div class="label_content advContent text235">
        <blockquote style="margin:0 0 0 10px;border:none;padding:0px;"> <span style="font-size:18px;font-family:'Microsoft YaHei';color:#000000;line-height:2;"><?php echo $colum['name'] ?></span> </blockquote>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('235','0')});</script>
    <div class="label clear sxdh236" id="236" rel="236" titles="竖形导航"   usestate="1" style='width:260px;height:110px;z-index:100;left:0px;top:72px;position:absolute;margin-left:0px;'>
    <script>
        $('#236').css('height','auto');
    </script>
      <div class="label_content verticalNav236">
          <?php foreach ($colum['list'] as $value) : ?>
              <div onmouseout="yczcd(this)" onmouseover="xszcd(this)" >
                  <h1 class="sxdh1">
                      <a style="<?php echo $value['sign']==$_column?'color:#efbc0c;font-size:14px;font-family:SimSun;':'font-size:14px;font-family:SimSun;';?>"  href="<?php echo $value['link'] ?>"><?php echo $value['name'] ?></a>
                  </h1>
                  <?php if(!empty($value['list'])):?>
                      <!-- 二级栏目 -->
                      <div style="display: none">
                          <?php foreach ($value['list'] as $val):?>
                              <h1 class="sxdh1 zcd">
                                  <a style="font-size:14px;font-family:SimSun;" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
                              </h1>
                          <?php endforeach;?>
                      </div>
                  <?php endif;?>
              </div>
          <?php endforeach; ?>
      </div>
      <div class="label_foot"></div>
    </div>
    <style type="text/css">
        .verticalNav236{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}
        .verticalNav236 h1,.verticalNav236 h2,.verticalNav236 li{font-weight:normal;}
        .verticalNav236 h1{width:260px;height:54px;background-color:#f2f2f2;border-bottom:1px solid #e5e5e5;}
        .verticalNav236 h2{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
        .verticalNav236 li{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
        .verticalNav236 h1 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav236 h2 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav236 li a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav236 .selectCheck a,.verticalNav236 h1 a:hover,.verticalNav236 h2 a:hover,.verticalNav236 li a:hover{font-weight:normal;color:#efbc0c;text-align:left;}
        .verticalNav236 .selectCheck,.verticalNav236 h1:hover,.verticalNav236 h2:hover,.verticalNav236 li:hover{}
    </style>
    <script type="text/javascript">
        $(function(){tlancv('236','0')});
    </script>
  </div>
  <div class="edit_putHere  block_area" rel="237" id="237" saveTitle="area237" style="width:932px;height:71px;z-index:101;left:268px;top:0px;position:absolute;border-bottom:1px solid #efbc0c; ">
    <div class="label breadcrumbNavigation" id="238" rel="238" titles="面包屑导航"  usestate="1" style='width:918px;height:26px;z-index:100;left:9px;top:41px;position:absolute;margin-left:0px;'>
      <div class="location_nav location_nav238" style="float:right;">
          <?php echo $_navigation?>
      </div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('238','9')});
    </script>
  </div>
  <div class="label clear" id="239" rel="239" titles="文章列表"  usestate="1" style='width:934px;height:461px;z-index:101;left:266px;top:70px;position:absolute;margin-left:0px;'>
      <?php $colum = getColumn(1, $_channel['sign']); ?>
    <div id="allabelcontent1" class="label_content articleList239">
      <div class="item_list id239">
        <ul class="clearfix" id="articlelist239">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|1000");
            foreach ($lists as $key=>$value) : ?>
          <li>
              <a title="<?php echo $value['title']?>" href="<?php echo $value['link']?>"><?php echo $value['title']?></a>
              <span class="datetime" id="datetime239"><?php echo date('Y-m-d',$value['intime'])?></span>
          </li>
            <?php endforeach; ?>
          <div id="pager239" class="clear holder pager239" style="text-align:center"></div>
        <!--分页-->
        <div>
            <?php echo $_pagebreak; ?>
        </div>
        </ul>
      </div>
    </div>
    <style type="text/css">
        .articleList239{}
        #articlelist239 li a{font-size:14px;}
        #articlelist239 li{float:left;width:100%;}
        #datetime239{margin-right:5px;}
        #thum239{width:100px;height:100px;}
        #summary239{}
        #more239{;position:absolute;right:0;bottom:0;}
        #content_box239{}
        #moreNew239{;}
    </style>
    <div class="label_foot"></div>
  </div>
  <script type="text/javascript">
      $(function(){tlancv('239','266')});
  </script>
</div>

<script type="text/javascript">
    function xszcd(obj) {
        if(obj.children.length>1){
            obj.children[1].style.cssText = 'display:inline-block;';
        }
    }

    function yczcd(obj) {
        if(obj.children.length>1){
            obj.children[1].style.cssText = 'display:none;';
        }
    }
</script>

<?php include '_foot.php' ?>
