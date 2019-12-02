
<?php $colum = getColumn(1, 'news'); ?>
<div class="label clear fwtop_nav6" id="645" rel="645" titles="竖形分类菜单">
    <div class="label_head">
        <div class="label_title">新闻动态</div>
    </div>
    <div class="label_content item_list">
        <ul class="" id="articlelist665">
            <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
            foreach ($lists as $value) :  ?>
                <li><a title="<?php echo $value['title'] ?>" style="color: black" href="<?php echo $value['link'] ?>">
                        <?php echo $value['title'] ?></a>
                    <span class="datetime"><?php echo date('Y-m-d', $value['intime']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <div class="label_foot"></div>
</div>
