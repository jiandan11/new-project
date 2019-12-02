<div class="fwbottom" style="position:relative;height:196px;width:100%;min-height:30px;" rel="6">
    <div class="edit_putHere  tLan" rel="76" id="76" saveTitle="area76" style="height:180px;z-index:auto;top:16px;position:absolute;background-color:#22282d; ">
        <div class="label advertising" id="77" rel="77" titles="文字"  usestate="1" style='width:481px;height:79px;z-index:100;left:2.5px;top:65px;position:absolute;margin-left:0px;'>
            <div class="label_content advContent text77">
                <p> <span style="font-size:14px;font-family:'Microsoft YaHei';color:#FFFFFF;line-height:2;"> <?php echo $_site['copyright'].$_site['icp']; ?></span> </p>
                <p> <span style="font-size:14px;font-family:'Microsoft YaHei';color:#FFFFFF;line-height:2;"> 版权所有 &copy; <?php echo $_site['title']; ?> 未经许可 严禁复制</span> </p>
            </div>
        </div>
        <script type="text/javascript">$(function(){tlancv('77','2.5')});</script>
        <div class="label advertising" id="78" rel="78" titles="文字"  usestate="1" style='width:467px;height:154px;z-index:100;left:600.5px;top:5px;position:absolute;margin-left:0px;'>
            <div class="label_content advContent text78">
                <!--  碎片  -->
                <span style="font-size:14px;line-height:2;font-family:'Microsoft YaHei';color:#FFFFFF;">
                    <?php $aaa = getFragment(3);echo $aaa['content']; ?>
                </span>
            </div>
        </div>
        <script type="text/javascript">$(function(){tlancv('78','600.5')});</script>
        <div class="label " id="79" rel="79" titles="导航菜单"  usestate="1" style='width:714px;height:50px;z-index:100;left:-20.5px;top:15px;position:absolute;margin-left:0px;' DH="0">
            <ul class="navBarUlStyle navBarUlStyle79" style="border-radius:0px; -moz-border-radius:0px; -webkit-border-radius:0px;font-family:Microsoft YaHei;display:table-cell;vertical-align:middle;">
                <li style="width:100px;height:28px;line-height:28px;border-radius:0px; -moz-border-radius:0px; -webkit-border-radius:0px;float:left;display:inline-block;text-align:center;" class="<?php  echo $_column==''?'m on':'m';?> ">
                    <a class="" style="font-size:14px;font-weight:normal;font-style:normal;text-decoration:none;width:100px;height:90px;display:block;"  bid="553"  href="<?php echo $_baseurl;?>">首页</a>
                </li>
                <?php foreach ($_navs as $key=>$val):?>
                    <li style="width:100px;height:28px;line-height:28px;border-radius:0px; -moz-border-radius:0px; -webkit-border-radius:0px;float:left;display:inline-block;text-align:center;" class="<?php  echo $_column==$val['sign']?'m on':'m';?> ">
                        <a class="" style="font-size:14px;font-weight:normal;font-style:normal;text-decoration:none;width:100px;height:90px;display:block;"    href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
                    </li>
                <?php endforeach;?>
            </ul>
            <div class="clear"></div>
        </div>
        <style type="text/css">
            .navBarUlStyle79 li{;;}
            .navBarUlStyle79 .on{;;}
            .navBarUlStyle79 .on a{color:#f7be00;}
            .navBarUlStyle79 li a{color:#ffffff;;}
            .navBarUlStyle79 li a:hover{color:#f7be00;}
        </style>
        <script type="text/javascript">$(function(){tlancv('79','-20.5')});</script>
        <div class="label advertising " id="80" rel="80" titles="图片"  usestate="1" style='width:100px;height:100px;z-index:100;left:1043px;top:18px;position:absolute;margin-left:0px;'>
            <div class="advContent picture80">
                <img width="100%" height="100%" src="<?php echo $_uiurl;?>images/lALOURaf1M0BGM0BGA_280_280_png_620x10000q90.jpg" alt=""/>
            </div>
        </div>
        <script type="text/javascript">$(function(){tlancv('80','1043')});</script>
        <div class="label advertising" id="81" rel="81" titles="文字"  usestate="1" style='width:119px;height:46px;z-index:100;left:1037.5px;top:118px;position:absolute;margin-left:0px;'>
            <div class="label_content advContent text81">
                <p style="text-align:center;"> <span style="color:#CCCCCC;font-size:14px;font-family:'Microsoft YaHei';">关注官方微信</span> </p>
            </div>
        </div>
        <script type="text/javascript">
            $(function(){tlancv('81','1037.5')});
        </script>
    </div>
</div>
<!--------右侧工具条BEGIN-------------->

<!--QQ-->

<input type="hidden" value="1" id="itemLanguage" />
<input type="hidden" value="" id="timeSessionMashine"  destroy="no"/>
<script>
    /*******内容页计算fwmain高度*****/
    window.onload=function(){
        calcFwmainHeight("fwmain");
    }
    //修改于2017.1.6 vigro
    function calcFwmainHeight(className){
        var $maxTop = 0;
        $area=$('.'+className+' .edit_putHere');
        if($area.length>0){
            $area.each(function(index, el){
                var $currTop=0;
                $currTop = $(el).position().top + $(el).height();
                if($currTop > $maxTop){
                    $maxTop = $currTop;
                }
            })
        }
        $label = $('.' + className + ' .label');
        if($label.length > 0){
            $label.each(function(index, el) {
                var $currTop = 0;
                if($(this).hasClass("calcFwmainHeight")){
                    $(this).css("height","");
                }
                if ($(this).parent().hasClass("edit_putHere")){
                    if(($(this).position().top + $(this).parent().position().top + $(this).height())<($(this).parent().position().top+$(this).parent().height())){
                        $currTop = $(this).parent().position().top+$(this).parent().height();
                    }else
                    {
                        $currTop =$(this).position().top + $(this).parent().position().top + $(this).height();
                    }
                    var topSum = $(this).position().top + $(this).height();
                    //修改于2016.7.13  vigro
                    if($(this).hasClass("calcFwmainHeight")){	//如果是产品标签
                        var $caltop=$(this).position().top;		//获取产品标签的高度
                        var $calleft=$(this).position().left;
                        var $calwid=$(this).width();
                        $(this).parent().children().each(		//针对于每个产品标签的父类的子类所有的元素进行遍历
                            function(){
                                if(this.nodeName=='DIV' && !$(this).hasClass('calcFwmainHeight')){	//如果遍历的元素的节点name是div并且不是产品类标签
                                    if($(this).position().top>$caltop){						//在它的高度没有产品高度大的时候，
                                        if(($(this).position().left+$(this).width())>$calleft && $(this).position().left<($calleft+$calwid)){
                                            $(this).css("top",topSum);
                                        }
                                    }	//将他的高度调整到最底下
                                }
                            }
                        )
                        $(this).parent().css("height",topSum);
                    }
                }
                else
                {
                    $currTop = $(this).position().top + $(this).height();
                }
                if($currTop > $maxTop){
                    $maxTop = $currTop;
                }
            });
        }
        var result = Math.ceil($maxTop);
        $("." + className).height(result + "px");
    }
    $(function(){
        $('a').on('click',function(){
            if($(this).hasClass('isVisitor')){
                layer.alert('抱歉，游客没有权限！');
                return false;
            }
            else
            {
                return true;
            }
        })
    });
</script>
</body>
</html>