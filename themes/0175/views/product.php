<?php include 'header.php';?>

<?php include 'left1.php';?>

<?php include 'left2.php';?>

<?php include 'left3.php';?>

</div>
<div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
    <div class="label clear" id="603" rel="603" titles="产品详情">
        <div class="label_head">
            <div class="label_title"><?php echo $_content['title']; ?></div>
        </div>
        <div class="label_content">
            <div class="product_summary">
                <ul>
                    <li><span>点击数:</span><span><?php echo $_content['hits']; ?></span></li>
                    <li><span>产品类别:</span><span><?php echo $_content['columnname']; ?></span></li>
                    <li><span>产品描述:</span><span><?php echo $_site['description'] ?></span></li>
                </ul>
            </div>
            <?php echo $_content['content'] ?>
        </div>
        <div>
        <span class="productContent_other">
            <span class="prev-product"> <a href='<?php echo $_prev['link'] ?>'>&nbsp;[←]&nbsp;<?php echo $_prev['title'] ?></a></span>
            <span class="next-product"> <a href='<?php echo $_next['link'] ?>'>&nbsp;[→]&nbsp;<?php echo $_next['title'] ?></a></span>
        </div>

	</div>
	<div class="label_foot"></div>
</div>

		</div>
		<div class="clear"></div>
	</div>

<?php include 'foot.php';?>