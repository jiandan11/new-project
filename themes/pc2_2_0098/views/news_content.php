<?php include '_head.php' ?>

<?php $colum = getColumn(1, 'news'); ?>

<div class="fwmain" style="position:relative;height:400px;min-height:10px;position:relative;" rel="19">
  <div class="edit_putHere  block_area" rel="240" id="240" saveTitle="area240" style="width:260px;height:400px;z-index:102;left:0px;top:0px;position:absolute; ">
    <div class="label advertising" id="241" rel="241" titles="文字"  usestate="1" style='width:260px;height:57px;z-index:100;left:0px;top:15px;position:absolute;background-color:#efbc0c;margin-left:0px;'>
      <div class="label_content advContent text241">
        <blockquote style="margin:0 0 0 10px;border:none;padding:0px;"> <span style="font-size:18px;font-family:'Microsoft YaHei';color:#000000;line-height:2;"><?php echo $colum['name'] ?></span> </blockquote>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('241','0')});</script>
    <div class="label clear sxdh242" id="242" rel="242" titles="竖形导航"   usestate="1" style='width:260px;height:110px;z-index:100;left:0px;top:72px;position:absolute;margin-left:0px;'>
    <script>
        $('#242').css('height','auto');
    </script>
      <div class="label_content verticalNav242">
          <?php foreach ($colum['list'] as $value) : ?>
              <div onmouseout="yczcd(this)" onmouseover="xszcd(this)" >
                  <h1 class="sxdh1">
                      <a style="<?php echo $value['sign']==$_column?'color:#efbc0c;font-size:14px;font-family:SimSun;':'font-size:14px;font-family:SimSun;';?>"  href="<?php echo $value['link'] ?>"><?php echo $value['name'] ?></a>
                  </h1>
                  <?php if(!empty($value['list'])):?>
                      <!-- 二级栏目 -->
                      <div style="display: none">
                          <?php foreach ($value['list'] as $val):?>
                              <h1 class="sxdh1 zcd">
                                  <a style="font-size:14px;font-family:SimSun;" href="<?php echo $val['link'];?>"><?php echo $val['name'];?></a>
                              </h1>
                          <?php endforeach;?>
                      </div>
                  <?php endif;?>
              </div>
          <?php endforeach; ?>
      </div>
      <div class="label_foot"></div>
    </div>
    <style type="text/css">
        .verticalNav242{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}
        .verticalNav242 h1,.verticalNav242 h2,.verticalNav242 li{font-weight:normal;}
        .verticalNav242 h1{width:260px;height:54px;background-color:#f2f2f2;border-bottom:1px solid #e5e5e5;}
        .verticalNav242 h2{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
        .verticalNav242 li{width:260px;height:54px;margin-left:px;background-color:#f2f2f2;border:1px solid #e5e5e5;}
        .verticalNav242 h1 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav242 h2 a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav242 li a{display:inline-block;width:100%;padding-left:20px;line-height:54px;color:#000;text-align:left;}
        .verticalNav242 .selectCheck a,.verticalNav242 h1 a:hover,.verticalNav242 h2 a:hover,.verticalNav242 li a:hover{font-weight:normal;color:#efbc0c;text-align:left;}
        .verticalNav242 .selectCheck,.verticalNav242 h1:hover,.verticalNav242 h2:hover,.verticalNav242 li:hover{}
    </style>
    <script type="text/javascript">
        $(function(){tlancv('242','0')});
    </script>
  </div>
  <div class="edit_putHere  block_area" rel="259" id="259" saveTitle="area259" style="width:932px;height:71px;z-index:101;left:268px;top:0px;position:absolute;border-bottom:1px solid #efbc0c; ">
    <div class="label breadcrumbNavigation" id="260" rel="260" titles="面包屑导航"  usestate="1" style='width:918px;height:26px;z-index:100;left:9px;top:41px;position:absolute;margin-left:0px;'>
      <div class="location_nav location_nav260" style="float:right;">
          <?php echo $_navigation?>
      </div>
    </div>
    <script type="text/javascript">$(function(){tlancv('260','9')});</script> 
  </div>
  <div class="label labelDis news_detail calcFwmainHeight" id="271" rel="271" titles="文章内容"  usestate="1" style='width:934px;height:309px;z-index:100;left:266.5px;top:71px;position:absolute;margin-left:0px;'>
    <div id="jzgc271" class="label_content articleContent" style="">
      <div class="news_detail_title"><?php echo $_content['title']; ?></div>
      <div class="news_detail_info">
        <div class="news_detail_time"><?php echo date('Y-m-d',$_content['intime']); ?></div>
        <div class="news_detail_from">来源:未知</div>
        <div class="news_detail_tool"> 点击数: &nbsp;<?php echo $_content['hits']; ?></div>
        <div class="clear"></div>
      </div>
      <div id="mcontent" class="news_detail_cont" style="min-height: 200px">
          <?php echo $_content['content'] ?>
      </div>
      <div class="articleContent_other">
        <div class="next-article"><a href="<?php echo $_prev['link'] ?>">下一篇:<?php echo $_prev['title'] ?></a></div>
      </div>
      <div class="news_detail_morenews">
          <?php $colum = getColumn(1, $_channel['sign']); ?>
        <div class="news_detail_morenewssub1">相关文章</div>
        <div class="news_detail_morenewssub2">
          <ul>
              <?php $lists = getLists(1, "model|1;nostate|20;cid|{$colum['clists']};sort|intime;sorttype|desc;row|6"); foreach ($lists as $key=>$value) : ?>
                  <?php if($_content['title'] == $value['title']) continue; ?>
                      <li>
                          <a title="<?php echo $value['title']?>" href="<?php echo $value['link']?>"><?php echo $value['title']?></a>
                          <span class="datetime" id="datetime239"><?php echo date('Y-m-d',$value['intime'])?></span>
                      </li>
              <?php endforeach; ?>
          </ul>
        </div>
      </div>
<!--      <script type="text/javascript">-->
<!--        $(function(){-->
<!--            $('.emotion271dis11').qqFace({-->
<!--            assign:'saytext271dis11', //给那个控件赋值-->
<!--            path:'/manager/images/qqface/' //表情存放的路径-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<!--      <div class="discuss_detail">-->
<!--        <div class="discuss_detailtitle"><span class="hot">热门评论</span></div>-->
<!--        <div class="clear"></div>-->
<!--        <div class="discuss_detailmore">-->
<!--          <ul id="">-->
<!--            <li>-->
<!--              <p>暂无信息</p>-->
<!--          </ul>-->
<!--          </ul>-->
<!--        </div>-->
<!--        <div class="clear holder pager271dis11"></div>-->
<!--        <div class="discuss_report">-->
<!--          <div class="discuss_report_img"><img src="/template/images/discuss3.gif" /></div>-->
<!--          <div class="discuss_report_form">-->
<!--            <div class="discuss_report_textarea">-->
<!--              <div class="input disscussComment" contenteditable="true" id="saytext271dis11" name="saytext271dis11"></div>-->
<!--            </div>-->
<!--            <div class="discuss_report_toolbar">-->
<!--              <div class="discuss_report_toolbar1">-->
<!--                <div class="discuss_report_feeling"><a class="discuss_report_feelingimg emotion271dis11" title="插入表情"></a></div>-->
<!--                <div class="discuss_report_code"><span>验证码：</span><span>-->
<!--                  <input id="disCheckCode271dis11" name="txt_check" type="text" size=6 maxlength=4 class="input fwCodeText">-->
<!--                  <img class="fwImgCheckCode fwArticleCode" id="imgcheckcode271dis11" src="/inc/checkcode.asp" alt="验证码,看不清楚?请点击刷新验证码" height="10" style="cursor : pointer;" onClick="this.src='/inc/checkcode.asp?t='+(new Date().getTime());" ></span></div>-->
<!--              </div>-->
<!--              <div class="discuss_report_toolbar2">-->
<!--                <button onclick=discussOperate(271,"Article","11") class="discuss_button" type="submit">发布评论</button>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="clear"></div>-->
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">$(function(){tlancv('271','266.5')});</script>
</div>

    <script type="text/javascript">
        function xszcd(obj) {
            if(obj.children.length>1){
                obj.children[1].style.cssText = 'display:inline-block;';
            }
        }

        function yczcd(obj) {
            if(obj.children.length>1){
                obj.children[1].style.cssText = 'display:none;';
            }
        }
    </script>

<?php include '_foot.php' ?>