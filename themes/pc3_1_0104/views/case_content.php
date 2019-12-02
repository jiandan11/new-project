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
                                <h4><?php echo $_content['title']; ?></h4>
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
                                <a href="<?php echo $_next['link'] ?>">下一案例</a>
                            </div>
                            <div class="ct_blog_detail_des">
                            	<figure>
                                	<img src="<?php echo $_content['thumb']; ?>" alt="">
                                </figure>
                                <div class="ct_course_detail_wrap">
                                	<h5>案例信息</h5>
                                    <div class="row">
                                    	<div class="col-md-5">
                                        	<ul class="ct_course_list">
                                            	<li>
                                                	<h6>项目分类:</h6>
                                                    <span><?php echo $_content['label']; ?></span>
                                                </li>
                                                <li>
                                                	<h6>开始时间:</h6>
                                                    <span>2017-1-1</span>
                                                </li>
                                                <li>
                                                	<h6>结束时间:</h6>
                                                    <span>2017-2-1</span>
                                                </li>
                                                <li>
                                                	<h6>参与人数:</h6>
                                                    <span>3</span>
                                                </li>
                                                <li>
                                                	<h6>工时:</h6>
                                                    <span>200 Hours</span>
                                                </li>
                                                <li>
                                                	<h6>项目评分:</h6>
                                                    <span>5</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-7">
                                        	<div class="ct_blog_detail_des_list">
                                                <p>
                                                   <?php echo $_content['content']; ?>
                                                </p>
                                                <ul>
                                                    <li>1、合同的签订，这是项目进程中开始不可缺少的重要环节</li>
                                                    <li>2、开始设计，项目的内容环节，设计出客户所要求和可能想要的效果图并进行必要的沟通</li>
                                                    <li>3、客户审查,给客户审查，并对其提出的修改意见进行实施</li>
                                                    <li>4、设计交付,交付给客户最终的效果图，得到项目的尾款，并得到客户打的满意分数</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ct_blog_detail_tag">
                            	<h5>标签</h5>
                                <ul>
                                	<li><a href="#"><?php echo $_content['label']; ?></a></li>
                                </ul>
                            </div>
                            
                            <!--Comment Wrap Start-->
                            
                            <!--Comment Wrap End-->
                            
                            <!--Add Acomment Wrap Start-->
                            
                            <!--Add Acomment Wrap End-->
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
