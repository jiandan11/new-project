
                    <!--Aside Bar Wrap Start-->
                    <div class="col-md-4">
                        <aside class="gt_aside_outer_wrap">
                        	<!--Search Bar Wrap Start-->
                            <div class="gt_aside_search_wrap aside_margin_bottom">
                                <div  class="search">
                                    <div class="bor-bom w1200 clearfix">
                                        <div class="sear_right fr">
                                            <div class="search">
                                                <form action="<?php echo $_baseurl; ?>so" method="get" target="_blank">
                                                    <input class="inpys01 keypress" id="seachkeywords" type="text" placeholder="请输入关键词"  button="#sousuo" name="keyword" class="stxt" value="请输入关键词" onfocus="if (value == '请输入关键词') {
                  value = ''
              }" onblur="if (value == '') {
                          value = '请输入关键词'
                      }">
                                                    <button class="fa fa-search" ype="submit" value=" " id="sousuo"></button>
<!--                                                    <input class="fa fa-search" type="submit" value=" " id="sousuo" />-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Search Bar Wrap Start-->
                            
                            <!--Category Wrap Start-->
                            <div class="gt_aside_category gt_detail_hdg aside_margin_bottom">
                            	<h5>推荐文章</h5>
                                <ul>
                                    <?php $lists = get_label_lists(7,8);?>
                                    <?php foreach ($lists['data'] as $key=>$val): ?>
                                        <li><a href=<?php echo $_baseurl ?>zh/sheji/<?php echo $val['id'] ?>.html  ><?php echo $val['title'] ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!--Category Wrap Start-->
                            
                            <!--Recent News Wrap Start-->
                            <div class="ct_popular_course gt_detail_hdg aside_margin_bottom">
                            	<h5>热门服务</h5>
                                <ul>
                                    <?php $lists = get_label_lists(8,10);?>
                                    <?php foreach ($lists['data'] as $key=>$val): ?>
                                        <li>
                                            <figure>
                                                <img src="<?php echo $val['thumb'] ?>" alt="">
                                            </figure>
                                            <div class="ct_proj_des">
                                                <a href="<?php echo $_baseurl ?>zh/sheji/<?php echo $val['id'] ?>.html >"><?php echo $val['title'] ?></a>
                                                <span>客户评分</span>
                                                <ul>
                                                    <li>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                        <a href="#"><i class="fa fa-star"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!--Recent News Wrap Start-->
                            
                            <!--Testimonial Wrap Start-->
                            
                            <!--Testimonial Wrap Start-->


