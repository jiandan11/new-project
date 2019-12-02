<?php include '_head.php';?>

    <?php $colum = getColumn(1, $_channel["sign"],true); ?>
    <div class="newbg">
	    <div class="container animated bounceInUp">
	    	<h2><?php echo $colum['name']?></h2>
	    	<p><?php echo $colum['param']['zhdescription']?></p>
	    </div>
    </div>
     <div class="newnav">
    	<div class="container">
    		<div class="row">
                <div class="col-lg-1 col-xs-3">
                    <a href="<?php echo $_baseurl;?>zh/news" class="<?php echo $_column=='news'?'current':'';?>" style='cursor:pointer' title="最新资讯">最新资讯</a>
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
    <div class="newlist">
    	<div class="container">
            <?php foreach ($_list as $val): ?>
    		<div class="new">
    			<a href="<?php echo $val['link'] ?>">
	    			<div class="col-lg-2 col-xs-3 shijian">
	    				<h2 style="float:left"><?php echo substr(gmdate('Y-m-d', $val['intime']),8,2) ?></h2>
                        <div style="float:right;margin-top: 25px">
                            <span><?php echo substr(gmdate('Y-m-d', $val['intime']),0,7) ?></span>
                            <p><?php echo $colum['name']?></p>
                        </div>

	    			</div>
	    			<div class="col-lg-10 col-xs-9">
	    				<h2 class="title"><?php echo $val['title'] ?></h2>
	    				<p class="text"><?php echo $val['content'] ?></p>
	    			</div>
    			</a>
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
