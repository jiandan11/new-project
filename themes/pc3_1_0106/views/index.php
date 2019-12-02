<?php include '_head.php';?>
    <style type="text/css">
        .news-content p{
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
    </style>

			<section id="home-section" class="slider1">
				<div class="tp-banner-container">
					<div class="tp-banner">
						<ul>
                            <?php $banner = getLists(1, "model|1;state|20;row|6;");?>
                            <?php foreach ($banner as $key=>$val): ?>
                                <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="">
                                    <img src="<?php echo $val['slide']; ?>"  alt="<?php echo $val['title']; ?>"  data-bgposition="center" data-bgfit="cover" data-bgrepeat="no-repeat"/>
<!--                                    <img src="skin/images/1-1P424151104D7.jpg" alt="幻灯3" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />-->
                                </li>
                            <?php endforeach; ?>
<!--							<li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="banner1"> -->
<!--                                <img src="skin/images/1-1P424151104D7.jpg" alt="幻灯3" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" /> -->
<!--                            </li>-->
<!--							<li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="banner1"> <img src="skin/images/1-1P4241510435R.jpg" alt="幻灯2" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" /> </li>-->
<!--							<li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="banner1"> <img src="skin/images/1-1P424151021Y2.jpg" alt="幻灯1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" /> </li>-->
						</ul>
						<div class="tp-bannertimer"></div>
					</div>
				</div>
			</section>

            <!--  产品分类 -->
            <?php $colum = getColumn(1, 'product'); ?>
			<section class="services-section" id="index-cate">
				<div class="container">
					<div class="services-box">
						<div class="row">
                            <?php foreach ($colum['list'] as $key=>$value) : ?>
							<div class="col-md-3 col-sm-6 col-xs-6 cate-itme">
								<div class="services-post">
									<a href="javascript:;" class="thumb-link"><img src="<?php echo  '/file' . $value['icon'] ?>" /></a>
									<div class="services-content">
										<h2><a href="javascript:;"><?php echo $value['name'] ?></a></h2>
										<p><?php echo getColumn(1, $value['sign'])['param']['zhdescription'];  ?></p>
										<a href="#" class="readmore">查看更多 <i class="fa fa-angle-double-right"></i></a>
									</div>
								</div>
							</div>
                            <?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>

            <!-- 产品系列 -->
			<section class="portfolio-section" id="index-portfolio">
				<div class="container">
					<h3 class="text-center section-title"><a href="javascript:;">产品系列</a> </h3>
					<div class="portfolio-box owl-wrapper">
						<div class="owl-carousel" data-num="4">
                            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|100");
                            foreach ($lists as $key=>$val) : ?>
							<div class="item project-post">
								<div class="project-gallery"> <img src="<?php echo $val['thumb'] ?>" alt="<?php echo $val['title'] ?>" />
									<div class="hover-box">
										<div class="inner-hover">
											<h2><a href="javascript:;"><?php echo $val['title'] ?></a></h2>
                                            <?php $data = getSuperiorInfo($val['columnid']); ?>
											<span><?php echo $data[0]['name'] ?></span> </div>
									</div>
								</div>
								<h3 class="iport-h3-title"><a href="<?php echo $val['link'] ?>" title="<?php echo $val['title'] ?>"><?php echo $val['title'] ?></a></h3>
							</div>
                            <?php endforeach; ?>

						</div>
					</div>
				</div>
			</section>
			<section class="tabs-section" id="index-whyus">
				<div class="container">
					<div class="row">
						<div class="col-md-7 whyus-left">
							<div class="about-us-box">
								<h1>选择我们的理由</h1>
								<p class="whyus-desc">与国内知名大学深度合作，有IC研发团队、电子应用研发中心和客户服务中心，在玩具生产基地拥有结构开发团队和生产工厂。公司从源头做起，专注智能电子玩具行业十年，掌握核心技术，并于2006年通过ISO-9001质量管理体系；生产产品各项检测评估通过多家权威机构检测认证如：SGS、TUV、UL、GS ,CE</p>
								<div class="row">
									<div class="col-md-6">
										<div class="about-us-post">
											<a><i class="fa fa-star"></i></a>
											<h2>掌握核心技术，自行研发生产遥控飞机核心部件</h2>
										</div>

										<div class="about-us-post">
											<a><i class="fa fa-code"></i></a>
											<h2>遥控飞机控制程序由公司高级工程师自行开发编写</h2>
										</div>
										<div class="about-us-post">
											<a><i class="fa fa-globe"></i></a>
											<h2>全球市场70%的遥控飞机，均由我司提供技术支持</h2>
										</div>
									</div>
									<div class="col-md-6">
										<div class="about-us-post">
											<a><i class="fa fa-calendar"></i></a>
											<h2>我们是中国最早的遥控飞机研发参与者之一</h2>
										</div>
										<div class="about-us-post">
											<a><i class="fa fa-empire"></i></a>
											<h2>中国第一台遥控飞机制造者</h2>
										</div>
										<div class="about-us-post">
											<a><i class="fa fa-money"></i></a>
											<h2>欧美市场90%的遥控飞机出自我们</h2>
										</div>
									</div>
								</div>
							</div>
						</div>

                        <?php $colum = getColumn(1, 'gongsijianjie',true); ?>
						<div class="col-md-5 whyus-right">
							<div class="about-box">
								<a href="javascript:;"><img src="<?php echo  '/file' . $colum['icon'] ?>" /></a>
								<h2 class="dark-title"><a href="<?php echo $colum['link'] ?>">公司简介</a></h2>
								<div class="iabout-text">
                                    <?php echo $colum['content'] ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

            <!--  新闻资讯  -->
            <?php $colum = getColumn(1, 'news'); ?>
			<section class="news-section" id="index-news">
				<div class="container">
					<h3 class="text-center section-title"><a href="javascript:;"><?php echo $colum['name'] ?></a> </h3>
					<div class="news-box owl-wrapper">
						<div class="owl-carousel" data-num="4">
                            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|100");
                            foreach ($lists as $key=>$val) : ?>
							<div class="item news-post">
								<div class="news-gallery">
									<a href="<?php echo $val['link']?>" class="thumb-link"><img src="<?php echo $val['thumb']?>" alt="<?php echo $val['title']?>" /></a>
									<div class="date-post">
										<p><?php echo substr(date('Y-m-d',$val['intime']),0,7) ?> <span><?php echo substr(date('Y-m-d',$val['intime']),8,2) ?></span></p>
									</div>
								</div>
								<div class="news-content">
									<h2 class="inews-title"><a href="<?php echo $val['link']?>" title="<?php echo $val['title']?>"><?php echo $val['title']?></a></h2>
									<?php echo $val['content']?>
									<a href="<?php echo $val['link']?>" class="news-readmore">阅读更多 <i class="fa fa-angle-right"></i></a>
								</div>
							</div>
                            <?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>


			<?php include '_foot.php'?>