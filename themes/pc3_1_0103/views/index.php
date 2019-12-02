
<?php include '_head.php';?>

    <div id="banner" class="carousel slide" data-ride="carousel"  >
        <ol class="carousel-indicators">
            <?php $banner = getLists(1, "model|1;state|20;row|6;");
            foreach ($banner as $key=>$val): ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key; ?>" class="<?php echo $key==0?'active':'' ?>"></li>
            <?php endforeach; ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php $banner = getLists(1, "model|1;state|20;row|6;");?>
            <?php foreach ($banner as $key=>$val): ?>
                <div class="<?php echo $key==0?'item active':'item' ?>">
                    <img src="<?php echo $val['slide']; ?>"  title="<?php echo $val['title']; ?>"  />
                </div>
            <?php endforeach; ?>
        </div>
	</div>
    <!--移動端樣式-->
	<div id="carousel-example-generic" class="carousel slide hidden-lg" data-ride="carousel">
		  <ol class="carousel-indicators">
              <?php $banner = getLists(1, "model|1;state|20;row|6;");
              foreach ($banner as $key=>$val): ?>
                  <li data-target="#carousel-example-generic" data-slide-to="<?php echo $key; ?>" class="<?php echo $key==0?'active':'' ?>"></li>
              <?php endforeach; ?>
		  </ol>
		  <div class="carousel-inner" role="listbox">
              <?php $banner = getLists(1, "model|1;state|20;row|6;");?>
              <?php foreach ($banner as $key=>$val): ?>
                  <div class="<?php echo $key==0?'item active':'item' ?>">
                      <img src="<?php echo $val['slide']; ?>"  title="<?php echo $val['title']; ?>"  />
                  </div>
              <?php endforeach; ?>
		  </div>
    </div>

    <?php $colum = getColumn(1, 'about'); ?>
	<div class="main">
		<h2 class="w-title"><?php echo $colum['name']?></h2>
		<p class="w-text"><?php echo $colum['param']['zhdescription']?></p>
		<div class="container">
			<div class="row">
                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|3");
                foreach ($colum['list'] as $key=>$value) : ?>
				<div class="col-lg-4 clo-xs-12">
					<div class="he_3DFlipY">
		                <div class="he_3DFlipY_inner">
		                    <div class="he_3DFlipY_img">
		                        <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/file' . $value['icon'] ?>" alt="">
		                    </div>
                            <?php $colum_zcd = getColumn(1, $value['sign']); ?>
		                    <div class="he_3DFlipY_caption">
		                        <h3><?php echo $colum_zcd['name'] ?></h3>
		                        <p><?php echo $colum_zcd['param']['zhdescription'] ?></p>
		                    </div>
		                 </div>
		            </div>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
		<div class="container mt">
			<div class="row company">
	    		<div class="col-lg-7 col-xs-12 text">
	    			<p><?php echo $colum['content']?></p>
	    		</div>
                <!--   要改   -->
	    		<div class="col-lg-5 clo-xs-12"><img src="<?php echo $_uiurl;?>images/yw.jpg"/></div>
	    	</div>
    	</div>
	</div>

    <?php $colum = getColumn(1, 'gongsiyoushi',true); ?>
	<div class="main1 mt">
		<h2 class="w-title"><?php echo $colum['name']?></h2>
		<p class="w-text"><?php echo $colum['param']['zhdescription']?></p>
		<div class="container">
			<div class="row">
                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|3");
                foreach ($lists as $key=>$value) : ?>
				<div class="col-lg-4 col-xs-12 fabzhuan">
					<img src="<?php echo $value['thumb'] ?>" />
					<h2 class="tit"><?php echo $value['title'] ?></h2>
					<p><?php echo $value['description'] ?></p>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
	</div>

    <?php $colum = getColumn(1, 'gongnenjieshao',true); ?>
	<div class="main2 mt">
        <h2 class="w-title"><?php echo $colum['name']?></h2>
        <p class="w-text"><?php echo $colum['param']['zhdescription']?></p>
			<div class="container gongneng">
                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|3");
                foreach ($lists as $key=>$value) : ?>
				<div class="col-lg-2 col-xs-6">
					<i class="iconfont"><img src="<?php echo $value['thumb'] ?>" /></i>
					<p><?php echo $value['title'] ?></p>
				</div>
                <?php endforeach; ?>
			</div>
	</div>

    <?php $colum = getColumn(1, 'case',true); ?>
	<div class="main3 mt">
		<h2 class="w-title"><?php echo $colum['name']?></h2>
		<p class="w-text"><?php echo $colum['param']['zhdescription']?></p>
		<div class="container case">
			<div class="row">
                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|8");
                foreach ($lists as $key=>$value) : ?>
				<div class="col-lg-3 col-xs-12 casepic">
					<div class="recent-work-wrap">
			          <a href="<?php echo $value['link'] ?>">
			          <img class="img-responsive" src="<?php echo $value['thumb'] ?>" alt="">
				          <div class="overlay">
					            <div class="recent-work-inner">
					              <h3><?php echo $value['title'] ?></h3>
					            </div>
				          </div>
				       </a>
			        </div>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
		<a href="case.html" class="more">查看更多</a>
	</div>

    <?php $colum = getColumn(1, 'news',true); ?>
	<div class="main4 mt">
		<h2 class="w-title"><?php echo $colum['name']?></h2>
		<p class="w-text"><?php echo $colum['param']['zhdescription']?></p>
		<div class="container">
			<div class="row">
                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|3");
                foreach ($lists as $val): ?>
				<div class="col-lg-4 col-xs-12 ">
					<a href="" class="line">
						<img src="<?php echo $val['thumb'] ?>" />
						<div class="xin">
							<div class="time">
								<span><?php echo substr(gmdate('Y-m-d', $val['intime']),8,2) ?></span>
								<p><?php echo substr(gmdate('Y-m-d', $val['intime']),0,7) ?></p>
							</div>
							<div class="text">
								<h2><?php echo $val['title'] ?></h2>
								<p><?php echo $val['content'] ?></p>
							</div>
						</div>
					</a>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
		<a href="<?php echo $_baseurl ?>zh/news" class="more">查看更多</a>
	</div>
    <div class="main5 mt">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 col-xs-12 text">
                    <!--   地址碎片   -->
                    <?php $aaa = getFragment(3);echo $aaa['content']; ?>
    			</div>
    			<div class="col-lg-6 col-xs-12 photo">
    				<p class="att">关注我们</p>
    				<img src="<?php echo $_uiurl;?>images/wx.png" />
    			</div>
    		</div>
    	</div>
    </div>

    <?php include '_foot.php';?>

    <!-- 代码部分 begin -->
    <div class="main-im">
        <div id="open_im" class="open-im">&nbsp;</div>
        <div class="im_main" id="im_main">
            <div id="close_im" class="close-im"><a href="javascript:void(0);" title="点击关闭">&nbsp;</a></div>
            <a href="http://wpa.qq.com/msgrd?v=3&uin=766648890&site=qq&menu=yes" target="_blank" class="im-qq qq-a" title="在线QQ客服">
                <div class="qq-container"></div>
                <div class="qq-hover-c"><img class="img-qq" src="images/qq.png"></div>
                <span> QQ在线咨询</span>
            </a>
            <div class="im-tel">
                <div>售前咨询热线</div>
                <div class="tel-num">0591-123456789</div>
            </div>
            <div class="im-footer" style="position:relative">
                <div class="weixing-container">
                    <div class="weixing-show">
                        <div class="weixing-txt">微信扫一扫<br>打开官网</div>
                        <img class="weixing-ma" src="images/wechat_code.jpg">
                        <div class="weixing-sanjiao"></div>
                        <div class="weixing-sanjiao-big"></div>
                    </div>
                </div>
                <div class="go-top"><a href="javascript:;" title="返回顶部"></a> </div>
                <div style="clear:both"></div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            $('#close_im').bind('click',function(){
                $('#main-im').css("height","0");
                $('#im_main').hide();
                $('#open_im').show();
            });
            $('#open_im').bind('click',function(e){
                $('#main-im').css("height","272");
                $('#im_main').show();
                $(this).hide();
            });
            $('.go-top').bind('click',function(){
                $(window).scrollTop(0);
            });
            $(".weixing-container").bind('mouseenter',function(){
                $('.weixing-show').show();
            })
            $(".weixing-container").bind('mouseleave',function(){
                $('.weixing-show').hide();
            });
        });
    </script>
</body>
</html>
