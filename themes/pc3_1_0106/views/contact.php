<?php include "_head.php"?>

            <?php $colum = getColumn(1, 'contact'); ?>
            <?php include "_head2.php"?>


			<div class="page-container" id="innerpage-wrap">
				<div class="container">
					<div class="row">
						<div class="main col-md-9 inner-left" role="main">
							<div class="about-page-wrap">
								<div class="com-cnt page-content">某某智能玩具有限公司<br />
									<p><?php echo $colum['content']['content'] ?></p>
									<div id="pages" class="page"></div>
								</div>
								<div id="contact-wrap">
									<h3 class="msg-title">给我们留言</h3>

                                    <?php echo getformhtml(3); ?>

									<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.form.js"></script>
									<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.artdialog.js"></script>
									<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/iframetools.js"></script>
								</div>
							</div>
						</div>

                        <!--     右侧      -->
                        <?php include '_right.php'?>
					</div>
				</div>
			</div>
			<div class="for-bottom-padding"></div>


            <?php include '_foot.php'?>