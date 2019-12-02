<?php include '_head.php'?>

        <?php $colum = getColumn(1, $_channel["sign"]); ?>
        <?php include "_head2.php"?>
			<div class="page-container" id="innerpage-wrap">
				<div class="container">
					<div class="row">
						<div class="main col-md-9 inner-left" role="main">
							<div class="about-page-wrap">
								<div class="com-cnt page-content">
									<p><?php echo $colum['content']['content'] ?></p>
									<div id="pages" class="page"></div>
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
