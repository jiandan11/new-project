<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>ui/plugin/shop/css/shop.css" />
<script type="text/javascript" src="<?php echo $_baseurl;?>ui/plugin/shop/js/shop.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>ui/plugin/dsdialog/css/dsdialog.css" />
<script src="<?php echo $_baseurl;?>ui/plugin/dsdialog/dsdialog.js"></script>
<div class="dbgms_shop_row_wrap" style="width: 1000px; margin: 0 auto;">
 <div class="dbgms_shop_row">
  <!--产品图集-->
  <div class="dbgms_shop_row_pic">
   <div id="preview" class="spec-preview">
    <span class="jqzoom"><img style="width: 350px; height: 350px;" data-jqimg="<?php echo $_content['thumb']?>" src="<?php echo $_content['thumb']?>" /></span>
   </div>
   <!--缩图-->
   <div class="spec-scroll" data-tip="">
    <a class="prev">&lt;</a> <a class="next">&gt;</a>
    <div class="items">
     <ul>
<?php foreach ($_content['imgs'] as $val):?>
<li><img alt="<?php echo $val['msg'];?>" data-bimg="<?php echo $val['url'];?>" src="<?php echo $val['url'];?>" onmousemove="preview(this);" /></li>
<?php endforeach;?>      
      </ul>
    </div>
   </div>

  </div>
  <!--产品信息-->

  <div class="dbgms_shop_row_info" style="position: relative;">
   <div class="dbgms-shop-row-seller">
    <p>卖家信息》</p>
    <p>卖家信息》</p>
    <p>卖家信息》</p>
   </div>
   <h1 class="dbgms-shop-info-title"><?php echo $_content['title'];?></h1>
   <ul class="dbgms-shop-info-ul">
    <li>• 品牌: <?php echo $_content['brand'];?></li>
    <li>• 商品编号：NO.8856 \ 4143152</li>
    <li>• 单价：￥ <strong style="font-size: 30px; margin: 0;"><?php echo $_content['price'];?></strong></li>
    <li>&nbsp;&nbsp;(价格仅供参考，请以现场实际售价为准。)</li>
    <li>• 商品评分：<span class="dbgms-shop-info-startimg"></span><span style="color: #4674d6;">(已有0人评价)</span></li>
    <li>• 服&nbsp;&nbsp;&nbsp;&nbsp;务：</li>
    <li>• 温馨提示：</li>
   </ul>
   <div style="clear: both; height: 10px;"></div>
   <div class="dbgms-shop-row-amount">
    购买数量：
    <div class="row_amount_wrap">
     <form id="DbgMsFormShopRow" name="DbgMsFormShopRow" method="get">
      <input type="hidden" value="<?php echo $_channel['model']?>" name="form_modelid" id="form_modelid">
      <!--  -->
      <input type="hidden" value="<?php echo $_channel['id']?>" name="form_columnid" id="form_columnid">
      <!--  -->
      <input type="hidden" value="<?php echo $_content['id']?>" name="form_contentid" id="form_contentid">
      <!--  -->
      <input type="hidden" class="row_price" value="15"> <a href="javascript:void(0);" class="row_amount_down"></a> <input type="text" class="row_amount" id="form_amount" name="form_amount" maxlength="4" data-amount="1" data-id="17" value="1"> <a href="javascript:void(0);" class="row_amount_up"></a>
     </form>
    </div>
    <span class="red bg_max hide">本商品最大库存为10000台！</span> <span class="red bg_min hide">请至少选择1件商品！</span>
   </div>
   <div style="clear: both; height: 10px;"></div>
   <div class="dbgms-shop-row-act">
    <div class="row_act">
     <a href="javascript:void(0);" onclick="ajaxShop('buy');" class="dbgms-shop-row-act-buy"><span class="row_buyimg"></span>加入购物车</a>
     <!--  -->
     <a href="javascript:void(0);" class="dbgms-shop-row-act-dan"><span class="row_danimg"></span>申请担保</a>
     <!--  -->
     <a href="javascript:void(0);" onclick="ajaxShop('collect');" class="dbgms-shop-row-act-collect"><span class="row_collectimg"></span>加入收藏</a>
    </div>
    <div class="row_help_wrap">
     <div class="tips" id="buy_dialog" style="display: none;">
      <p class="ttl">已加入购物清单！</p>
      <p>购物清单内中共有<span class="num" id="cart_total_num"></span>个商品
      </p>
      <p><a href="#">查看购物清单</a> &gt;</p>
      <p class="close"><a href="javascript:void(0);" onclick="$('#buy_dialog').hide()">关闭</a></p>
     </div>

     <div class="tips" id="collect_dialog2" style="display: none;">
      <p class="ttl">成功加入收藏！</p>
      <p>您已收藏<span class="num" id="favor_total_num"></span>个宝贝 <a href="#">查看我的收藏 &gt;</a></p>
      <p class="close"><a href="javascript:void(0);" onclick="$('#collect_dialog2').hide()">关闭</a></p>
     </div>
     <div class="tips" id="collect_dialog" style="display: none;">
      <p class="ttl">已收藏！</p>
      <p>您已收藏<span class="num" id="favor_total_num"></span>个宝贝 <a href="#">查看我的收藏 &gt;</a></p>
      <p class="close"><a href="javascript:void(0);" onclick="$('#collect_dialog').hide()">关闭</a></p>
     </div>

     <div class="tips" id="login_dialog" style="display: none;">
      <p>你还没有 <a href="javascript:void(0);">登录</a> 或 <a href="#">注册</a></p>
      <p>无法 添加产品到购物车清单</p>
      <p class="close"><a href="javascript:void(0);" onclick="$('#login_dialog').hide()">关闭</a></p>
     </div>
    </div>
   </div>
  </div>
  <script type="text/javascript">
				$(document).ready(function() {
					RowAmountArr = $('.row_amount');
					RowAmountArr.off('change');
					RowAmountArr.on('change', function() {
						var row_parent = $(this).parent();// 获取父类
						var row_price = row_parent.find(".row_price").val();// 获取单价
						var row_id = $(this).attr("data-id");
						var row_amount = $(this).attr("data-amount");
						var change_amount = $(this).val();
						if (!Number(change_amount) || change_amount <= 0) {
							alert("请输入有效的数量");
							$(this).val(row_amount);
						} else {
							// 计算一件的价格
							var totalprice = change_amount * row_price;
							totalprice = totalprice.toFixed(2);
							$("#totalprice" + row_id).html(totalprice);
							$(this).attr("data-amount", change_amount);// 修改基础值
						}
					});
					/* 数量一修改就改变总价 */
					//添加
					RowAmountUp = $('.row_amount_up');
					RowAmountUp.off('click');
					RowAmountUp.on('click', function() {
						var row_parent = $(this).parent();// 获取父类
						var row_amount = row_parent.find(".row_amount");// 获取数量
						var row_amount_curr = row_amount.attr("data-amount");// 获取数量
						row_amount.val(Number(row_amount_curr) + 1);
						row_amount.trigger('change');
					});
					RowAmountDown = $('.row_amount_down');
					RowAmountDown.off('click');
					RowAmountDown.on('click', function() {
						var row_parent = $(this).parent();// 获取父类
						var row_amount = row_parent.find(".row_amount");// 获取数量
						var row_amount_curr = row_amount.attr("data-amount");// 获取数量
						row_amount.val(Number(row_amount_curr) - 1);
						row_amount.trigger('change');
					});
				});
             
				function input_buy() {
					//$('#login_dialog').show();
					$('#buy_dialog').show();
				}
				function input_collect() {
					//$('#login_dialog').show();
					$('#collect_dialog').show();
				}
                var BaseUrl= '<?php echo $_baseurl;?>';
				/******@action:加入购物车 @time:20160302******/
				function ajaxShop(type, distype, disId) {
                     form_modelid = $('#form_modelid').val();
                     form_contentid = $('#form_contentid').val();
                     form_amount = $('#form_amount').val();
                    //传参
					$.ajax({
						type : "POST",
						url :BaseUrl+ "common/ajaxshop/" + type,
						async : false,
			            data: {'form_modelid':form_modelid,'form_contentid':form_contentid,'form_amount':form_amount},
						dataType : "json",
						error : function(XMLHttpRequest, textstatus, errorThrown) {
							alert(textstatus + "=====" + errorThrown);
							return false;
						},
						success : function(result) {
							if (result.StatusCode == 404) {
								ds.dialog({
									width : '210px',
									title : '系统提示',
									content : result.error,
									timeout : 3,
									buttons : [ {
										text : '关闭',
										autoFocus : true,
										className : 'ds_dialog_yes',
										onclick : function() {
											this.close();
										}
									}],
								});
								return false;
							}
							else if (result.StatusCode == 'login') {
								ds.dialog({
									width : '210px',
									title : '系统提示',
									content : result.error,
									timeout : 3,
									buttons : [ {
										text : '关闭',
										autoFocus : true,
										className : 'ds_dialog_yes',
										onclick : function() {
											this.close();
										}
									},{
							          text : '登录',
							          autoFocus : true,
							          className : 'ds_dialog_yes',
							          onclick : function() {
							        	  window.open(BaseUrl+"passport");
							          }
							         } ],
								});
								return false;
							}
						    else if (result.StatusCode == 200){
								ds.dialog({
									width : '210px',
									title : '系统提示',
									content : result.msg,
									timeout : 3,
								});
								$("#buy_dialog").html(" ");
								var htmls = '';
									htmls += '<p class="ttl">已加入购物清单！</p>';
									htmls += '<p>购物清单内中共有<span class="num" id="cart_total_num"></span>个商品';
									htmls += '</p>';
									htmls += '<p><a href="<?php echo $_my['link']?>/shop" target="_blank">查看购物清单</a> &gt;</p>';
									htmls += '<p class="close"><a href="javascript:void(0);" onclick="$(\'#buy_dialog\').hide()">关闭</a></p>';
								$("#buy_dialog").html(htmls);
								$("#buy_dialog").show();
							}
						}
					});
				}
			</script>
  <div style="clear: both; height: 10px;"></div>
 </div>
 <div class="dbgms-shop-recom">
  <div class="dbgms-shop-recom-head">
   <h3>看了该宝贝的人还看了</h3>
  </div>
  <div class="dbgms-shop-recomlist">
   <ul>
<?php $lists = getLists ( 6, "model|6;nostate|20;sort|rand;row|6" );?>  
<?php foreach ($lists as $key => $val):?>
 <li class="clone"><a title="<?php echo $val['title']?>" href="<?php echo $val['link']?>"><img src="<?php echo $val['thumb']?>" style="width: 195px; height: 156px;" alt="<?php echo $val['title']?>" title="<?php echo $val['title']?>">
      <p class="title"><?php echo $val['title']?></p></a></li>
<?php endforeach;?>      
   </ul>
  </div>
  <div class="fn-clear"></div>
 </div>
 <div style="clear: both; height: 10px;"></div>
 <div class="dbgms-shop-row-ft">
  <div class="dbgms-shop-row-ft-l"></div>
  <div class="dbgms-shop-row-ft-r">
   <div class="dbgms-shop-tabs">
    <ul id="dbgms_tabs">
     <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">详情介绍</a>
      <div class="indicator"></div></li>
     <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">相关评论</a>
      <div class="indicator"></div></li>
    </ul>
    <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
   </div>
   <div class="dbg_warp">
    <input type="hidden" readonly="readonly" value="update" name="act">
    <fieldset>
     <!-- 详情介绍-->
     <div id="tab1" style="display: block;" class="dbgms_tab"></div>
     <!-- 相关评论-->
     <div id="tab2" style="display: none;" class="dbgms_tab"></div>
    </fieldset>
   </div>
  </div>
  <div style="clear: both; height: 10px;"></div>
 </div>
</div>