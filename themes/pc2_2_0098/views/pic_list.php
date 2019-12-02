<?php include '_head.php'?>

<style type="text/css">
    .verticalNav101{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}
    .verticalNav101 h1,.verticalNav101 h2,.verticalNav101 li{font-weight:normal;}
    .verticalNav101 h1{width:260px;height:54px;background-color:#f2f2f2;border-bottom:1px solid #e5e5e5;}
    .verticalNav101 h2{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
    .verticalNav101 li{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
    .verticalNav101 h1 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
    .verticalNav101 h2 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
    .verticalNav101 li a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
    .verticalNav101 .selectCheck a,.verticalNav101 h1 a:hover,.verticalNav101 h2 a:hover,.verticalNav101 li a:hover{font-weight:normal;color:#efbc0c;text-align:left;}
    .verticalNav101 .selectCheck,.verticalNav101 h1:hover,.verticalNav101 h2:hover,.verticalNav101 li:hover{}

    .productList103 {
        background-position: center center;
        background-repeat: no-repeat;
        padding-top: 0px;
        padding-right: 0px;
        padding-bottom: 0px;
        padding-left: 0px;
    }

    .zcd{
        padding-left: 30px;
    }

</style>

<?php $colum = getColumn(1, 'product'); ?>

<div class="fwmain" style="position:relative;height:695px;min-height:10px;position:relative;" rel="14">
  <div class="edit_putHere  block_area" rel="99" id="99" saveTitle="area99" style="width:260px;height:567px;z-index:100;left:0px;top:0px;position:absolute; ">
    <div class="label advertising" id="100" rel="100" titles="文字"  usestate="1" style='width:260px;height:57px;z-index:100;left:0px;top:15px;position:absolute;background-color:#efbc0c;margin-left:0px;'>
      <div class="label_content advContent text100">
        <blockquote style="margin:0 0 0 10px;border:none;padding:0px;"> <span style="font-size:18px;font-family:'Microsoft YaHei';color:#000000;line-height:2;"><?php echo $colum['name'] ?></span> </blockquote>
      </div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('100','0')});
    </script>
    <div class="label clear sxdh101" id="101" rel="101" titles="竖形导航"   usestate="1" style='width:260px;height:275px;z-index:100;left:0px;top:72px;position:absolute;margin-left:0px;'>
    <script>
        $('#101').css('height','auto');
    </script>
      <div class="label_content verticalNav101">
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

    <script type="text/javascript">$(function(){tlancv('101','0')});</script> 
  </div>
  <div class="label clear" id="103" rel="103" titles="产品列表"  usestate="1" style='width:937px;left:263px;top:70px;position:absolute;margin-left:0px;'>
    <div id="productList103" class="label_content productList103">
      <div class="pic_list1 pic_list_roll" id="pic_list103">
        <ul class="prolist103" id="prolist103" >
            <?php foreach ($_list as $val): ?>
              <li>
                  <a  style=""  title="<?php echo $val['title'] ?>" href="<?php echo $val['link'] ?>">
                      <img style="width:213px;height:213px;margin-top:10px;margin-right:4px;margin-left:4px;" src="<?php echo $val['thumb'] ?>" alt="" title="<?php echo $val['title'] ?>" />
                      <p class="title" style="" onMouseOver="" onMouseOut=""><?php echo $val['title'] ?></p>
                 </a>
              </li>
            <?php endforeach; ?>
        </ul>
        <div id="pager103" class="clear holder pager103" style="text-align:center"></div>
      </div>

        <!--分页-->
        <div>
            <?php echo $_pagebreak; ?>
        </div>

    </div>
    <div class="label_foot"></div>
  </div>

  <script type="text/javascript">
      $(function(){tlancv('103','263')});
  </script>
  <div class="edit_putHere  block_area" rel="105" id="105" saveTitle="area105" style="width:932px;height:71px;z-index:100;left:268px;top:0px;position:absolute;border-bottom:1px solid #efbc0c; ">
    <div class="label breadcrumbNavigation" id="104" rel="104" titles="面包屑导航"  usestate="1" style='width:918px;height:26px;z-index:100;left:9px;top:41px;position:absolute;margin-left:0px;'>
      <div class="location_nav location_nav104" style="float:right;">
          <?php echo $_navigation?>
      </div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('104','9')});
    </script>
  </div>
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