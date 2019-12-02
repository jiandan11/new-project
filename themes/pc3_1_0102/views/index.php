<?php include '_head.php';?>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
    </div>
    <?php $colum = getColumn(1, 'portfolio'); ?>
    <div class="container">
    	<div class="biaoti">
    		<h2><?php echo $colum['name']; ?></h2>
            <!--SEO 描述-->
    		<p><?php echo $colum['param']['zhdescription']; ?></p>
            <!--SEO 标题-->
    		<div class="english"><span><?php echo $colum['param']['zhtitle']; ?></span></div>
    	</div>
    </div>
    <div class="line"></div>
    <?php $colum = getColumn(1, 'portfolio'); ?>
    <div class="container mt">
    	<div class="row">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|3");
            foreach ($colum['list'] as $key=>$value) : ?>
                <!--    $lists有些字段获取不到    -->
                <?php $colum_2 = getColumn(1, $value['sign']); ?>
                <div class="col-lg-4 col-sm-4">
                    <section>
                        <a href="<?php echo $value['link'] ?>">
                            <div class="f-box">
                                <i class="iconfont"><?php echo $value['icon']; ?></i>
                                <h2><?php echo $value['name'] ?></h2>
                                <p class="yw"><?php echo $colum_2['param']['zhtitle']; ?></p>
                                <u></u>
                                <p class="f-text"><?php echo $colum_2['param']['zhdescription']; ?></p>
                            </div>
                        </a>
                    </section>
                </div>
            <?php endforeach; ?>
    	</div>
    </div>


    <div class="container">
    	<div class="biaoti">
    		<h2><?php echo $colum['name']; ?></h2>
    		<p><?php echo getColumn(1, $colum['sign'])['param']['zhdescription']; ?></p>
    		<div class="english"><span>CASE</span></div>
    	</div>
    </div>
    <div class="line"></div>
    <!--电脑产品中心-->
    <div class="container hidden-xs mt">
    <?php $colum = getColumn(1, 'xiangmuanli'); ?>
    <div class="row">
        <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
        foreach ($lists as $val): ?>
            <div class="col-xs-12 col-sm-4 col-md-4 ">
                <div class="recent-work-wrap">
                    <a href="<?php echo $val['link'] ?>">
                        <img class="img-responsive" src="<?php echo $val['thumb'] ?>" tppabs="<?php echo $val['thumb'] ?>"  alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h3><?php echo $val['title']; ?></h3>
                                <p><?php echo $val['content']; ?> </p>
                                <!--<a class="preview" href="" rel="prettyPhoto" title=""><i class="fa fa-search"></i></a> -->
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <a href="<?php echo $_baseurl; ?>zh/xiangmuanli/" class="more">查看更多</a>
	</div>

    <!--移动端case样式-->
    <div class="row  product hidden-lg" style=" margin: 0; padding-top: 20px;">
	<div class="col-lg-12">
		<ul class="bxslider">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
            foreach ($lists as $val): ?>
			<li>
				<a href="">
				<div class="element item view view-tenth" data-zlname="reverse-effect">
					<img src="<?php echo $val['thumb'] ?>" tppabs="<?php echo $val['thumb'] ?>"  alt="" />
					<div class="mask">
						<a data-zl-popup="link" href="javascript:;">
							<i class="icon-link"></i>
						</a>
						<a data-zl-popup="link2" class="fancybox" rel="group" href="" >
							<i class="icon-search"></i>
						</a>
					</div>
				</div>
				</a>
			</li>
            <?php endforeach; ?>
		</ul>
	</div>
    </div>

    <?php $colum = getColumn(1, 'news'); ?>
     <div class="news mt">
    	<div class="container">
    		<div class="row">
    			<div class="newtit">
    				<h2><?php echo $colum['name']; ?></h2>
    				<span><?php echo $colum['ename']; ?></span>
    			</div>
    			<p class="newstext"><?php echo $colum['param']['zhdescription']; ?></p>
				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs col-lg-offset-4 col-md-offset-4 col-xs-offset-1" role="tablist">
                      <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|2");
                      foreach ($colum['list'] as $key=>$value) : ?>
                          <li role="presentation" class="<?php echo $key==0?'active':'' ?>">
                              <a href="#<?php echo $value['sign'] ?>" aria-controls="<?php echo $value['sign'] ?>" role="tab" data-toggle="tab"><?php echo $value['name'] ?></a>
                          </li>
                      <?php endforeach; ?>
                      <li role="presentation"><a href="<?php echo $_baseurl; ?>zh/news/">查看更多</a></li>
				  </ul>
				  <!-- Tab panes -->
				  <div class="tab-content">
                      <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|2");
                      foreach ($colum['list'] as $key=>$value) : ?>
				    <div role="tabpanel" class="<?php echo $key==0?'tab-pane active':'tab-pane' ?>" id="<?php echo $value['sign'] ?>">
				    	<div class="container">
				    		<div class="row">
                                <!--   获取新闻子栏目的列表  -->
                                <?php $colum_new = getColumn(1, $value['sign']); ?>
                                <!--  获取栏目图标  -->
				    			<div class="col-lg-4 col-lg-offset-2 hidden-xs hidden-md img" ><img style="display: inline-block; height: auto;max-width: 100%;" src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/file' .$colum_new['icon']; ?>"  tppabs="" /></div>
				    			<div class="col-lg-4 col-xs-12">
				    				<ul class="newslist">
                                        <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum_new['clists']};sort|intime;sorttype|desc;row|6");
                                        foreach ($lists as $val): ?>
                                        <li><a href=""><i><?php echo $val['content'] ?></i><span><?php echo date('Y-m-d',$val['intime']) ?></span></a></li>
                                        <?php endforeach; ?>
                                    </ul>
				    			</div>
				    		</div>
				    	</div>
				    </div>
                      <?php endforeach; ?>
                  </div>
    		</div>
    	</div>
    </div>

     <?php $colum = getColumn(1, 'cooperative'); ?>
    <div class="container mt">
    	<div class="biaoti">
    		<h2><?php echo $colum['name']?></h2>
    		<p><?php echo $colum['param']['zhdescription']?></p>
    		<div class="english"><span><?php echo $colum['param']['zhtitle']; ?></span></div>
    	</div>
    </div>

    <div class="container partner mt">
    	<div class="row">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
            foreach ($colum['list'] as $key=>$value) : ?>
                <div class="col-lg-2 col-md-2 col-xs-4"><a href=""><img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/file' . $value['icon'] ?>" tppabs="" /></a></div>
            <?php endforeach; ?>
    	</div>
    </div>
    <div class="add mt">
	    <div class="container">
	      <div class="row">
	      	  <div class="col-lg-4 col-md-3 col-xs-12">
                    <!--   地址碎片   -->
                  <?php $aaa = getFragment(3);echo $aaa['content']; ?>
	      	  </div>
	      	  <div class="col-lg-4 col-md-3 col-xs-12"><!-- Map Section -->
                  <div class="contact_map" >
                      <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6d88e38ab7f507ee19cec46443691d95"></script>
                      <div id="map"></div>
                      <script src="/dbgms/plugin/baiduMaps/maps.js"></script>
                      <script> get_map("map",119.282232,26.083263,"福州");</script>
                  </div>

              </div>
	      	  <div class="col-lg-4 col-md-3 col-xs-12">
	      	  	<h2>留言板</h2>
                  <div><?php echo getformhtml(3); ?></div>
	      	  </div>
	      </div>
	    </div>
    </div>


<?php include '_footer.php';?>
