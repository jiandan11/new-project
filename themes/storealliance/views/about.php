<?php include '_header.php' ?>

<!--banner-->
<section class="aboutbanner">
    <img class="pimg" src="<?php echo $_uiurl;?>images/about.jpg" alt="">
    <img class="mimg" src="<?php echo $_uiurl;?>images/mabout.jpg" alt="">
</section>

<!--主体-->
<section class="aboutcontent">
    <div class="safe">
	<?php echo $_content['content']?>
    </div>
</section>


<?php include '_footer.php' ?>
