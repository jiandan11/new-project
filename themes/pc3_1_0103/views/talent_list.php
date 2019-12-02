<?php include '_head.php';?>

    <?php $colum = getColumn(1, $_channel["sign"],true); ?>
    <div class="talentbg">
	    <div class="container animated bounceInUp">
	    	<h2><?php echo $colum['name']?></h2>
	    	<p><?php echo $colum['param']['zhdescription']?></p>
	    </div>
</div>
    <div class="container mt">
    	<div class="row">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|9");
            foreach ($colum['list'] as $key=>$value) : ?>
                <div class="col-lg-4 col-xs-12 talent">
                    <h2><?php echo $value['name']; ?></h2>
                    <h3>职位要求：</h3>
                    <p><?php echo getColumn(1, $value['sign'])['content']; ?></p>
                </div>
            <?php endforeach; ?>
    	</div>
    </div>
	<?php include "_foot.php"?>
	</body>
</html>
