<?php include '_head.php'?>

<div class="fwmain" style="position:relative;height:600px;min-height:10px;position:relative;" rel="20">
  <div class="label advertising" id="274" rel="274" titles="文字"  usestate="1" style='width:641px;height:150px;z-index:100;left:282.5px;top:2px;position:absolute;margin-left:0px;'>
    <div class="label_content advContent text274">
      <p style="text-align:center;">
          <span style="line-height:2;font-size:18px;font-family:'Microsoft YaHei';" id="name"><?php echo $_site['title']; ?></span>
      </p>
      <p> <br /></p>
        <!--  碎片  -->
        <div style="text-align:center;font-size: 15px">
            <!--  电话  -->
            <span id="tel"><?php $aaa = getFragment(4);echo $aaa['content']; ?></span>
            <!--  地址  -->
            <span id="address"><?php $aaa = getFragment(3);echo $aaa['content']; ?></span>
        </div>
        <?php $colum = getColumn(1, 'gongsijianjie',true); ?>
        <span style="display: none" id="introduction"><?php echo $colum['content'];?></span>
        <!--  logo -->
        <span style="display: none" id="logo"><?php echo DBG_FILEURL .$_site['logo'];?></span>
    </div>
  </div>
  <div class="label clear dzdt275" id="275" rel="275" titles="电子地图"  usestate="1" style='width:1200px;height:446px;z-index:100;left:0px;top:154px;position:absolute;margin-left:0px;'>
    <div style="width:1200px;height:400px;overflow: hidden;" id="mapContainer275"></div>
    <div class="label_foot"></div>
  </div>
  <link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
  <script src="http://api.map.baidu.com/api?v=2.0 &ak=CEe15b3a997aef8acb9805e559fb23c0" type="text/javascript"></script> 
  <script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script> 
  <script type="text/javascript">
      var company_name = document.getElementById("name").innerText, //公司名称
          telphone = document.getElementById("tel").innerText,  //公司电话
          introduction = document.getElementById("introduction").innerText,
          logo_url = document.getElementById("logo").innerText;

        var map275 = new BMap.Map("mapContainer275");
        var poi275 = new BMap.Point(119.308671,26.061366);
        map275.centerAndZoom(poi275, 15);
        map275.enableScrollWheelZoom();  //启用滚轮放大缩小
        var content275 = '<div style="margin:0;line-height:20px;padding:2px;">' + '<img style="float:right;zoom:1;overflow:hidden;width:70px;height:70px;margin-left:3px;" src=' + logo_url + '>' + '地址：公司地址<br/>电话：'+ telphone + '<br/>简介：'+ introduction + '</div>';
        var marker275 = new BMap.Marker(poi275); //创建marker对象
        marker275.disableDragging();  //禁止拖拽
        map275.addOverlay(marker275); //在地图中添加marker
        marker275.setAnimation(BMAP_ANIMATION_BOUNCE);  //跳动的标注
        map275.addControl(new BMap.ScaleControl());  // 添加比例尺控件
        map275.addControl(new BMap.MapTypeControl());  //添加地图类型控件(2D，卫星，三维)
        map275.addControl(new BMap.NavigationControl());   //左上角，添加默认缩放平移控件
        var searchInfoWindow275 = null;  //创建检索信息窗口对象
        searchInfoWindow275 = new BMapLib.SearchInfoWindow(map275, content275, {
            title  : company_name, //公司名称
            width  : 200,
            height : 100,
            panel  : "panel",
            enableAutoPan : true,
            searchTypes   :[
                BMAPLIB_TAB_SEARCH,
                BMAPLIB_TAB_TO_HERE,
                BMAPLIB_TAB_FROM_HERE
            ]
        });
        searchInfoWindow275.open(marker275);
    </script>
    <script type="text/javascript">
        $(function(){tlancv('275','0')});
        $(function(){tlancv('274','282.5')});
    </script>
</div>


<?php include '_foot.php'?>