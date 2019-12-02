<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"]); ?>
<?php include "_head2.php"?>
			<div class="page-container" id="innerpage-wrap">
				<div class="container">
					<div class="row">
						<div class="main col-md-9 inner-left" role="main">
							<div class="blog-post blog-post-wrap">
								<h3 class="text-center bp-title"><?php echo $_content['title']; ?></h3>
								<small class="text-center bp-desc"><i class="fa fa-tag"></i> &nbsp;<a href="javascript:;"><?php echo $colum['name']; ?></a> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i> &nbsp;<?php echo date('Y-m-d',$_content['intime']); ?></small>
								<div class="com-cnt page-content bp-content">
									<div>
                                        <?php echo $_content['content'] ?>
                                    </div>
									<div id="pages" class="page"></div>
								</div>
							</div>
							<script language="JavaScript" src="<?php echo $_uiurl;?>skin/js/index.js"></script>
						</div>
                        <!--     右侧      -->
                        <?php include '_right.php'?>
					</div>
				</div>
			</div>
			<div class="for-bottom-padding"></div>
<?php include '_foot.php'?>