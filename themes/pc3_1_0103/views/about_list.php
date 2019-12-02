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
    	<div class="row about">
    		<div class="col-lg-4 clo-xs-12"><img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/file' . $colum['icon'] ?>"/></div>
    		<div class="col-lg-8 col-xs-12 text">
    			<h2><?php echo $colum['param']['zhtitle'] ?></h2>
    			<p><?php echo $colum['content'] ?></p>
    		</div>
    	</div>

    	<div class="row brand">
            <?php foreach ($_list as $val): ?>
    		<a class="col-lg-4 col-xs-12" href="<?php echo $val['link'] ?>">
    			<img src="<?php echo $val['thumb'] ?>" />
    			<h2><?php echo $val['title'] ?></h2>
    			<div style="display: -webkit-box;-webkit-box-orient: vertical;-webkit-line-clamp: 2;overflow: hidden;"><?php echo $val['content'] ?></div>
    		</a>
            <?php endforeach; ?>
    	</div>
        <nav class="pages">
            <!--分页-->
            <?php echo $_pagebreak; ?>
        </nav>
    </div>
    <?php include "_foot.php"?>
	</body>
</html>
