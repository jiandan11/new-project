<!--页脚-->
<footer class="foot">
    <img class="pimg" src="<?php echo $_uiurl;?>images/bottombanner.gif" alt="">
    <img class="mimg" src="<?php echo $_uiurl;?>images/mbottombanner.gif" alt="">
</footer>

<script src="<?php echo $_uiurl;?>js/swiper.min.js"></script>
<script src="<?php echo $_uiurl;?>js/swiper.animate.min.js"></script>
<script src="<?php echo $_uiurl;?>js/jquery-1.7.1.min.js"></script>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        direction: 'horizontal', // 垂直切换选项
        loop: true, // 循环模式选项

        // 如果需要分页器
        pagination: {
            el: '.swiper-pagination',
        },

        // 如果需要前进后退按钮
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    });
    function check_display() {
    var display = $('.mmeun').css('display');
    if (display == 'none') {
        $('.mmeun').fadeIn();
    } else {
        $('.mmeun').fadeOut();
    }
}
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?9f615b02440020b96c7101844517f174";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>