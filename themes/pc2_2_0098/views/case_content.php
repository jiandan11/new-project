<?php include '_head.php'?>

<?php $colum = getColumn(1, 'case'); ?>
<div class="fwmain" style="position:relative;height:568px;min-height:10px;position:relative;" rel="15">
  <div class="edit_putHere  block_area" rel="107" id="107" saveTitle="area107" style="width:260px;height:567px;z-index:100;left:0px;top:0px;position:absolute; ">
    <div class="label advertising" id="108" rel="108" titles="文字"  usestate="1" style='width:260px;height:57px;z-index:100;left:0px;top:15px;position:absolute;background-color:#efbc0c;margin-left:0px;'>
      <div class="label_content advContent text108">
        <blockquote style="margin:0 0 0 10px;border:none;padding:0px;">
            <span style="font-size:18px;font-family:'Microsoft YaHei';color:#000000;line-height:2;"><?php echo $colum['name'] ?></span>
        </blockquote>
      </div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('108','0')});
        $('#109').css('height','auto');
        $(function(){tlancv('109','0')});
        $(function(){tlancv('141','9')});
        layer.ready(function(){layer.photos({photos: '.picBox'});});
    </script>
    <div class="label clear sxdh109" id="109" rel="109" titles="竖形导航"   usestate="1" style='width:260px;height:275px;z-index:100;left:0px;top:72px;position:absolute;margin-left:0px;'>
      <div class="label_content verticalNav109">
          <?php foreach ($colum['list'] as $value) : ?>
              <div onmouseout="yczcd(this)" onmouseover="xszcd(this)" >
                  <h1 class="sxdh1">
                      <a style="font-size:14px;font-family:SimSun;" href="<?php echo $value['link'] ?>"><?php echo $value['name'] ?></a>
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
        .verticalNav109{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}
        .verticalNav109 h1,.verticalNav109 h2,.verticalNav109 li{font-weight:normal;}
        .verticalNav109 h1{width:260px;height:54px;background-color:#f2f2f2;border-bottom:1px solid #e5e5e5;}
        .verticalNav109 h2{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
        .verticalNav109 li{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
        .verticalNav109 h1 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav109 h2 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav109 li a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav109 .selectCheck a,.verticalNav109 h1 a:hover,.verticalNav109 h2 a:hover,.verticalNav109 li a:hover{font-weight:normal;color:#efbc0c;text-align:left;}
        .verticalNav109 .selectCheck,.verticalNav109 h1:hover,.verticalNav109 h2:hover,.verticalNav109 li:hover{}

        .zcd{
            padding-left: 30px;
        }
    </style>
  </div>
  <div class="edit_putHere  block_area" rel="140" id="140" saveTitle="area140" style="width:932px;height:71px;z-index:100;left:268px;top:0px;position:absolute;border-bottom:1px solid #efbc0c; ">
    <div class="label breadcrumbNavigation" id="141" rel="141" titles="面包屑导航"  usestate="1" style='width:918px;height:26px;z-index:100;left:9px;top:41px;position:absolute;margin-left:0px;'>
      <div class="location_nav location_nav141" style="float:right;">
          <?php echo $_navigation?>
      </div>
    </div>
  </div>
  <div class="label labelContent product_detail calcFwmainHeight" id="167" rel="167" titles="产品内容"  usestate="1" style='width:934px;height:491px;z-index:100;left:266px;top:77px;position:absolute;margin-left:0px;'>
    <div class="product_intro" id ="product_intro167">
      <div class="product_preview2">
        <div class="product_preview_sub2"><img src="<?php echo $_content['thumb']; ?>"  style=' width:300px;' alt="" title=""/></div>
        <div class="clear"></div>
      </div>
      <div class="product_info2">
        <div class="product_name2"><?php echo $_content['title']; ?></div>
        <div class="product_summary">
          <ul>
            <li><span>点击数:</span><span><?php echo $_content['hits']; ?></span></li>
            <li><span>案例描述:</span><span><?php echo $_site['description'] ?></span></li>
          </ul>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="product_detailmore">
      <div class="product_detailmore_title tab-hd">
        <ul class="tab-nav">
          <li><span>案例详情</span></li>
        </ul>
      </div>
      <div class="clear"></div>
      <div class="tab-bd">
        <div class="tab-pal">
          <div class="product_detailmore_content">
              <?php echo $_content['content'] ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
$("#proContent li").css({"overflow":"auto"});
$(".jqzoom").imagezoom();
jQuery(".product_detailmore").slide({ titCell:".tab-hd li", mainCell:".tab-bd",delayTime:0 });$(".tab-hd li").mouseover(function(){calcFwmainHeight("fwmain")})
$(function(){$('div.pager167dis9').jPages({containerID  : 'discuss167dis9',first: '首页',last: '尾页',previous: '上页',next: '下页',perPage:10,startPage: 1,startRange: 2,midRange: 5,endRange: 2,scrollBrowse : false,keyBrowse: false,callback : undefined});});
</script> 
  <script type="text/javascript">$(function(){tlancv('167','266')});</script> 
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

<?php include '_foot.php'?>