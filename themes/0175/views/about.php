<?php include 'header.php';?>

<?php include 'left1.php';?>

<?php include 'left2.php';?>

<?php include 'left3.php';?>

		</div>
		<div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
			<div class="label labelDis news_detail" id="1" rel="1" titles="文章内容">
        <div class="news_detail_title"><?php echo $_content['title']; ?></div>
        <div class="news_detail_info">
            <div class="news_detail_time"><?php echo date('Y-m-d', $_content['intime']); ?></div>
            <div class="news_detail_from">来源:<?php echo $_content['source'] ?></div>
            <div class="news_detail_tool">点击数:&nbsp;<span><?php echo $_content['hits']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者:<?php echo $_content['username'] ?></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div id="mcontent" class="news_detail_cont">
            <?php echo $_content['content'] ?>
        </div>
<!--	<div class="articleContent_other">-->
<!--		<div class="next-article"><a href="">下一篇:智能建站新闻列表</a></div>-->
<!--	</div>-->
</div>

		</div>
		<div class="clear"></div>
	</div>

<?php include 'foot.php';?>