<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"],true); ?>
<?php include '_head2.php'?>
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
    	<section class="ct_blog_outer_wrap">
        	<div class="container">
                <div class="row">
                    <!--Blog Detail Wrap Start-->
                    <div class="col-md-8">
                        <div class="ct_blog_detail_outer_wrap">
                            <div class="ct_blog_detail_top">
                                <h4>团队风采</h4>
                                <ul>
                                    <li>
                                        <p>
                                            <span>标签：</span>
                                            <span><?php echo $_content['label']; ?></span>
                                        </p>
                                    </li>
                                    <li>
                                        <p>
                                            <span>发布时间：</span>
                                            <span><?php echo date('Y-m-d',$_content['intime']); ?></span>
                                        </p>
                                    </li>
                                </ul>
                                <a href="<?php echo $_next['link'] ?>">下一篇</a>
                            </div>
                            <div class="ct_blog_detail_des">
                            	<figure>
                                	<img src="<?php echo $_content['thumb']; ?>" alt="">
                                </figure>
                                <p style="font-size: 24px"><?php echo $_content['title']; ?></p>
								<p><?php echo $_content['content']; ?> </p>

                            </div>
                            
                            <div class="ct_blog_detail_tag">
                            	<h5>标签</h5>
                                <ul>
                                	<li><a href="#"><?php echo $_content['label']; ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--Blog Detail Wrap End-->
                    <!--Aside Bar Wrap Start-->
                    <?php include '_right.php'; ?>
                            
                            <!--Testimonial Wrap Start-->
                            <?php $colum = getColumn(1, 'remenbiaoqian'); ?>
                            <div class="ct_aside_tag gt_detail_hdg">
                                <h5><?php echo $colum['name'] ?></h5>
                                <ul>
                                    <?php foreach ($colum['list'] as $key=>$value) : ?>
                                        <li><a href="<?php echo $value['link'] ?>?p=1"><?php echo $value['name'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!--Testimonial Wrap Start-->
                            
                        </aside>
                    </div>
                    <!--Aside Bar Wrap End-->
                </div>
            </div>
        </section>
    </div>
    <!--Content Wrap End-->
    
    <!--Footer Wrap Start-->
    <?php include '_foot.php'?>
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
