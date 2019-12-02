<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"],true); ?>
<?php include '_head2.php'?>
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
    	<section>
        	<div class="container">
                <div class="row">
                    <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|1000");
                    foreach ($lists as $key=>$value) : ?>
                    <div class="col-md-4 col-sm-6">
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
                                <p><?php echo empty($value['description'])?'暂无描述':$value['description'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="ct_pagination">
                        <!--分页-->
                        <?php echo $_pagebreak; ?>
                    </div>
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
	<!--Dl Menu Script-->
	<script src="<?php echo $_uiurl;?>js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo $_uiurl;?>js/dl-menu/jquery.dlmenu.js"></script>
    <!--Time Counter Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.downCount.js"></script>
    <!--Pretty Photo Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.prettyPhoto.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo $_uiurl;?>js/waypoints-min.js"></script>
    <!--Accordian Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.accordion.js"></script>
    <!--Accordian Javascript-->
    <script src="<?php echo $_uiurl;?>js/chosen.jquery.min.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo $_uiurl;?>js/custom.js"></script>

  </body>
</html>
