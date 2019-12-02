<!--#######################   头部     #######################---->
<title><?php echo $_seo['title']; ?></title>
<meta name="keywords" content="<?php echo $_seo['keywords']; ?>" />
<meta name="description" content="<?php echo $_seo['description']; ?>" />

<?php echo $_uiurl ?>  <!--	ui目录加载图片js引入地址之前	-->

<?php echo $_baseurl ?>  <!--	网站首页地址	-->

<!--LOGO-->
<a href="<?php echo $_baseurl ?>">
    <img src="<?php echo DBG_FILEURL . $_site['logo'] ?>"  style="width: <?php echo empty($_site['logow']) ? 327 : $_site['logow']; ?>px;height:<?php echo empty($_site['logoh']) ? 41 : $_site['logoh']; ?>px;" alt="<?php echo $_seo['title']; ?>" />
</a>

<!--搜索-->
<div  class="search"> 
    <div class="bor-bom w1200 clearfix">
        <div class="key_left fl">
            <span>关键词搜索</span>
            <a href="<?php echo $_baseurl; ?>so?keyword=文章">文章</a>
            <a href="<?php echo $_baseurl; ?>so?keyword=关键词名称">关键词名称</a>
            <a href="<?php echo $_baseurl; ?>so?keyword=关键词名称">关键词名称</a>
            <a href="<?php echo $_baseurl; ?>so?keyword=关键词名称">关键词名称</a>
        </div>    
        <div class="sear_right fr">
            <div class="search">
                <form action="<?php echo $_baseurl; ?>so" method="get" target="_blank">
                    <input class="inpys01 keypress" id="seachkeywords" type="text" placeholder="请输入关键词"  button="#sousuo" name="keyword" class="stxt" value="请输入关键词" onfocus="if (value == '请输入关键词') {
                  value = ''
              }" onblur="if (value == '') {
                          value = '请输入关键词'
                      }">
                    <input class="inpys02" type="submit" value=" " id="sousuo" />
                </form>
            </div>
        </div>
    </div>
</div>

<!--顶部菜单-->
<div class="siteMainNav fwtop_nav fwnavlink" id="siteMainNav">
    <ul>
        <li <?php echo $_column == '' ? 'class="open"' : ""; ?>><a href="<?php echo $_baseurl; ?>">网站首页</a></li>
        <?php foreach ($_navs as $val): ?>
            <li <?php echo $val['sign'] == $_column ? 'class="open"' : ""; ?>><a href="<?php echo $val['link']; ?>"><?php echo $val['name']; ?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
</div>

<!--Banner--> 
<div class="bd" id="bd">
    <ul>
        <?php $banner = getLists(1, "model|1;state|20;row|6;");
        foreach ($banner as $val): ?>
            <img height="380" width="1002" src="<?php echo $val['slide']; ?>"  title="<?php echo $val['title']; ?>"  />
        <?php endforeach; ?>
    </ul>
</div>
<div class="hd">
    <ul>
        <?php foreach ($banner as $key => $val): ?>
            <li><?php echo ($key + 1); ?></li>
        <?php endforeach; ?>  
    </ul>
</div>

<!--#######################   头部End   ############################-->

<!--###########################  底部     ##########################-->


<div class="fwbottom_bottomInfo">
    <div class="siteBottomNav">
        <ul>
            <li> <a href="<?php echo $_baseurl; ?>" target="_blank"> 首页</a></li>
            <?php foreach ($_navs as $key => $val) : ?>
                <li><a href="<?php echo $val['link']; ?>" target="_blank"><?php echo $val['name']; ?></a></li>
<?php endforeach; ?>
            <div class="clear"></div>
        </ul>
    </div>

    <div class="bottomInfo clear">
        <p align="center" style="color: #FFFFFF;"><?php echo $_site['copyright']; ?> &nbsp;<a href="http://www.miitbeian.gov.cn/" target="_blank" style="color: #FFFFFF;" ><?php echo $_site['icp']; ?></a></p>
        <p align="center" style="color: #FFFFFF;">网站推广&nbsp;|&nbsp;网站建设&nbsp;：<strong><a href="http://www.kuaisou360.com/" target="_blank" style="color: #FFFFFF;">福州快搜网络技术有限公司</a></strong> &nbsp;建站热线：400-8851-360.</p> 
    </div>
</div>

<!--########################   底部END   ########################-->

<!--###########################   首页    #########################-->

<!--资讯列表-->
<?php $colum = getColumn(1, 'news'); ?>
<?php echo $colum['name'] ?>
<?php echo $colum['link'] ?>

<?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
foreach ($lists as $value) :  ?>
    <li><a title="<?php echo $value['title'] ?>" href="<?php echo $value['link'] ?>">
    <?php echo $value['title'] ?></a>
        <span class="datetime"><?php echo date('Y-m-d', $value['intime']); ?></span>
    </li>
<?php endforeach; ?>

<!--产品图片-->
<?php echo $value['thumb'] ?>
<!--描述-->
<?php echo $value['description'] ?>


<!--分类列表-->
  <?php foreach ($colum['list'] as $value) : ?>
    <li><a title="<?php echo $value['name'] ?>" href="<?php echo $value['link'] ?>" >
    <?php echo $value['name'] ?></a>
    </li>
<?php endforeach; ?>

<!--    关于我们    -->
<?php $aaa = getFragment(2);echo $aaa['content']; ?>


<!--友情链接-->
<?php $flink = getFlink();
foreach ($flink as $val): ?>
    <li><a href="<?php echo $val['link'] ?>" target="_blank"><?php echo $val['title'] ?></a></li>
<?php endforeach; ?> 

<!--栏目图标-->
<img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/file' . $about['icon'] ?>"/>


<!--############################     首页END    ########################################-->

<!--############################   文章列表页   #########################################-->  
<!-- 获取单签栏目的顶层栏目-->
<?php $colum = getColumn(1, 'about',true); ?>

<?php echo $colum['name'] ?>    

<?php foreach ($colum['list'] as $value) : ?>
    <h1><a href="<?php echo $value['link'] ?>"><?php echo $value['name'] ?></a></h1>
<?php endforeach; ?>

<?php echo $_channel["name"] ?>        

<?php foreach ($_list as $key => $val): ?>
    <li><a title="<?php echo $val['title']; ?>" href="<?php echo $val['link']; ?>"><?php echo $val['title']; ?></a> <span class="datetime"><?php echo date('Y-m-d', $val['intime']); ?></span></li>
<?php endforeach; ?>
<?php echo $val['description']; ?>
<!--当前位置-->
<?php echo $_navigation?>

<div class="clear holder pager249"><?php echo $_pagebreak; ?></div>


<!--############################   文章列表页END  #######################################-->   

<!--############################    文章页面   ########################################## -->

<?php echo $_content['title'] ?>
<div class="news_detail_time"><?php echo date('Y-m-d', $_content['intime']); ?></div>
<div class="news_detail_from">来源:<?php echo $_content['source'] ?></div>
<div class="news_detail_tool">点击数:&nbsp;<?php echo $_content['hits'] ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者:<?php echo $_content['username'] ?></div>
<div class="clear"></div>

<?php echo $_content['content'] ?>


<li class='preinfo'>
    <a href="<?php echo $_prev['link'] ?>">
        <p class='pret'>上一条</p>
        <p class='pres'><?php echo $_prev['title'] ?></p>
    </a>
</li>
<li class='nextinfo'><a href="<?php echo $_next['link'] ?>">
        <p class='pret'>下一条</p>
        <p class='pres'><?php echo $_next['title'] ?></p>
    </a></li>

<?php foreach ($_channel["list"] as $key => $val): ?>
    <li><a class="hide" href="<?php echo $val['link']; ?>"> <?php echo $val['name']; ?></a></li>
<?php endforeach; ?>

<!--#######################  文章页面END   ################################-->         
<!--#########################   产品列表页   ####################################-->
<?php echo $_channel["name"] ?>

<?php foreach ($_list as $val): ?>
    <li>
        <a title="<?php echo $val['title'] ?>" href="<?php echo $val['link'] ?>"><img src="<?php echo $val['thumb'] ?>" style='width: 150px; height: 130px;' alt="<?php echo $val['title'] ?>"/>
            <p class="title"><?php echo $val['title'] ?></p></a>
    </li>
<?php endforeach; ?>

<div class="clear holder pager249"><?php echo $_pagebreak; ?></div>


<!--#########################   产品列表页END   ###################################-->

<!--############################    产品详情页    ####################################-->
<?php echo $_content['thumb']; ?>

<div class="product_info2">
    <div class="product_name2"><?php echo $_content['title']; ?></div>
    <div class="product_summary">
        <ul>
            <li><span>点击数:</span><span><?php echo $_content['hits']; ?></span></li>
            <li><span>产品类别:</span><span><?php echo $_content['columnname']; ?></span></li>
            <li><span>产品描述:</span><span><?php echo $_site['description'] ?></span></li>
        </ul>
    </div>
</div>

<div class="productContent_other">
    <div class="prev-product"> <a href='<?php echo $_prev['link'] ?>'>&nbsp;[←]&nbsp;<?php echo $_prev['title'] ?></a></div>
    <div class="next-product"> <a href='<?php echo $_next['link'] ?>'>&nbsp;[→]&nbsp;<?php echo $_next['title'] ?></a></div>
</div>

<?php echo $_content['content'] ?>
<!--############################    产品详情页END    ####################################-->
<?php echo $_content['thumb']; ?>


<!--  产品详情页    -->

<!--   上一个下一个   -->
<div class="productContent_other">
    <div class="prev-product">
        <a href='<?php echo $_prev['link'] ?>'>&nbsp;[←]&nbsp;<?php echo $_prev['title'] ?></a>
    </div>

    <div class="next-product">
        <a href='<?php echo $_next['link'] ?>'>&nbsp;[→]&nbsp;<?php echo $_next['title'] ?></a>
    </div>
</div>



<!--banner end-->
