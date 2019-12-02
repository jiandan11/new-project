
    <div class="copyright hidden-md hidden-xs">
    	<div class="container" style="width: 1400px;">
    		<div class="row">
    			<div class="copy-left">
    				<img src="<?php echo $_uiurl;?>images/dilogo.png" tppabs="<?php echo $_uiurl;?>images/dilogo.png"  />
    				<p><i class="iconfont">&#xe603;</i>0591-123456789</p>
    				<p style="font-size: 13px;">周一至周五9:00-21:00</p>
    				<a href="" class="kf">在线客服</a>
    			</div>
    			<ul class="copy-mid">
                    <?php foreach ($_navs as $key=>$val):?>
                        <li <?php echo $val['sign']==$_column?'class="active"':"";?>>
                            <h2><?php echo $val['name'];?></h2>
                            <?php if(!empty($val['list'])):?>
                                <!-- 二级栏目 -->
                                <dl>
                                    <?php foreach ($val['list'] as $val2):?>
                                        <dt><a href="<?php echo $val2['link'];?>"><?php echo $val2['name'];?></a></dt>
                                    <?php endforeach;?>
                                </dl>
                            <?php endif;?>
                        </li>
                    <?php endforeach;?>
    			</ul>
    			<div class="copy-right">
    				<p>微信号</p>
    				<img src="<?php echo $_uiurl;?>images/weixin.png" tppabs="images/weixin.png"  />
    			</div>
    		</div>
    	</div>
    </div>
	<div class="weburl"><a href="http://moban.kuaisou360.com:68/pc/">kuaisou360.com 福州快搜技术支持</a></div>
    <div class="copy  hidden-md hidden-xs">信息科技有限公司版权所有 &nbsp; &nbsp; &nbsp; &nbsp; ICP备案号：闽ICP备字123456号</div>
    <div class="copy hidden-lg">
    	<p><?php echo $_site['copyright'] ?></p>
    	<p><?php echo $_site['icp']; ?></p>
    </div>
    	<script src="<?php echo $_uiurl;?>js/jquery.min.js" tppabs="js/jquery.min.js"  type="text/javascript"></script>
		<script src="<?php echo $_uiurl;?>js/bootstrap.min.js" tppabs="js/bootstrap.min.js"  type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>js/hover-dropdown.js" tppabs="js/hover-dropdown.js" ></script>
		<script type="text/javascript" src="<?php echo $_uiurl;?>js/jquery.bxslider.js" tppabs="js/jquery.bxslider.js" ></script>
	    <script src="<?php echo $_uiurl;?>js/common-scripts.js" tppabs="js/common-scripts.js" ></script>
	</body>
</html>
