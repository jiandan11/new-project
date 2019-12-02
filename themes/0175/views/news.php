<?php include 'header.php';?>

<?php include 'left1.php';?>

<?php include 'left2.php';?>

<?php include 'left3.php';?>

    </div>
    <div class="fwmain_nright edit_putHere" id="edit_putHere_area2" saveTitle="area2">
        <div class="label clear" id="608" rel="608" titles="文章列表">
            <div class="label_head">
                <div class="label_title"><?php echo $_channel["name"] ?></div>
            </div>
            <div class="label_content">
                <!--当前位置-->
                <?php echo $_navigation?>
                <div class="item_list id608">
                    <?php echo $_content['content'] ?>
                </div>
            </div>
            <div class="label_foot"></div>
        </div>
    </div>
    <div class="clear"></div>
    </div>

<?php include 'foot.php';?>