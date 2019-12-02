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
                    <div class="col-md-3 col-sm-6">
                    	<div class="ct_teacher_outer_wrap">
                        	<figure>
                            	<img src="<?php echo $value['thumb'] ?>" alt="">
                            </figure>
                            <div class="ct_teacher_wrap">
                            	<h5><a href="<?php echo $value['link'] ?>"><?php echo $value['title'] ?></a></h5>
                                <span><?php echo empty($value['description'])?'暂无描述':$value['description'] ?></span>
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
    <!--Pretty Photo Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.prettyPhoto.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo $_uiurl;?>js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo $_uiurl;?>js/dl-menu/jquery.dlmenu.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo $_uiurl;?>js/waypoints-min.js"></script>
    <!--Accordian Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.accordion.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo $_uiurl;?>js/custom.js"></script>

  </body>
</html>
