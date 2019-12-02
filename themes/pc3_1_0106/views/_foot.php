<?php $colum = getColumn(1, 'about'); ?>
			<footer id="footer-sec">
				<div class="container">
					<div class="footer-widgets">
						<div class="row">
							<div class="col-md-3 col-sm-12 foot-about">
								<div class="widgets">
									<h2 class="dark-title"><a href="javascript:;">关于我们</a> </h2>
									<div class="f-about">
                                        <?php echo $colum['content']?>
                                    </div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 hidden-sm hidden-xs foot-nav">
								<div class="widgets">
									<h2>站内链接</h2>
									<ul class="tag-list">
										<li>
											<a href="<?php echo $_baseurl;?>">网站首页</a>
										</li>

                                        <?php foreach ($_navs as $key=>$val):?>
                                            <li class="Lev1">
                                                <a href="<?php echo $val['link'];?>" >
                                                    <?php echo $val['name'];?>
                                                </a>
                                            </li>
                                        <?php endforeach;?>
									</ul>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 hidden-sm hidden-xs foot-contact">
                                <?php $colum = getColumn(1, 'contact'); ?>
								<div class="widgets">
									<h2 class="dark-title"><a href="<?php echo $colum['link'] ?>">联系我们</a> </h2>
									<div class="f-contact">
                                        <!--  碎片  -->
                                        <?php $aaa = getFragment(3);echo $aaa['content']; ?>
									</div>
								</div>
							</div>
							<div class="col-md-3 col-sm-6 hidden-sm hidden-xs foot-qrcode">
								<div class="widgets info-widget">
									<h2>扫描二维码</h2>
									<div class="f-qrcode"> <img src="<?php echo $_uiurl;?>skin/images/qrcode.png" /> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="last-line">
					<div class="container">
					<div class="weburl"><a href="<?php echo $_baseurl ?>"><?php echo $_site['title']; ?></a></div>
						<p class="copyright"> <?php echo $_site['copyright'].$_site['icp']; ?></p>
					</div>
				</div>
			</footer>
		</div>
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.migrate.js"></script>
		<!--<script type="text/javascript" src="skin/js/jquery.bxslider.min.js"></script>-->
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.imagesloaded.min.js"></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/retina-1.1.0.min.js"></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.themepunch.tools.min.js"></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.themepunch.revolution.min.js"></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/script.js"></script>

        <!--   移动端样式   -->
		<nav id="mmenu" class="noDis">
			<div class="mmDiv">
				<div class="MMhead">
					<a href="#mm-0" class="closemenu noblock">X</a>
					<a href="javascript:;" target="_blank" class="noblock"><i class="fa fa-weibo"></i></a>
					<a href="javascript:;" target="_blank" class="noblock"><i class="fa fa-tencent-weibo"></i></a>
					<!--<a href="javascript:;" target="_blank" class="noblock">English</a>-->
				</div>
<!--				<div class="mm-search">-->
<!--					<form class="mm-search-form" name="formsearch" action="javascript:;">-->
<!--						<input type="hidden" name="kwtype" value="0" />-->
<!--						<input type="text" autocomplete="off" value="" name="q" class="side-mm-keyword" placeholder="输入关键字..." />-->
<!--					</form>-->
<!--				</div>-->
				<ul>
					<li class="m-Lev1 m-nav_0">
                        <a href="<?php echo $_baseurl;?>" class="<?php echo $_column==''?'active menu1':'menu1'; ?>" >网站首页 </a>
					</li>

                    <?php foreach ($_navs as $key=>$val):?>
                        <li class="m-Lev1 m-nav_4">
                            <a href="<?php echo $val['link'];?>" class="m-menu1">
                                <?php echo $val['name'];?>
                                <?php if(!empty($val['list'])):?>
                                    <i class="fa fa-caret-down"></i>
                                <?php endif;?>
                            </a>
                            <?php if(!empty($val['list'])):?>
                                <!-- 二级栏目 -->
                                <ul class="m-submenu">
                                    <?php foreach ($val['list'] as $val2):?>
                                        <li class="Lev2"><a href="<?php echo $val2['link'];?>" class="m-menu2"><?php echo $val2['name'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        </li>
                    <?php endforeach;?>

				</ul>
			</div>
		</nav>
		<link type="text/css" rel="stylesheet" href="<?php echo $_uiurl;?>skin/css/jquery.mmenu.all.css" />
		<script type="text/javascript" src="<?php echo $_uiurl;?>skin/js/jquery.mmenu.all.min.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var mmenu = $('nav#mmenu').mmenu({
					slidingSubmenus: true,
					classes: 'mm-white', //mm-fullscreen mm-light
					extensions: ["theme-white"],
					offCanvas: {
						position: "right", //left, top, right, bottom
						zposition: "front" //back, front,next
						//modal		: true
					},
					searchfield: false,
					counters: false,
					//navbars		: {
					//content : [ "prev", "title", "next" ]
					//},
					navbar: {
						title: "网站导航"
					},
					header: {
						add: true,
						update: true,
						title: "网站导航"
					}
				});
				$(".closemenu").click(function() {
					var mmenuAPI = $("#mmenu").data("mmenu");
					mmenuAPI.close();
				});
			});
		</script>
	</body>

</html>