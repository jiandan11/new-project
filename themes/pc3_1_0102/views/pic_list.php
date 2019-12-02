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
                    <li class = <?php  echo $value['sign']==$_column?"now":"";?>>
                        <a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" > <?php echo $value['name'] ?> </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

	    <div class="scd_r">
            <div class="r_name"><span> <?php echo $_channel["name"] ?></span></div>
	        <div class="new">
                <!--产品展示-->
                   <div class="row">
                      <?php foreach ($_list as $val): ?>
                   	  <div class="col-lg-3 col-xs-6 pro">
                   	  	 <a href="<?php echo $val['link'] ?>">
                   	  	 	<img src="<?php echo $val['thumb'] ?>" tppabs="<?php echo $val['thumb'] ?>"  />
                   	  	 	<p><?php echo $val['title'] ?></p>
                   	  	 </a>
                   	  </div>
                      <?php endforeach; ?>
                   </div>
                <!--分页-->
                <div class="clear holder pager249"><?php echo $_pagebreak; ?></div>
            </div>
	    </div>
	</div>

<?php include '_footer.php';?>