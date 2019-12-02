<?php include 'header.php';?>

<?php include 'left1.php';?>

<?php include 'left2.php';?>

<?php include 'left3.php';?>

		</div>
		<div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
			<div class="label clear" id="603" rel="603" titles="产品列表">
	<div class="label_head">
		<div class="label_title">产品展示</div>
	</div>
                <?php foreach ($colum['list'] as $value) : ?>
                    <li><a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" >
                            <?php echo $value['name'] ?></a>
                    </li>
                <?php endforeach; ?>
	<div class="label_content">
		<div class="pic_list1 pic_list_roll" id="pic_list603">
			<ul class="clearfix" id="prolist603">
                <!--     产品展示           -->
                <?php foreach ($_list as $val): ?>
                    <li>
                        <a title="<?php echo $val['title'] ?>" href="<?php echo $val['link'] ?>"><img src="<?php echo $val['thumb'] ?>" style='width: 150px; height: 130px;' alt="<?php echo $val['title'] ?>"/>
                            <p class="title"><?php echo $val['title'] ?></p></a>
                    </li>
                <?php endforeach; ?>
			</ul>
            <div class="clear holder pager249"><?php echo $_pagebreak; ?></div>
<!--			<div class="clear holder pager603" style="-moz-user-select: none;">-->
<!--<a class="jp-first jp-disabled">首页</a>-->
<!--<a class="jp-previous jp-disabled">上页</a>-->
<!--<a class="jp-current">1</a>-->
<!--<a class="jp-next jp-disabled">下页</a>-->
<!--<a class="jp-last jp-disabled">尾页</a>-->
</div>
		</div>
	</div>
	<div class="label_foot"></div>
</div>

		</div>
		<div class="clear"></div>
	</div>


<?php include 'foot.php';?>