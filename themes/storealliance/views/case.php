<?php include '_header.php' ?>

<!--banner-->
<section class="casebanner">
     <img class="pimg" src="<?php echo $_uiurl;?>images/case.jpg" alt="">
    <img class="mimg" src="<?php echo $_uiurl;?>images/mcase.jpg" alt="">
</section>

<!--分类标题-->
<section>
    <div class="safe">
        <ul class="casetitle clear">
            <li><a class="casetitleon" href="/zh/product/">全部</a></li>
            <?php $colum = getColumn(1,'product',true); ?>

        <?php foreach ($colum['list'] as $value) : ?>
            <li><a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" ><?php echo $value['name'] ?></a>
            </li>
        <?php endforeach; ?>
          
        </ul>
        <div style="font-size: 0.24rem;padding-top: 20px">
       
        <?php echo $_navigation?>
         <hr>
        </div>
        <div class="casecontent clear">
        <?php foreach ($_list as $value):?>
            
            <div class="goods">
                <div><img src="<?php echo $value['slide']?>" alt=""></div>
                <div class="caption"><span><?php echo $value['title']?></span></div>
            </div>
          
            <?php endforeach;?>
        
        </div>
        <div class="casepage">
            <div class="clear">
            <?php echo $_pagebreak;?>
           </div>
        </div>
    </div>
</section>

<?php include '_footer.php' ?>
