<?php include '_head.php'?>

    <!--Banner Wrap Start-->
    <div class="banner_outer_wrap">
    	<ul class="main_slider">
            <?php $banner = getLists(1, "model|1;state|20;row|6;");?>
            <?php foreach ($banner as $key=>$val): ?>
                <li class="<?php echo $key==0?'active':'' ?>">
                    <img src="<?php echo $val['slide']; ?>"  title="<?php echo $val['title']; ?>"  />
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!--Banner Wrap End-->

    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
        <!--Get Started Wrap Start-->
        <?php $colum = getColumn(1, 'about',true); ?>
        <section >
        	<div class="container">
            	<div class="get_started_outer_wrap">
            		<div class="row">
                        <div class="col-md-6">
                            <div class="get_started_content_wrap ct_blog_detail_des_list">
                                <h3><?php echo $colum['param']['zhtitle'] ?></h3>
                                <p><?php echo $colum['content'] ?></p>
<!--                                <ul>-->
<!--                                	<li>产品用心,前期对产品功能定义及目标用户群调研，上线后进行用户可用性测试。</li>-->
<!--                                    <li>服务贴心，合作的客户中，50%以上的客户都签订了长期战略合作协议。</li>-->
<!--                                    <li>品牌知心，凭借对服务品质和商业价值的追求，赢得了众多国内外客户的信任。</li>-->
<!--                                    <li>我们专注于创意设计实现商业价值最大化，为所有谋求长远发展的企业提升品牌品质</li>-->
<!--                                    <li>团队有多年丰富的设计经验，专注于创意设计实现商业价值最大化</li>-->
<!--                                </ul>-->
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="get_started_video">
                                <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/file' . $colum['icon'] ?>"/>
                            </div>
                        </div>
                	</div>
                </div>
            </div>
        </section>
        <!--Get Started Wrap End-->

        
        <!--Most Popular Courses Wrap Start-->
        <?php $colum = getColumn(1, 'case'); ?>
        <section class="section-1" >
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3>服务案例</h3>
                    <p><?php echo $colum['param']['zhdescription'] ?></p>
                    <span><img src="<?php echo $_uiurl;?>images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Most Popular Course List Wrap Start-->
                <div class="most_popular_courses owl-carousel">
                    <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|100");
                    foreach ($lists as $key=>$value) : ?>
                	<div class="item">
                    	<div class="ct_course_list_wrap">
                        	<figure>
                            	<img src="<?php echo $value['thumb'] ?>" alt="">
                                <figcaption class="course_list_img_des">
                                	<div class="ct_course_review">
                                    	<span>用户评价</span>
                                        <ul>
                                        	<li>
                                            	<a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star"></i></a>
                                                <a href="#"><i class="fa fa-star-half-empty"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ct_zoom_effect"></div>
                                    <div class="ct_course_link">
                                    	<a href="<?php echo $value['link'] ?>">查看详情</a>
                                    </div>
                                </figcaption>
                            </figure>
                            <div class="popular_course_des">
                            	<h5><a href="<?php echo $value['link'] ?>"><?php echo $value['title'] ?></a></h5>
                                <p>
                                    <?php echo empty($value['description'])?'暂无描述':$value['description'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!--Most Popular Course List Wrap End-->

            </div>
        </section>
        <!--Most Popular Courses Wrap End-->
        <!--Learn More Wrap Start-->
        <div class="ct_learn_more_bg">
        	<div class="container">
            	<div class="ct_learn_more">
                	<h4>我们提供优质高效的 <span>服务</span></h4>
                    <a href="#">查看更多</a>
                </div>
            </div>
        </div>
        <!--Learn More Wrap End-->

        <!--Our Teacher Wrap Start-->
        <?php $colum = getColumn(1, 'hexintuandui'); ?>
        <section class="teacher_bg">
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3><?php echo $colum['name'] ?></h3>
                    <p><?php echo $colum['param']['zhdescription'] ?></p>
                    <span><img src="<?php echo $_uiurl;?>images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->

                <!--Teacher List Wrap Start-->
                <div class="row">
                    <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|4");
                    foreach ($lists as $key=>$value) : ?>
                	<div class="col-md-3 col-sm-6">
                    	<div class="ct_teacher_outer_wrap">
                        	<figure>
                            	<img src="<?php echo $value['thumb'] ?>" alt="">
                            </figure>
                            <div class="ct_teacher_wrap">
                            	<h5><a href="#"><?php echo $value['title'] ?></a></h5>
                                <span><?php echo $value['description'] ?></span>
                                <ul>
                                	<li><a href="#"><i class="fa fa-tencent-weibo"></i></a></li>
                                    <li><a href="#"><i class="fa fa-weixin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-weibo"></i></a></li>
                                    <li><a href="#"><i class="fa fa-qq"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!--Teacher List Wrap End-->
                
            </div>
        </section>
        <!--Our Teacher Wrap End-->
        <!--Figures & Facts Wrap Start-->
        <section class="ct_facts_bg">
            <ul>
                <li>
                    <i class="icon-avatar"></i>
                    <h2 class="counter">112</h2>
                    <span>技能丰富的员工</span>
                </li>
                <li>
                    <i class="icon-command"></i>
                    <h2 class="counter">282673</h2>
                    <span>成功服务案例</span>
                </li>
                <li>
                    <i class="icon-open-book"></i>
                    <h2 class="counter">599666</h2>
                    <span>商务咨询</span>
                </li>
                <li>
                    <i class="icon-pulse"></i>
                    <h2 class="counter">200</h2>
                    <span>公司活动</span>
                </li>
            </ul>
        </section>
        <!--Figures & Facts Wrap End-->
        
        <!--Latest News Wrap Start-->
        <?php $colum = getColumn(1, 'news',true); ?>
        <section class="ct_blog_simple_bg">
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3><?php echo $colum['name'] ?></h3>
                    <p><?php echo $colum['param']['zhdescription'] ?></p>
                    <span><img src="<?php echo $_uiurl;?>images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->
                
                <!--Latest News Wrap Start-->
                <div class="row">
                    <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|3");
                    foreach ($lists as $key=>$value) : ?>
                	<div class="col-md-4">
                    	<div class="ct_news_wrap">
                        	<span><?php echo date('Y-m-d',$value['intime']) ?></span>
                            <h5><a href="<?php echo $value['link'] ?>"><?php echo $value['title'] ?></a></h5>
                            <p><?php echo empty($value['description'])?'暂无描述':$value['description'] ?></p>
                            
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!--Latest News Wrap End-->
            </div>
        </section>
        <!--Latest News Wrap End-->
    </div>
    <!--Content Wrap End-->
    
    <!--Footer Wrap Start-->
    <?php include '_foot.php'; ?>
    <!--Footer Wrap End-->
        
</div>
<!--Wrapper End-->



    <!--Bootstrap core JavaScript-->
    <script src="<?php echo $_uiurl;?>js/jquery.js"></script>
    <script src="<?php echo $_uiurl;?>js/bootstrap.min.js"></script>
    <!--Bx-Slider JavaScript-->
	<script src="<?php echo $_uiurl;?>js/jquery.bxslider.min.js"></script>
    <!--Dl Menu Script-->
	<script src="<?php echo $_uiurl;?>js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo $_uiurl;?>js/dl-menu/jquery.dlmenu.js"></script>
    <!--Owl Carousel JavaScript-->
	<script src="<?php echo $_uiurl;?>js/owl.carousel.js"></script>
    <!--Time Counter Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.downCount.js"></script>
    <!--Pretty Photo Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.prettyPhoto.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo $_uiurl;?>js/waypoints-min.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo $_uiurl;?>js/custom.js"></script>

  </body>
</html>
