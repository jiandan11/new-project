
<?php include '_head.php';?>

    <div class="contactbg">
	    <div class="container animated bounceInUp">
	    	<h2>联系我们</h2>
	    	<p>拥有不一样的高端品牌微信网站，你还在等什么？可以从以下方式联系我们。</p>
	    </div>
    </div>

    <div class="contact">
    	<h2></h2>
    	<div class="container">

			<section class="map ">
				<!-- Map Section -->
				<div class="contact_map" >
					<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6d88e38ab7f507ee19cec46443691d95"></script>
					<div id="map"></div>
                    <script src="/dbgms/plugin/baiduMaps/maps.js"></script>
                    <script> get_map("map",119.282232,26.083263,"福州");</script>
				</div>


			</section>



    	    <div class="row constyle mt">
    	    	<div class="col-lg-2 col-xs-12 share">
                    <img src="<?php echo DBG_FILEURL . $_site['logo'] ?>"  alt="<?php echo $_seo['title']; ?>" />
    	    	</div>
    	    	<div class="col-lg-5 col-xs-12 text">
                    <!--   地址碎片   -->
                    <?php $aaa = getFragment(3);echo $aaa['content']; ?>
    	    	</div>
    	    	<div class="col-lg-4 col-xs-12">
    	    		<img src="images/wei.png" />
    	    	</div>
    	    </div>
    	</div>
    	
    </div>
    <?php include '_foot.php';?>
	</body>
</html>
