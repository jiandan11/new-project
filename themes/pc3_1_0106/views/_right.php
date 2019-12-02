
<!--     右侧      -->
<aside class="sidebar col-md-3 inner-right" role="complementary">
    <section class="widget side-search">
        <h3 class="title">站内搜索</h3>
        <form action="<?php echo $_baseurl; ?>so" method="get" target="_blank">
            <input class="inpys01 keypress" id="seachkeywords" type="text" placeholder="请输入关键词"  button="#sousuo" name="keyword" class="stxt" value="请输入关键词" onfocus="if (value == '请输入关键词') {
                  value = ''
              }" onblur="if (value == '') {
                          value = '请输入关键词'
                      }">
            <button class="search-btn" ype="submit" value=" " id="sousuo"><i class="fa fa-search"></i></button>
        </form>
    </section>
    <section class="widget widget-category side-contact">
        <h3 class="title">联系信息</h3>
        <div class="s-contact"> <?php $aaa = getFragment(3);echo $aaa['content']; ?></div>
    </section>

    <?php $colum = getColumn(1, 'news'); ?>
    <section class="widget side-news">
        <h3 class="title">热点新闻</h3>
        <div class="tabbed custom-tabbed">
            <div class="block current">
                <ul class="widget-list">
                    <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6");
                    foreach ($lists as $key=>$value) : ?>
                    <li>
                        <figure>
                            <a href="javascript:;"><img src="<?php echo $value['thumb'] ?>" /></a>
                        </figure>
                        <div class="sn-wrapper">
                            <p class="s-desc">
                                <a href="<?php echo $value['link'] ?>" title="<?php echo $value['title'] ?>"><?php echo $value['title'] ?></a>
                            </p>
                            <span class="comments"><i class="fa fa-calendar"></i> &nbsp;<?php echo date('Y-m-d',$value['intime']); ?></span> </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
</aside>



