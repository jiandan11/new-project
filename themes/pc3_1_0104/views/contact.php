<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"],true); ?>
<?php include '_head2.php'?>
    
    <!--Content Wrap Start-->
    <div class="ct_content_wrap">
        <!--Map Wrap Start-->
        <section class="map ">
        	<div class="container">
                <!-- Map Section -->
                <div class="contact_map" style="margin-top: 35px" >
                    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6d88e38ab7f507ee19cec46443691d95"></script>
                    <div id="map"></div>
                    <script src="/dbgms/plugin/baiduMaps/maps.js"></script>
                    <script> get_map("map",119.282232,26.083263,"福州");</script>
                </div>
        	</div>
        </section>
        <!--Map Wrap End-->
        
        <!--Get in Touch With Us Wrap Start-->
        <section style="margin-top: -100px">
        	<div class="container">
            	<div class="get_touch_wrap">
                	<h4>联系方式:</h4>
                    <p>
                    	5天12小时竭诚为您服务
                    </p>
                </div>
                <div class="row">
                	<div class="col-md-6">
                    	<div class="ct_contact_form">
                            <?php echo getformhtml(3); ?>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
						<div class="bottom_border">
							<div class="row">
								<div class="col-md-6">
									<div class="ct_contact_address">
										<h5><i class="fa fa-map-o"></i>地址</h5>
										<p><?php $aaa = getFragment(7);echo $aaa['content']; ?></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="ct_contact_address">
										<h5><i class="fa fa-envelope-o"></i>服务热线 & 邮件</h5>
										<ul class="fax_info">
											<li> <?php $aaa = getFragment(8);echo $aaa['content']; ?></li>
										</ul>
										<p> <?php $aaa = getFragment(6);echo $aaa['content']; ?></p>
									</div>
								</div>
							</div>
						</div>
						
                <div class="newletter_des contact_us_newsltr">
                    <h5>订阅我们的邮件推送</h5>
                    <form>
                        <label class="fa fa-envelope-o"></label>
                        <input type="text" placeholder="输入你的邮箱">
                        <button>确定</button>
                    </form>
                    <p>不定期发送最新优质服务内容，让您更了解我们 </p>
                </div>
            </div>
                    
                </div>
            </div>
        </section>
        <!--Get in Touch With Us Wrap End-->
        
        
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
    <!--Custom JavaScript-->
	<script src="<?php echo $_uiurl;?>js/custom.js"></script>

  </body>
</html>
