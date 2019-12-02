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
                    <li>
                        <a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" > <?php echo $value['name'] ?> </a>
                    </li>
                <?php endforeach; ?>
            </ul>
	    </div>

	    <div class="scd_r">
            <div class="r_name"><span> <?php echo $_channel["name"] ?></span></div>
            <div class="new">
                <dl class="clearfix">
                    <dd class="newcontent">
                        <div class="product_summary">
                            <ul>
                                <li><span>点击数:</span><span><?php echo $_content['hits']; ?></span></li>
                                <li><span>产品描述:</span><span><?php echo $_site['description'] ?></span></li>
                            </ul>
                        </div>
                        <div><p><?php echo $_content['content'] ?></p></div>
                    </dd>
                    <div>
                        <span class="productContent_other">
                        <span class="prev-product"> <a href='<?php echo $_prev['link'] ?>'>&nbsp;[←]&nbsp;<?php echo $_prev['title'] ?></a></span>
                        <span class="next-product"> <a href='<?php echo $_next['link'] ?>'>&nbsp;[→]&nbsp;<?php echo $_next['title'] ?></a></span>
                    </div>
                </dl>
            </div>
	    </div>
	</div>

<?php include '_footer.php';?>
