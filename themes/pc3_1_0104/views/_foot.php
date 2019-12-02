
    <!--Footer Wrap Start-->
    <footer>
        <!--Footer Col Wrap Start-->
        <div class="ct_footer_bg">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-3 col-sm-6">
                    	<div class="footer_col_1 widget">
                        	<a href="#"><img src="images/logo.png" alt=""></a>
                            <p><?php echo $_site['description']; ?></p>
                            <span><?php $aaa = getFragment(6);echo $aaa['content']; ?></span>
                            <div class="foo_get_qoute">
                            	<a href="#">联系我们</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                    	<div class="foo_col_2 widget">
                        	<h5>关注我们</h5>
                            <img src="<?php echo $_uiurl;?>images/gw.jpg" />
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-sm-6">
                    	<div class="foo_col_2 widget">
                        	<h5>快速通道</h5>
                            <ul>
                                <?php foreach ($_navs as $key=>$val):?>
                                    <li><a href="<?php echo $val['link'];?>" ><?php echo $val['name'];?></a></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                    	<div class="foo_col_4 widget">
                        	<h5>联系方式</h5>
                            <div>
                                <?php $aaa = getFragment(3);echo $aaa['content']; ?>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!--Footer Col Wrap End-->
		
		<div class="weburl"><a href="<?php echo $_baseurl ?>"><?php echo $_site['title']; ?></a></div>
        
        <!--Footer Copyright Wrap Start-->
        <div class="ct_copyright_bg">
        	<div class="container">
            	<div class="row">
                	<div class="col-md-12">
                    	<div class="copyright_text text-center">
                            <?php echo $_site['copyright'].$_site['icp']; ?>
                        </div>
                  </div>
                </div>
            </div>
        </div>
        <!--Footer Copyright Wrap End-->
        <div class="back_to_top">
            <a href="#"><i class="fa fa-angle-up"></i></a>
        </div>
    </footer>
    <!--Footer Wrap End-->

