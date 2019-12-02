<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"]); ?>
<?php include "_head2.php"?>


			<div class="page-container" id="innerpage-wrap">
				<div class="container">
					<div class="row">
						<div class="main col-md-9 inner-left" role="main">
							<div class="our-work picture-wrap">
								<div id="gallery-container">
									<div class="row gallery-3-columns isotope-x clearfix">
                                        <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|1000");
                                        foreach ($lists as $key=>$value) : ?>
										<div class="gallery-item isotope-item print-media col-lg-4 col-sm-4 col-xs-6">
											<div class="inner-contents">
												<figure>
													<a class="gallery-btn swipebox" href="<?php echo $value['thumb'] ?>">查看更多</a>
													<div class="media-container"></div>
													<img src="<?php echo $value['thumb'] ?>" alt="<?php echo $value['title'] ?>" /> </figure>
												<h5 class="item-title"><a href="javascript:;" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a></h5>
											</div>
										</div>
                                        <?php endforeach; ?>
									</div>
									<div id="pages" class="page">
                                        <!--分页-->
                                        <?php echo $_pagebreak; ?>
									</div>
								</div>
							</div>
							<link href="<?php echo $_uiurl;?>skin/css/swipebox.css" rel="stylesheet" media="all" />
							<script src="<?php echo $_uiurl;?>skin/js/jquery.swipebox.js"></script>
							<script type="text/javascript">
								jQuery(document).ready(function($) {
									$(".swipebox").swipebox();
								});
							</script>
						</div>
                        <!--     右侧      -->
                        <?php include '_right.php'?>
					</div>
				</div>
			</div>
			<div class="for-bottom-padding"></div>
<?php include '_foot.php'?>