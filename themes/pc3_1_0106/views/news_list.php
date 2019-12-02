<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"]); ?>
<?php include "_head2.php"?>
<style type="text/css">
    .entry-content p{
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>

			<div class="page-container" id="innerpage-wrap">
				<div class="container">
					<div class="row">
						<div class="main col-md-9 inner-left" role="main">
							<article class="blog-wrap">
                                <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|1000");
                                foreach ($lists as $key=>$value) : ?>
								<div class="blog-article hentry format-image">
									<figure>
										<a class="swipebox-x" href="<?php echo $value['link']?>"> <img class="img-responsive" alt="<?php echo $value['title']?>" src="<?php echo $value['thumb']?>" /> </a>
									</figure>
									<div class="entry-summary post-summary">
										<header class="entry-header">
											<h2 class="entry-title post-title"> <a href="<?php echo $value['link']?>" title="<?php echo $value['title']?>"><?php echo $value['title']?></a> </h2>
										</header>
										<div class="entry-meta post-meta">
											<ul>
												<li class="entry-date date">
													<time class="entry-date" datetime="<?php echo date('Y-m-d',$value['intime']) ?>"><?php echo date('Y-m-d',$value['intime']) ?></time>
												</li>
												<li class="tags">
													<a href="javascript:;"><?php echo $colum['name']?></a>
												</li>
												<li class="byline author vcard">by
													<a href="javascript:;" class="fn"><?php echo empty($value['authorid'])?'暂无作者':$value['authorid'] ?></a>
												</li>
											</ul>
										</div>
										<div class="entry-content" >
                                                <?php echo $value['content']?>
										</div>
										<a href="<?php echo $value['link']?>" class="read-more-link">查看详细</a>
									</div>
								</div>
                                <?php endforeach; ?>
							</article>
							<div class="pagination-wrap">
								<div id="pages">
									<div class="page">
                                        <!--分页-->
                                        <?php echo $_pagebreak; ?>
									</div>
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

