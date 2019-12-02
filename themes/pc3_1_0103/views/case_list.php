<?php include '_head.php';?>

    <?php $colum = getColumn(1, $_channel["sign"],true); ?>
    <div class="casebg">
        <div class="container animated bounceInUp">
            <h2><?php echo $colum['name']?></h2>
            <p><?php echo $colum['param']['zhdescription']?></p>
        </div>
    </div>
    <div class="newnav">
    	<div class="container">
            <div class="row">
                <div class="col-lg-1 col-xs-3">
                    <a href="<?php echo $_baseurl;?>zh/case" class="<?php echo $_column=='case'?'current':'';?>" style='cursor:pointer' title="全部">全部</a>
                </div>
                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
                foreach ($colum['list'] as $key=>$value) : ?>
                    <div class="col-lg-1 col-xs-3">
                        <a class=<?php  echo $value['sign']==$_column?"current":"";?> style='cursor:pointer' title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" > <?php echo $value['name'] ?> </a>
                    </div>
                <?php endforeach; ?>
            </div>
    	</div>
    </div>
    <div class="container case mt">
			<div class="row">
                <?php foreach ($_list as $val): ?>
				<div class="col-lg-3 col-xs-12 casepic">
					<div class="recent-work-wrap">
			          <a href="<?php echo $val['link'] ?>">
			          <img class="img-responsive" src="<?php echo $val['thumb'] ?>" alt="">
				          <div class="overlay">
					            <div class="recent-work-inner">
					              <h3><?php echo $val['title'] ?></h3>
					            </div>
				          </div>
				       </a>
			        </div>
				</div>
                <?php endforeach; ?>
			</div>
		</div>
	<nav class="pages">
        <!--分页-->
        <?php echo $_pagebreak; ?>
	</nav>
    <?php include '_foot.php';?>
	</body>
</html>
