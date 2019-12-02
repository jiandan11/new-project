<?php include '_head.php'?>

<?php $colum = getColumn(1, $_channel["sign"]); ?>
<?php include '_head2.php'?>

<style type="text/css">
    .dbgms_pagebreak{text-align: center;padding:30px 10px;height: 36px; overflow: hidden;}
    .dbgms_pagebreak a{border:1px solid #e4e4e4; font-family:"Tahoma","Arial"; font-size:14px; height:30px; line-height: 30px; padding:0 12px; margin-left: 2px; display: inline-block; overflow: hidden; background: #FFF; color:#6a6a6a}
    .dbgms_pagebreak a:hover{background:#0666c5;color:#FFF;text-decoration:none}
    .dbgms_pagebreak a.on{background:#6e2685;color:#FFF}
    .dbgms_pagebreak input.gopage{width:30px;position:relative;top:-11px;font-size:14px;height:30px;line-height:30px;margin-left:2px;display: inline-block; overflow: hidden;}
</style>


<!--Content Wrap Start-->
    <div class="ct_content_wrap">
    	<section>
        	<div class="container">
                <div class="row">
                    <!--Blog Detail Wrap Start-->
                    <div class="col-md-8">
                    	<div class="row">
                            <?php $lists = get_label_lists($colum['param']['zhtitle']);?>
                            <?php foreach ($lists['data'] as $key=>$value) : ?>
                                <div class="col-md-6 col-sm-6">
                                    <div class="ct_course_list_wrap">
                                        <figure>
                                            <img src="<?php echo $value['thumb'] ?>" alt="">
                                            <figcaption class="course_list_img_des">
                                                <div class="ct_course_review">
                                                    <span class="new_author"><i class="fa fa-user"></i>网站管理员</span>
                                                    <ul class="new-section">
                                                        <li><span class="new_author"><i class="fa fa-calendar"></i><?php echo date('Y-m-d',$value['intime']) ?></span></li>
                                                    </ul>
                                                </div>
                                                <div class="ct_zoom_effect"></div>
                                                <div class="ct_course_link">
                                                    <a href="<?php echo $value['link'] ?>">查看详情</a>
                                                </div>
                                            </figcaption>
                                        </figure>
                                        <div class="popular_course_des">
                                            <h5><a href="<?php echo $value['link'] ?>"><?php echo $value['title'] ?></a></h5>
                                            <p><?php echo empty($value['description'])?'暂无描述':$value['description'] ?></p>
                                            <div class="ct_course_meta border">
                                                <a href="<?php echo $value['link'] ?>"><i class="fa fa-angle-right"></i>查看详情</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <!--Pagination Wrap Start-->
                        <div class="ct_pagination">
                            <!--分页-->
                            <span>总共 <?php echo $lists['num'] ?> 条记录</span>
                            <?php for($i=0;$i<$lists['all_page'];$i++) : ?>
                                <span class="dbgms_pagebreak">
                                    <a href="<?php echo $_baseurl ?>zh/<?php echo $_channel['sign'] ?>?p=<?php echo $i+1 ?>" class="<?php echo $_GET['p']==$i+1?'on':'' ?>"><?php echo $i+1 ?></a>
                                </span>
                            <?php endfor; ?>
                        </div>
                        <!--Pagination Wrap End-->
                    </div>
                    <!--Blog Detail Wrap End-->
                    
                    <!--Aside Bar Wrap Start-->
                    <?php include '_right.php'; ?>
                            
                            <!--Testimonial Wrap Start 热门标签 -->
                            <?php $colum = getColumn(1, 'remenbiaoqian'); ?>
                            <div class="ct_aside_tag gt_detail_hdg">
                            	<h5><?php echo $colum['name'] ?></h5>
                                <ul>
                                    <?php foreach ($colum['list'] as $key=>$value) : ?>
                                        <li>
                                            <a href="<?php echo $value['link'] ?>?p=1"  style="<?php echo  $_channel['sign']==$value['sign']?'background-color: #90a94d':'' ?>">
                                                <span style="<?php echo  $_channel['sign']==$value['sign']?'color: white':'' ?>"><?php echo $value['name'] ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!--Testimonial Wrap Start-->
                            
                        </aside>
                    </div>
                    <!--Aside Bar Wrap End-->
                </div>
            </div>
        </section>
        
    </div>
    <!--Content Wrap End-->
    
    <!--Footer Wrap Start-->
    <?php include '_foot.php'; ?>
    <!--Footer Wrap End-->
        
</div>
<!--Wrapper End-->

    <!--Bootstrap core JavaScript-->
    <script src="<?php echo $_uiurl;?>js/jquery.js"></script>
    <script src="<?php echo $_uiurl;?>js/bootstrap.min.js"></script>
    <!--Bx-Slider JavaScript-->
	<script src="<?php echo $_uiurl;?>js/jquery.bxslider.min.js"></script>
    <!--Owl Carousel JavaScript-->
	<script src="<?php echo $_uiurl;?>js/owl.carousel.js"></script>
    <!--Time Counter Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.downCount.js"></script>
	<!--Dl Menu Script-->
	<script src="<?php echo $_uiurl;?>js/dl-menu/modernizr.custom.js"></script>
	<script src="<?php echo $_uiurl;?>js/dl-menu/jquery.dlmenu.js"></script>
    <!--Pretty Photo Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.prettyPhoto.js"></script>
    <!--Way Points Javascript-->
    <script src="<?php echo $_uiurl;?>js/waypoints-min.js"></script>
    <!--Accordian Javascript-->
    <script src="<?php echo $_uiurl;?>js/jquery.accordion.js"></script>
    <!--Custom JavaScript-->
	<script src="<?php echo $_uiurl;?>js/custom.js"></script>

  </body>
</html>
