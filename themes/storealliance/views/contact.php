<?php include '_header.php' ?>

<!--banner-->
<section class="contactbanner">
    <img class="pimg" src="<?php echo $_uiurl;?>images/contact.jpg" alt="">
    <img class="mimg" src="<?php echo $_uiurl;?>images/mcontact.jpg" alt="">
</section>

<!--主体-->
<section class="contactcontent">
     <div class="safe">
	<?php echo $_content['content']?>
    </div>
</section>


<?php include '_footer.php' ?>