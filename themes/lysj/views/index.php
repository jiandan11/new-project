<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width,initial-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="yes" name=" apple-mobile-web-app-capable"/>
    <meta content="no" name="apple-touch-fullscreen"/>
    <meta content="black" name=" apple-mobile-web-app-status-bar-style"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta name="validation-tag" content="ssad/tetris_web/page/adapt_pc"/>
    <title>营销页面</title>
    <link rel="stylesheet" href="<?php echo $_uiurl;?>css/bmap.css">
    <link rel="stylesheet" href="<?php echo $_uiurl;?>css/swiper.min.css">
    <link rel="stylesheet" href="<?php echo $_uiurl;?>css/main.css">
</head>
<body>


<div class="y-wrap">
<section class="ffone">
    <div><img src="<?php echo $_uiurl;?>images/1.jpeg" alt=""></div>
    <div class="fone">
        <b>提交表单，免费获取加盟资料</b>
        <p>已经提交了947人</p>
       <div><?php echo getformhtml(2); ?></div>
    </div>
</section>

<section class="ffone">
    <div class="fone">
        <b>提交表单，免费获取加盟资料</b>
        <p>已经提交了947人</p>
        <div><?php echo getformhtml(2); ?></div>
    </div>
</section>


<section class="ftwo">
    <div><img src="<?php echo $_uiurl;?>images/title1.jpeg" alt=""></div>
    <div><img src="<?php echo $_uiurl;?>images/title11.jpeg" alt=""></div>
    <div class="swiper-container">
        <div class="swiper-wrapper totalb">
            <div class="swiper-slide"><img class="rig" src="<?php echo $_uiurl;?>images/banner1.jpeg" alt=""></div>
            <div class="swiper-slide"><img class="rig" src="<?php echo $_uiurl;?>images/banner2.jpeg" alt=""></div>
            <div class="swiper-slide"><img class="rig" src="<?php echo $_uiurl;?>images/banner3.jpeg" alt=""></div>
        </div>
        <!-- 如果需要分页器 -->
        <div class="swiper-pagination"></div>
    </div>
    <p>刷脸支付开始风靡线下</p>
    <video controls="controls"
           src="http://hbys92utfs0gqreczvm.exp.bcevod.com/mda-jisf4vm2m9wsmnf1/mda-jisf4vm2m9wsmnf1.mp4">
        <source src="<?php echo $_uiurl;?>images/video.mp4" type="video/mp4">
    </video>
</section>
<section class="fthree">
    <div><img src="<?php echo $_uiurl;?>images/title2.jpeg" alt=""></div>
    <div><img src="<?php echo $_uiurl;?>images/title22.jpeg" alt=""></div>
    <div><img src="<?php echo $_uiurl;?>images/title3.jpeg" alt=""></div>
    <div><img src="<?php echo $_uiurl;?>images/title33.jpeg" alt=""></div>
    <div><img src="<?php echo $_uiurl;?>images/title4.jpeg" alt=""></div>
    <div><img src="<?php echo $_uiurl;?>images/title44.jpeg" alt=""></div>
</section>
<section class="ffour">
    <div><img src="<?php echo $_uiurl;?>images/title5.jpeg" alt=""></div>
    <font>专心致力于【刷脸支付】解决方案</font>
    <video controls="controls"
           src="http://hbys92utfs0gqreczvm.exp.bcevod.com/mda-jisn0qiwycdu4gug/mda-jisn0qiwycdu4gug.mp4">
        <source src="<?php echo $_uiurl;?>images/video2.mp4" type="video/mp4">
    </video>
    <div><img src="<?php echo $_uiurl;?>images/title55.jpeg" alt=""></div>
</section>
<section class="ffive">
    <div id="map"><img src="<?php echo $_uiurl;?>images/map.png" alt=""></div>
    <div class="addr">
        <a href="#" class="clear">
            <img src="<?php echo $_uiurl;?>images/map-address.png" alt="">
            福州市高新区山亚国际中心
            <span class="right">></span>
        </a>
    </div>
    <div class="fone">
        <b>提交表单，免费获取加盟资料</b>
        <p>已经提交了947人</p>
          <div><?php echo getformhtml(2); ?></div>
    </div>
     
    <div class="care"><font>投资有风险，选择需谨慎</font></div>
    <div class="pos">
        <div class="care1">
            <img src="<?php echo $_uiurl;?>images/down.png" alt="">
            <span>授权商家发送与您填写信息相关的通知</span>
        </div>
        <div class="care1">
            <span>温馨提示：商家号仅向商家提供技术服务，您同意商家使用您填写的信息通过电话、邮箱等方式与您联系。</span>
        </div>
    </div>
</section>
<div class="mask" id="freeclick" onclick="check_display()"><span>免费获取加盟资料</span></div>
<div class="blackmask" style="display: none"></div>
<div class="popups" style="display: none">
    <div class="clear">
        <div class="left">
            <h3> 填写表单，获取加盟资料</h3>
            <span>目前已有950人参加活动</span>
        </div>
        <div class="right" id="freeoff" onclick="check_display2()"><img src="<?php echo $_uiurl;?>images/off.png" alt=""></div>
    </div>
</div>
<div class="y-qrcode">
        <div class="y-desc">请扫描上方的二维码预览</div>
    </div>
</div>
<script src="https://jianzhan-fe.cdn.bcebos.com/js/qrcode.js"></script>
<script>
    var link = window.location ? window.location.href : "https://isite.baidu.com";
    var ele = document.querySelector('.y-qrcode');
    var qrcode = new QRCode(ele, {
        width: 200,
        height: 200
    });
    qrcode.makeCode(link);
</script>
<script src="<?php echo $_uiurl;?>js/jquery-1.7.1.min.js"></script>
<script src="<?php echo $_uiurl;?>js/swiper.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?key=&v=1.1&services=true"></script>

<script>

    var swiper = new Swiper('.swiper-container', {
        direction: 'horizontal', // 垂直切换选项
        loop: true, // 循环模式选项
        autoplay: true,//自动播放

        pagination: {
            el: '.swiper-pagination',
            type: 'fraction',
            renderFraction: function (rig, totalb) {
                return '<span class="' + rig + '"></span>' +
                    '/' +
                    '<span class="' + totalb + '"></span>';
            },
        },

    })

    //弹窗开关
    function check_display() {
        var display = $('.blackmask').css('display');
        if (display == 'none') {
            $("#freeclick").css("display", "none");
            $('.blackmask').fadeIn();
            $('.popups').fadeIn();
        }
    }

    function check_display2() {
        var display = $('#freeclick').css('display');
        if (display == 'none') {
            $("#freeclick").fadeIn();
            $(".blackmask").fadeOut();
            $(".popups").fadeOut();
        }

    }

    //创建和初始化地图函数：
    function initMap() {
        createMap(); //创建地图
        setMapEvent(); //设置地图事件
        addMapControl(); //向地图添加控件
        addMapOverlay(); //向地图添加覆盖物
    }

    function createMap() {
        map = new BMap.Map("map");
        map.centerAndZoom(new BMap.Point(119.282232, 26.083263), 19);
    }

    function setMapEvent() {
        map.enableScrollWheelZoom();
        map.enableKeyboard();
        map.enableDragging();
        map.enableDoubleClickZoom()
    }

    function addClickHandler(target, window) {
        target.addEventListener("click", function () {
            target.openInfoWindow(window);
        });
    }

    function addMapOverlay() {
        var markers = [{
            content: "福州市高新区山亚国际中心",
            title: "福州凌云数据科技有限公司",
            imageOffset: {
                width: 0,
                height: 0
            },
            position: {
                lat: 26.083263,
                lng: 119.282232
            }
        }];
        for (var index = 0; index < markers.length; index++) {
            var point = new BMap.Point(markers[index].position.lng, markers[index].position.lat);
            var marker = new BMap.Marker(point, {
                icon: new BMap.Icon("<?php echo $_uiurl;?>images/mar.png", new BMap.Size(20, 25), {
                    imageOffset: new BMap.Size(markers[index].imageOffset.width, markers[index].imageOffset.height)
                })
            });
            var label = new BMap.Label(markers[index].title, {
                offset: new BMap.Size(25, 5)
            });
            var opts = {
                width: 200,
                title: markers[index].title,
                enableMessage: false
            };
            var infoWindow = new BMap.InfoWindow(markers[index].content, opts);
            marker.setLabel(label);
            addClickHandler(marker, infoWindow);
            map.addOverlay(marker);
        }
        ;
    }

    //向地图添加控件
    function addMapControl() {
        var scaleControl = new BMap.ScaleControl({
            anchor: BMAP_ANCHOR_BOTTOM_LEFT
        });
        scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
        map.addControl(scaleControl);
        var navControl = new BMap.NavigationControl({
            anchor: BMAP_ANCHOR_TOP_LEFT,
            type: BMAP_NAVIGATION_CONTROL_LARGE
        });
        map.addControl(navControl);
        var overviewControl = new BMap.OverviewMapControl({
            anchor: BMAP_ANCHOR_BOTTOM_RIGHT,
            isOpen: true
        });
        map.addControl(overviewControl);
    }

    var map;
    initMap();
</script>

</body>
</html>