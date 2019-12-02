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
	<div class="pst_bg">
        <div class="pst"><?php echo $_navigation?></div>
	</div>

    <?php $colum = getColumn(1, $_channel["sign"]); ?>
	<div class="scd clearfix">
		<div class="scd_l">
            <div class="s_name"><?php echo $colum['name']; ?></div>
            <ul class="s_nav">
                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
                foreach ($colum['list'] as $key=>$value) : ?>
                    <li class="<?php echo $key == 0? 'now' : '' ?>">
                        <a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" > <?php echo $value['name'] ?> </a>
                    </li>
                <?php endforeach; ?>
            </ul>
	    </div>
	    <div class="scd_r">
	    	<div class="r_name"><span><?php echo $colum['list'][0]['name']; ?></span></div>
	        <div class="lianxi">
                <!--  碎片  -->
                <?php $aaa = getFragment(3);echo $aaa['content']; ?>
	        	<p>
					<!-- Map Section -->
                    <div class="contact_map" >
                        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=6d88e38ab7f507ee19cec46443691d95"></script>
                        <div id="map"></div>
                        <script src="/dbgms/plugin/baiduMaps/maps.js"></script>
                        <script> get_map("map",119.282232,26.083263,"福州",15);</script>
                    </div>
				</p>
	        </div>
	    </div>
	</div>

<?php include '_footer.php';?>
