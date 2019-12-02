<?php include '_head.php';?>
    <?php $colum = getColumn(1, $_channel["sign"],true); ?>
    <div class="aboutbg">
        <div class="container animated bounceInUp">
            <h2><?php echo $colum['name']?></h2>
            <p><?php echo $colum['param']['zhdescription']?></p>
        </div>
    </div>
    <div class="newnav">
    	<div class="container">
    		<div class="row">
                <div class="col-lg-1 col-xs-3">
                    <a href="<?php echo $_baseurl;?>zh/about" class="<?php echo $_column=='about'?'current':'';?>" style='cursor:pointer' title="<?php echo $colum['name']?>"><?php echo $colum['name']?></a>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xs-12" style="text-align: center">
                <h2><?php echo $_content['title']; ?></h2>
                <img src="<?php echo $_content['thumb']; ?>" style="margin:20px 0 20px 0;">
                <p><?php echo $_content['content'] ?></p>
            </div>

        </div>
        <div class="col-md-12">
            <ul class="pager">
                     <span class="productContent_other">
                    <span class="previous"> <a href='<?php echo $_prev['link'] ?>'>&nbsp;[←]&nbsp;<?php echo $_prev['title'] ?></a></span>
                    <span class="next"> <a href='<?php echo $_next['link'] ?>'>&nbsp;[→]&nbsp;<?php echo $_next['title'] ?></a></span>
            </ul>
        </div>
    </div>
    <?php include "_foot.php"?>
	</body>
</html>
