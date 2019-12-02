<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"]); ?>
<?php include "_head2.php"?>

			<div class="page-container" id="innerpage-wrap">
				<div class="container">
					<div class="row">
						<div class="main col-md-9 inner-left" role="main">
							<div class="prolist-wrap">
								<div id="portfolio-container">
									<div class="row portfolio-3-columns isotope-x clearfix">

                                        <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|1000");
                                        foreach ($lists as $key=>$value) : ?>
										<div class="portfolio-item isotope-item col-sm-4 col-xs-6">
											<article>
												<figure class="glass-animation">
													<a class="swipebox" href="<?php echo $value['thumb'] ?>">
                                                        <span class="background"></span>
                                                        <span class="glass"><span class="circle"><i class="handle"></i></span></span>
                                                        <img class="img-responsive" src="<?php echo $value['thumb'] ?>" alt="<?php echo $value['title'] ?>" />
                                                    </a>
												</figure>
												<h5 class="item-title"> <a href="javascript:;" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a> </h5>
												<div class="flex separator"> <span class="line"></span> <span class="wrap"><span class="square"></span></span>
												</div>
											</article>
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