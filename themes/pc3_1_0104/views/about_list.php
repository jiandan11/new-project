<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"],true); ?>
    <?php include '_head2.php'?>
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
        <!--Get Started Wrap Start-->
        <section>
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
                
                <div class="row">
                    <?php foreach ($colum['list'] as $key=>$value) : ?>
                    <?php if($key>=3) break; ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="get_started_services">
                                <div class="get_started_icon">
                                    <i class="fa fa-paper-plane-o"></i>
                                </div>
                                <div class="get_icon_des">
                                    <h5><?php echo $value['name'] ?></h5>
                                    <p><?php echo getColumn(1, $value['sign'])['param']['zhdescription']; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!--Get Started Wrap End-->
        <div class="ct_learn_more_bg">
        	<div class="container">
            	<div class="ct_learn_more">
                	<h4>我们提供优质高效的 <span>服务</span></h4>
                    <a href="#">查看更多</a>
                </div>
            </div>
        </div>
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

        <section class="teacher_bg">
        	<div class="container">
            	<!--Heading Style 1 Wrap Start-->
                <div class="ct_heading_1_wrap">
                	<h3><?php echo $colum['name'] ?></h3>
                    <p><?php echo $colum['param']['zhdescription'] ?></p>
                    <span><img src="<?php echo $_uiurl;?>images/hdg-01.png" alt=""></span>
                </div>
                <!--Heading Style 1 Wrap End-->

                <?php $colum = getColumn(1, 'hexintuandui'); ?>
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
                <!--Teacher List Wrap End-->
                
            </div>
        </section>
        
        
        
        
        
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
    <!--Owl Carousel JavaScript-->
	<script src="<?php echo $_uiurl;?>js/owl.carousel.js"></script>
    <!--Time Counter Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.downCount.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo $_uiurl;?>js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo $_uiurl;?>js/dl-menu/jquery.dlmenu.js"></script>
    <!--Pretty Photo Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.prettyPhoto.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo $_uiurl;?>js/waypoints-min.js"></script>
    <!--Accordian Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.accordion.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo $_uiurl;?>js/custom.js"></script>

  </body>
</html>
