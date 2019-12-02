
<?php $colum = getColumn(1, 'product'); ?>  <!--参与咨询列表-->
<!--product是标识-->
<div class="fwmain">
		<div class="fwmain_nleft edit_putHere" id="edit_putHere_area1" saveTitle="area1">
			<div class="label clear fwtop_nav6" id="602" rel="602" titles="竖形分类菜单">
	<div class="label_head">
		<div class="label_title">产品分类</div>
	</div>
	<div class="label_content">
        <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
        foreach ($colum['list'] as $value) : ?>
            <h1>
                <a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" > <?php echo $value['name'] ?> </a>
            </h1>
        <?php endforeach; ?>
	</div>
	<div class="label_foot"></div>
</div>
