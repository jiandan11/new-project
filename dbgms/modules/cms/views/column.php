<script type="text/javascript" src="<?php echo base_url()?>ui/js/jquery.cookie.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>plugin/powerFloat/style.css" />
<script type="text/javascript" src="<?php echo base_url()?>plugin/powerFloat/powerFloat.js"></script>
<script type="text/javascript">
var dbgms_baseurl = '<?php echo $_dbgms_baseurl;?>'; 
var dbgms_url = '<?php echo $_dbgms_url;?>'; 
var dbgms_mod_url = '<?php echo $mod_url;?>';
var dbgms_con_url = '<?php echo $con_url;?>';
</script>
<style>
    <?php if($enablelanguage == 0):?>
    .invisible{display: none;}
    <?php endif;?>
</style>
<?php if($act=='set'|| $act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">栏目管理</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">基本设置</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">中文信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab3')">英文信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab4')">高级设置</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab6')">使用帮助</a></li>
 </ul>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<!--  -->
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit">
  <input type="hidden" value="<?php echo $row['id'];?>" name="id" readonly> <input type="hidden" value="update" name="act" readonly> <input type="hidden" value="<?php echo $row['level']?>" name="level" readonly>

  <fieldset>
   <!-- 基本设置 -->
   <div id="tab1" style="display: block;" class="dbgms_tab">
    <table class="subtab">
     <tbody>
      <tr>
       <td class="ft">绑定模型：</td>
       <td><select name="model" style="width: 180px;">
 <?php foreach ($model_list as $key=>$val):?>
 <option value="<?php echo $val['id']?>" <?php if($row['model']==$val['id']){echo 'selected=""';}?>><?php echo $val['name']?></option>
 <?php endforeach;?>
 </select> <font style="color: #999">*（绑定内容模型）</font></td>
      </tr>
      <tr>
       <td class="ft">上级栏目：</td>
       <td><select name="column">
         <option value="0" <?php if($row['column']==0){echo 'selected=""';}?>>===顶级栏目===</option>
<?php foreach ($column_list as $key=>$val){if($val['column']==0&&$val['model']==$row['model']):?>
 <option value="<?php echo $val['id']?>" <?php if($row['column']==$val['id']){echo 'selected';}?>>&nbsp;├&nbsp;<?php echo $val['name']?></option> 
 <?php foreach ($column_list as $key2=>$val2){if($val2['column']==$val['id']):?>
<option value="<?php echo $val2['id']?>" <?php if($row['column']==$val2['id']){echo 'selected';}?> <?php if( $val2['id']==$row['id']){echo 'disabled="disabled"';}?>>&nbsp;&nbsp;&nbsp;&nbsp;├&nbsp;<?php echo $val2['name']?></option> 
  <?php foreach ($column_list as $key3=>$val3){if($val3['column']==$val2['id']):?>
<option value="<?php echo $val3['id']?>" <?php if($row['column']==$val3['id']){echo 'selected ';}?> <?php if($val3['level']==3 || $val3['id']==$row['id']){echo 'disabled="disabled"';}?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├&nbsp;<?php echo $val3['name']?></option> 
  <?php endif;}?>
 <?php endif;}?>
<?php endif;}?>
	</select></td>
      </tr>
      <tr>
       <td class="ft">中文名称：</td>
       <td><input type="text" id="columnname" placeholder="必填项" name="name" class="itxt" value="<?php echo $row['name'];?>"> <font style="color: #999">*（不能为空）</font></td>
      </tr>
      <tr class="invisible">
       <td class="ft">英文名称：</td>
       <td><input type="text" placeholder="必填项" name="ename" class="itxt" value="<?php echo $row['ename'];?>"> <font style="color: #999">*（不能为空）</font></td>
      </tr>
      <tr>
       <td class="ft">英文标识：</td>
       <td><input type="text" id="columnsign" placeholder="必填项" name="sign" class="itxt" value="<?php echo $row['sign'];?>"> <a href="javascript:void(0);" class="dbgms_btn" onclick="changesign()"><span style="color: blue;">自动拼音</span></a> <font style="color: #999">*（根据中文自动转拼音，作为url标识，也可以自己设置~）</font></td>
      </tr>
      <tr>
       <td class="ft"><b>模板设置：</b></td>
       <td><br /> <font style="color: #999">***（为空为默认）*** </font><br /> <font style="color: #ff00ff"> <br /> 栏目创建后，请根据 栏目属性 类型，选择对应的展示模板
       </font></td>
      </tr>
      <tr>
       <td class="ft">栏目属性：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="property" value="0" <?php echo $row['property']==0?'checked="checked"':"";?>> 频道 <font style="color: #999">(频道页 不能发布内容)</font></label>
         <!--  -->
         <label><input type="radio" name="property" value="1" <?php echo $row['property']==1?'checked="checked"':"";?>> 列表 </label>
         <!--  -->
         <label><input type="radio" name="property" value="2" <?php echo $row['property']==2?'checked="checked"':"";?>> 内容 <font style="color: #999">(内容页 不能发布内容)</font></label>
        </div>
       </td>
      </tr>
      <tr>
       <td class="ft">频道页：</td>
       <td>模板 <input type="text" name="template[channel]" id="template_channel" class="itxt" value="<?php echo $row['template']['channel'];?>">
       </td>
      </tr>
      <tr>
       <td class="ft">列表页：</td>
       <td>模板 <input type="text" name="template[list]" id="template_list" class="itxt" value="<?php echo $row['template']['list'];?>"> <font style="color: #999">( 栏目下内容 列表 所使用的模板 )</font>
       </td>
      </tr>
      <tr>
       <td class="ft">内容页：</td>
       <td>模板 <input type="text" name="template[content]" id="template_content" class="itxt" value="<?php echo $row['template']['content'];?>"> <font style="color: #999">( 栏目下内容 详情 所使用的模板 )</font>
       </td>
      </tr>
      <tr>
       <td class="ft">展示位置：</td>
       <td><label><input type="radio" name="showtype" value="0" <?php echo $row['showtype']==0?'checked="checked"':"";?>>顶部导航</label>&nbsp;&nbsp; <label><input type="radio" name="showtype" value="1" <?php echo $row['showtype']==1?'checked="checked"':"";?>>栏目分类</label></td>
      </tr>
      <tr>
       <td class="ft">栏目顺序：</td>
       <td><input type="text" name="rank" class="itxt" style="width: 50px;" value="<?php echo $row['rank']?>"><font style="color: #999">（数字越小栏目越靠前）</font></td>
      </tr>
      <tr>
       <td class="ft">内容分页数：</td>
       <td><input type="text" name="param[pages]" class="itxt" style="width: 50px;" value="<?php echo $row['param']['pages'];?>"><font style="color: #999">（针对栏目下内容的每页显示数）</font></td>
      </tr>
      <tr>
       <td class="ft">是否隐藏：</td>
       <td><label><input type="radio" name="disable" value="0" <?php echo $row['disable']==0?'checked="checked"':"";?>>否</label>&nbsp;&nbsp;<label><input type="radio" name="disable" value="1" <?php echo $row['disable']==1?'checked="checked"':"";?>> 是</label></td>
      </tr>
<?php $baselogo['form']='DbgMsFormEdit';$baselogo['name'] = '栏目形象图';$baselogo['field'] = 'icon';$baselogo['path']='site';dbg_diyfield ( 'load', 'file', $baselogo,$row['icon'] );?>
       <tr>
       <td class="ft"><b>多维筛选：</b></td>
       <td><font style="color: #999">***（需要再多维栏目中创建）*** </font></td>
      </tr>
      <tr>
       <td class="ft">关联筛选：</td>
       <td><select name="param[expand]" style="width: 180px;">
         <option value="0" selected>默认为空</option>
<?php foreach ($expand_list as $val):?>
 <option value="<?php echo $val['id'];?>" <?php if($row['param']['expand']==$val['id']){echo 'selected ';}?>><?php echo $val['title'];?></option>
<?php endforeach;?>          
         
        </select> <font style="color: #999">*（绑定多维筛选栏目）</font></td>
      </tr>
      <tr>
       <td class="ft">内容排序字段：</td>
       <td>
        <div>
         <label><input type="radio" name="param[sort]" value="0" <?php echo $row['param']['sort']==0?'checked':NULL;?>>默认</label>&nbsp;&nbsp;
         <!--  -->
         <label><input type="radio" name="param[sort]" value="uptime" <?php echo $row['param']['sort']=='uptime'?'checked':NULL;?>>更新时间 </label>&nbsp;&nbsp;
         <!--  -->
         <label><input type="radio" name="param[sort]" value="hits" <?php echo $row['param']['sort']=='hits'?'checked':NULL;?>>点击</label>&nbsp;&nbsp;
         <!--  -->
         <label><input type="radio" name="param[sort]" value="intime" <?php echo $row['param']['sort']=='intime'?'checked':NULL;?>>录入时间</label>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<font style="color: #999"> 栏目下内容的排序方式</font>
         <!--  -->
        </div>
       </td>
      </tr>
      <tr>
       <td class="ft">内容排序类型：</td>
       <td>
        <div>
         <label><input type="radio" name="param[sorttype]" value="0" <?php echo $row['param']['sorttype']==0?'checked':NULL;?>>默认</label>&nbsp;&nbsp; <label><input type="radio" name="param[sorttype]" value="DESC" <?php echo $row['param']['sorttype']=='DESC'?'checked':NULL;?>>从大到小（反序）</label>&nbsp;&nbsp;
         <!--  -->
         <label><input type="radio" name="param[sorttype]" value="ASC" <?php echo $row['param']['sorttype']=='ASC'?'checked':NULL;?>>从小到大（正序）</label>&nbsp;&nbsp;
         <!--  -->
        </div>
       </td>
      </tr>
      <!-- <tr> -->
      <!-- <td class="ft"><b>同步到子栏目</b></td> -->
      <!-- <td><label><input type="checkbox" name="son_hidden" value="1" checked> 是否隐藏</label>&nbsp;&nbsp; <label><input type="checkbox" name="son_pagerow" value="1" checked> 每页条数</label>&nbsp;&nbsp; <label><input type="checkbox" name="son_maxpage" value="1" checked> -->
      <!--    最大页数</label>&nbsp;&nbsp; <label><input type="checkbox" name="son_domain" value="1" checked> 二级域名</label>&nbsp;&nbsp; <label><input type="checkbox" name="son_urltype" value="1" checked> 访问类型</label>&nbsp;&nbsp; <label><input type="checkbox" name="son_tpl" -->
      <!--     value="1" checked> 模板</label>&nbsp;&nbsp; <label><input type="checkbox" name="son_dir" value="1"> 生成路径</label></td> -->
      <!-- </tr> -->
     </tbody>
    </table>
   </div>
   <!-- 中文信息 -->
   <div id="tab2" style="display: none;" class="dbgms_tab">
    <table class="subtab">
     <tbody>
      <tr>
       <td class="ft">SEO 标题：</td>
       <td><input type="text" name="param[zhtitle]" class="itxt" maxlength="80" style="width: 400px;" value="<?php echo $row['param']['zhtitle'];?>"><font style="color: #999"></font></td>
      </tr>
      <tr>
       <td class="ft">SEO 描述：</td>
       <td><textarea class="rtxt" name="param[zhdescription]" maxlength="200" style="width: 400px; height: 126px; margin: 0px; vertical-align: middle; overflow: auto; resize: none;"><?php echo $row['param']['zhdescription'];?></textarea><font style="color: #999">（针对本栏目的描述）</font></td>
      </tr>
      <tr>
       <td class="ft">SEO 关键字：</td>
       <td><input type="text" name="param[zhkeywords]" class="itxt" maxlength="100" style="width: 400px;" value="<?php echo $row['param']['zhkeywords'];?>"><font style="color: #999">（关键词以 , 号分割）</font></td>
      </tr>
       <?php $diyf['form']='DbgMsFormEdit';$diyf['name']='栏目中文内容';$diyf['id']='temlate_content_txt';$diyf['field']='content';dbg_diyfield ( 'load', 'ueditor', $diyf,$row['content'] );?>
        <?php if($enablelanguage == 1):?>
            <?php $diyf['form']='DbgMsFormEdit';$diyf['name']='栏目英文内容';$diyf['id']='temlate_content_txt';$diyf['field']='econtent';dbg_diyfield ( 'load', 'ueditor', $diyf,$row['econtent'] );?>
        <?php endif;?>
     </tbody>
    </table>
   </div>
   <!-- 英文信息 -->
   <div id="tab3" style="display: none;" class="dbgms_tab">
    <table class="subtab">
     <tbody>
      <tr>
       <td class="ft">SEO 标题：</td>
       <td><input type="text" name="param[entitle]" class="itxt" maxlength="80" style="width: 400px;" value="<?php echo $row['param']['entitle'];?>"></td>
      </tr>
      <tr>
       <td class="ft">SEO 描述：</td>
       <td><textarea class="rtxt" name="param[endescription]" maxlength="200" style="width: 400px; height: 126px; margin: 0px; vertical-align: middle; overflow: auto; resize: none;"><?php echo $row['param']['endescription'];?></textarea></td>
      </tr>
      <tr>
       <td class="ft">SEO 关键字：</td>
       <td><input type="text" name="param[enkeywords]" class="itxt" maxlength="100" style="width: 400px;" value="<?php echo $row['param']['entitle'];?>"></td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 高级设置 -->
   <div id="tab4" style="display: none;" class="dbgms_tab">
    <table class="subtab">
     <tbody>
      <tr>
       <td class="ft"></td>
       <td>
        <div class="labelwrp">
         <br /> <font style="color: red;"><b>非管理员~或对 SEO 了解的人员,请勿对以下做修改，造成不必要的损失，后果自负！</b> <br /> </font> <br />
        </div>
       </td>
      </tr>
      <tr>
       <td class="ft">用户栏目：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="param[useris]" value="0"> 是</label> <label><input type="radio" name="param[useris]" value="1" checked="checked"> 否</label> （同步到用户发布相关栏目）
        </div>
       </td>
      </tr>
      <tr>
       <td class="ft">访问类型：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="param[rewrite]" value="0"> 静态</label> <label><input type="radio" name="param[rewrite]" value="1" checked="checked"> 伪静态</label> <label><input type="radio" name="param[rewrite]" value="2"> 动态</label>
        </div>
       </td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td>如果服务器环境允许，推荐使用伪静态<br />本程序使用前台缓存技术，伪静态并不会对MySQL进行频繁查询
       </td>
      </tr>
      <tr>
       <td class="ft"><b>链接地址：</b></td>
       <td><input type="text" name="param[url]" class="itxt" value=""> (90个字符以内)</td>
      </tr>
      <tr>
       <td class="ft"><b>SEO栏目url：</b></td>
       <td><label><input type="radio" name="param[seourl]" value="0" <?php echo $row['param']['seourl']==0?' checked="checked" ':NULL;?>>关闭</label> <label><input type="radio" name="param[seourl]" value="1" <?php echo $row['param']['seourl']==1?' checked="checked" ':NULL;?>>开启</label></td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td><font style="color: #888;"><b>默认为：</b> &nbsp;&nbsp;&nbsp;<?php echo $basedbg['base']['domain'];?> zh / 栏目英文标识 
       <br /> <b>开启后：</b> &nbsp;&nbsp;&nbsp;<?php echo $basedbg['base']['domain'];?> 栏目英文标识 </font></td>
      </tr>
      <tr>
       <td class="ft"><b>二级域名：</b></td>
       <td><input type="text" name="param[second]" class="dbgms-edit-input" value="<?php echo $row['param']['second'];?>"></td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td><font style="color: #888;"><b>静态访问</b><br />请将二级域名绑定到存放HTML的顶级目录<br />如HTML放在{root}/news/guonei目录下，则绑定到news文件夹<br />效果：未设置二级域名为www.domain.com/news/guonei；设置二级域名为news.domain.com/guonei <br />若HTML存放在{root}/news，则此栏目访问网址即为news.domain.com <br /> <b>伪静态访问</b> <br />选定了“二级域名根目录”则访问网址即为二级域名<br />其他则为http://二级域名/栏目标识"> </font></td>
      </tr>
      <tr>
       <td class="ft"><b>独立模板路径 ：</b></td>
       <td><input type="text" name="param[template]" class="dbgms-edit-input" value="<?php echo $row['param']['template'];?>"></td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td><font style="color: #888;">为空的话就使用，默认的站点，模板路径</font></td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 使用帮助 -->
   <div id="tab5" style="display: none;" class="dbgms_tab">
    <div class="dbgms_help_wrap">
     <p><b>基本说明：</b></p>
     <p>网站栏目管理功能</p>
     <p>&nbsp;</p>
     <p><b>1、创建栏目：</b></p>
     <p>使用链接生成!</p>
     <p>&nbsp;</p>
     <div class="tmptag">
      <p class="b"><b>1.普通html链接：</b> http://www.dbgms.cn/clickhits.php?n= 广告名称 &amp;jl= http://跳转链接</p>
      <pre>
 ----------------------------------------------------------------------------------------- 
 点击统计调用参数详细说明
 &amp;n(name)                      广告名称
 &amp;jl(jumplink)                 http://跳转链接
 ------------------------------------------------------------------------------------------ 
 </pre>
      <br />
      <p class="b"><b>2.base64编码链接：</b> http://www.dbgms.cn/clickhits.php?a= (base64编码链接)</p>
      <pre>
 ------------------------------------------------------------------------------------------  
 点击统计调用参数详细说明
 &amp;a(link)                     base64编码(名称+跳转链接)
 ------------------------------------------------------------------------------------------ 
 </pre>
     </div>
    </div>
   </div>
  </fieldset>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a>
  </div>
 </form>
</div>
<script type="text/javascript"> var tpl_val = new function(){}; 
function changesign(){
// 	$('#columnname').on('input propertychange', function() {
   var cname = $('#columnname').val();
		$.ajax({
		   url:'<?php echo $con_url?>&act=getpinyin',
	       type:'post',
		   data : {'name':cname},
		   success : function(result) {
			   $('#columnsign').val(result);
		   }
		});
// 	  });
}
 $(document).ready(function(){
  
  
     //模板赋值
     window.tpl_val = function tpl_val(id,val){
       $('#'+id).val(val);
       $.powerFloat.hide();
     }
     function tpl_list(id){
 		var list = [ 
	    <?php foreach($template_list as $val):?>
	    {href: "javascript:tpl_val('"+id+"','<?php echo $val;?>');",text: '<?php echo $val;?>'},
        <?php endforeach;?>
 		{text: "请选择使用模板"}];
 		return list;
 	 }
       function tpl_power(id){
         $("#"+id).powerFloat({
           width: 308,
           eventType: "click",
           edgeAdjust:false,
           reverseSharp:true,
           target:tpl_list(id),
           targetMode: "list"
         });
       }
      $("select[name='model']").on('change',function(event) {
    	  var value = $(this).val(); 
    	  <?php foreach ($column_list as $key=>$val):?>
       var  lists<?php echo $val['model'];?>='';
    	  <?php endforeach;?>
<?php foreach ($column_list as $key=>$val){if($val['column']==0):?>
lists<?php echo $val['model'];?> += '<option value="<?php echo $val['id']?>" <?php if($row['column']==$val['id']){echo 'selected';}?>>&nbsp;├&nbsp;<?php echo $val['name']?></option>';
	<?php foreach ($column_list as $key2=>$val2){if($val2['column']==$val['id']):?>
	lists<?php echo $val2['model'];?> += '<option value="<?php echo $val2['id']?>" <?php if($row['column']==$val2['id']){echo 'selected';}?> <?php if( $val2['id']==$row['id']){echo 'disabled="disabled"';}?> >&nbsp;&nbsp;&nbsp;&nbsp;├&nbsp;<?php echo $val2['name']?></option>';
		<?php foreach ($column_list as $key3=>$val3){if($val3['column']==$val2['id']):?>
		lists<?php echo $val3['model'];?> += '<option value="<?php echo $val3['id']?>" <?php if($row['column']==$val3['id']){echo 'selected ';}?> <?php if($val3['level']==3 || $val3['id']==$row['id']){echo 'disabled="disabled"';}?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├&nbsp;<?php echo $val3['name']?></option>';
		<?php endif;}?>
	<?php endif;}?>
<?php endif;}?>
         
         
         <?php foreach ($column_list as $key=>$val):?>
         if(value==<?php echo $val['model'];?>){
        	 $("select[name='column']").html(''); 
        	 $("select[name='column']").append(lists<?php echo $val['model'];?>);
         }
         <?php endforeach;?>
      }); 
      
      var  template_channel =   $("#template_channel");
      var  template_list =   $("#template_list");
      var  template_content =   $("#template_content");
 	  $("input[name='property']").on('change',function(event) {
 	     var value = $(this).val(); 
 	      if(value == 0 ){
 	    	 template_channel.off();
 	    	 template_channel.css("color","#333");
 	    	template_channel.css("background","#fff");
 	    	 template_channel.removeAttr("readonly");
             tpl_power("template_channel");
 	    	 template_list.off();
 	    	 template_list.css("color","#333");
 	    	 template_list.css("background","#fff");
 	    	 template_list.removeAttr("readonly");
             tpl_power("template_list");
 	      }else if(value == 1){
 	    	 template_channel.off();
 	    	 template_channel.css("color","#999");
 	    	 template_channel.css("background","#FCEBEB");
 	    	 template_channel.attr("readonly","readonly");
 	    	 template_list.off();
 	    	 template_list.css("color","#333");
 	    	 template_list.css("background","#fff");
 	    	 template_list.removeAttr("readonly");
             tpl_power("template_list"); 
 	      }else if(value==2){
 	    	 template_channel.off();
 	    	 template_channel.css("color","#999");
 	    	 template_channel.css("background","#FCEBEB");
 	    	 template_channel.attr("readonly","readonly");
 	    	 template_list.off();
 	    	 template_list.css("color","#999");
 	    	 template_list.css("background","#FCEBEB");
 	    	 template_list.attr("readonly","readonly");
 	      }
 	  });
 	  $("input:radio[name=property][value=<?php echo $row['property'];?>]").attr("checked",true).trigger('change');
 	 //$("input:radio[name=property]").trigger('change',['param1','param2']); 执行3次- -
  	 tpl_power("template_content"); 
}); 
   </script>
<?php if($enablelanguage == 0):?>
<script>
        $('.invisible').remove();
</script>
<?php endif;?>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a href="<?php echo $con_url;?>">栏目管理</a><font style="color: #999;">&nbsp;（目前最多只支持3级栏目）&nbsp;</font></span>
  <div class="span_r">
   <input type="button" value="更新缓存 " class="dbgms_btn" onclick="dbgjs_upcache('<?php echo $con_url;?>')">
  </div>
 </div>
 <form method="post" id="DbgMsFormEdit" action=" ">
  <table class="cattop" id="cattb">
   <thead>
    <tr>
     <th width="4%" class="f">选</th>
     <th>ID</th>
     <th width="15%">显示位置(排序)</th>
     <th>栏目管理</th>
     <th>栏目属性</th>
     <th class="w"><a href="javascript:void(0);" id="doall">展开全部</a>操作</th>
    </tr>
   </thead>
   <tbody>
<?php foreach ($model_list as $mk => $mval):?>
	 <tr data-mid="<?php echo $mval['id'];?>" data-level="0" data-cid="0" data-top="0">
     <th></th>
     <th></th>
     <th></th>
     <th class="w"><em>+</em>
      <h3><a href="javascript:void(0);" class="mlist">模型 【 <?php echo $mval['id'];?> 】<?php echo $mval['name'];?></a></h3></th>
     <th></th>
     <th><span><b>增加内容</b> | <a href="<?php echo $con_url;?>&act=edit&modelid=<?php echo $mval['id'];?>&level=1">添加子栏目</a> | <a href="###" class="view"><span style="width: 96px;"></span></a> </span></th>
    </tr>
   <?php foreach ($column_list as $k1 => $val1){if( ($val1['model'] == $mval['id']) && ($val1['column']==0)):?>
     <tr data-mid="<?php echo $mval['id'];?>" data-level="1" data-cid="<?php echo $val1['id'];?>" data-top="<?php echo $mval['id'];?>" id="tr<?php echo $val1['id'];?>">
     <td><input type="checkbox" value="<?php echo $val1['id'];?>" class="nob" name="ids[]"></td>
     <td><?php echo $val1['id'];?></td>
     <td><?php echo $val1['showtype']==0?'顶部导航':'栏目分类';?>(<?php echo $val1['rank'];?>)</td>
     <td class="w"><i class="i1">├</i><em>+</em>
      <h3><a href="javascript:void(0);" class="mlist"><?php echo $val1['name'];?></a>(统计)</h3></td>
     <td><?php echo $val1['property_name'];?></td>
     <td><span>
      <?php if($val1['property']==1):?> 
       <a href="javascript:void(0);" class="addcon">增加内容</a>
       <?php else:?><b>增加内容</b> 
       <?php endif;?>| <a href="<?php echo $con_url.'&act=edit&modelid='.$mval['id'].'&cid='.$val1['id'];?>&level=2">添加子栏目</a> | <a href="<?php echo $con_url;?>&act=edit&id=<?php echo $val1['id'];?>">修改</a> | <a href="javascript:void(0);" onclick="dbgmsDelete('<?php echo $delete_url.$val1['id'];?>')">删除</a> | <a href="<?php echo $val1['link'];?>" target="_blank" class="view">访问</a>
     </span></td>
    </tr>
      <?php foreach($column_list as $k2 => $val2){if( $val2 ['column'] == $val1 ['id']  && ($val2['model'] == $mval['id'])):?>
     <tr data-mid="<?php echo $mval['id'];?>" data-level="2" data-cid="<?php echo $val2['id'];?>" data-top="<?php echo $val1['id'];?>" id="tr<?php echo $val2['id'];?>" style="display: none;">
     <td><input type="checkbox" value="<?php echo $val2['id'];?>" class="nob" name="ids[]"></td>
     <td><?php echo $val2['id'];?></td>
     <td style="padding-left: 30px;"> <?php echo $val2['showtype']==0?'顶部导航':'栏目分类';?>(<?php echo $val2['rank'];?>)</td>
     <td class="w"><i class="i2">├</i><em>+</em>
      <h3><a href="javascript:void(0);" class="mlist"><?php echo $val2['name'];?></a>(统计)</h3></td>
     <td><?php echo $val2['property_name'];?></td>
     <td><span> <?php if($val2['property']==1):?> 
       <a href="javascript:void(0);" class="addcon">增加内容</a>
       <?php else:?><b>增加内容</b> 
       <?php endif;?> | <a href="<?php echo $con_url.'&act=edit&modelid='.$mval['id'].'&cid='.$val2['id'];?>&level=3">添加子栏目</a> | <a href="<?php echo $con_url;?>&act=edit&id=<?php echo $val2['id'];?>">修改</a> | <a href="javascript:void(0);" onclick="dbgmsDelete('<?php echo $delete_url.$val2['id'];?>')">删除</a> | <a href="<?php echo $val2['link'];?>" target="_blank" class="view">访问</a>
     </span></td>
    </tr>
         <?php foreach($column_list as $k3 => $val3){if( $val3 ['column'] == $val2 ['id']  && ($val3['model'] == $mval['id'])):?>
       <tr data-mid="<?php echo $mval['id'];?>" data-level="3" data-cid="<?php echo $val3['id'];?>" data-top="<?php echo $val2['id'];?>" id="tr<?php echo $val3['id'];?>" style="display: none;">
     <td><input type="checkbox" value="<?php echo $val3['id'];?>" class="nob" name="ids[]"></td>
     <td><?php echo $val3['id'];?></td>
     <td style="padding-left: 60px;"><?php echo $val3['showtype']==0?'顶部导航':'栏目分类';?>(<?php echo $val3['rank'];?>)</td>
     <td class="w"><i class="i3">├</i>
      <h3><a href="javascript:void(0);" class="mlist"><?php echo $val3['name'];?></a>(统计)</h3></td>
     <td><?php echo $val3['property_name'];?></td>
     <td><span> 
       <?php if($val3['property']==1):?> 
       <a href="javascript:void(0);" class="addcon">增加内容</a>
       <?php else:?><b>增加内容</b> 
       <?php endif;?> | <a href="<?php echo $con_url;?>&act=edit&id=<?php echo $val3['id'];?>">修改</a> | <a href="javascript:void(0);" onclick="dbgmsDelete('<?php echo $delete_url.$val3['id'];?>')">删除</a> | <a href="<?php echo $val3['link'];?>" target="_blank" class="view">访问</a>
     </span></td>
    </tr>
         <?php endif;}?>
      <?php endif;}?>
   <?php endif;}?>
<?php endforeach;?>
            <tr class="btm">
     <td><input type="checkbox" onclick="dbgmsCheckAll()"></td>
     <td colspan="6"></td>
    </tr>
   </tbody>
   <tfoot>
    <tr>
     <td colspan="11">&nbsp;</td>
    </tr>
   </tfoot>
  </table>
 </form>
 <script type="text/javascript">
$(function(){
	var tb,cids,len,i,ctr,toptrs,doall;
	tb=$('#cattb');
	doall=$('#doall');
	toptrs=$("tr",tb);
	cids=$.cookie('DbgColumnOpen')||'';
	cids= cids=='' ? [] : cids.split(',');
	len=cids.length;
	if(len>=toptrs.length){
	    doall.html('折叠全部');
		doall.data('close',1);
	}else{
	    doall.html('展开全部');
	    doall.data('close',0);
	}
	for(i=0;i<len;i++){
	    ctr=$("tr[data-cid='"+cids[i]+"']",tb);
		ctr.data('open',1);
	    $('em',ctr).html('-');
	    $("tr[data-top='"+cids[i]+"']",tb).show();
	}
	doall.on('click',function(){
		var v,len,i,tr,cid,trs,nids;
		v=doall.data('close');
		if(v==1){
	   		doall.data('close',0);
	   		doall.html('展开全部');
		}else{
	  	 	doall.data('close',1);
	   		doall.html('折叠全部');
		}
		nids='';
		len=toptrs.length;
		for(i=0;i<len;i++){
			tr=$(toptrs[i]);
		   	cid=tr.attr('data-cid');
		   	trs=$("tr[data-top='"+cid+"']",tb);
		   	if(v==1){
		 		tr.data('open',0);
		      	$('em',tr).html('+');
		  		trs.hide();
		   	}else{
		      	tr.data('open',1);
		      	$('em',tr).html('-');
		  		trs.show();
		  		nids += (nids=='' ? '' : ',') + cid;
			}
		}
		$.cookie('DbgColumnOpen',nids);
	});

	//点击事件,基于tb #id 绑定的点击事件
	$('em',tb).on('click',function(){
		var em,tr,cid,open,trs,dids,nids,len,i,j;
		j=0;
		em=$(this);//当前对象
		tr = em.parents('tr');//获取父类
		level = tr.attr('data-level');
		mtop = tr.attr('data-top');//防止关闭顶级栏目
		mid = tr.attr('data-mid')//获取mid
		cid = tr.attr('data-cid');//获取父类的 cid
		open = tr.data('open')||0;
// 		trs=$("tr[data-top='"+cid+"']",tb);//原本
		//我添加的
		trs = $("tr[data-level='"+(parseInt(level)+ 1)+"'][data-top='"+cid+"'][data-mid='"+mid+"']",tb);//获取td级
      
		nids='';
		dids=$.cookie('DbgColumnOpen')||'';
		dids= dids=='' ? [] : dids.split(',');
		len=dids.length;
		
		for(i=0;i<len;i++){
		   if(dids[i]==cid){
		       continue;
		   }else{
		       nids += (nids==''?'':',') + dids[i];
			   j++;
		   }
		}
		if(open==1){
			if(level==0){
				//顶级隐藏--根据模型隐藏
				trs = $("tr[data-mid='"+mid+"'][data-level!=0]",tb);//获取td集合
				trs.find('em').html('+'); //修改集合按钮
				trs.data('open',0);//修改集合状态
			} 
		    em.html('+');
		    tr.data('open',0);
		    trs.hide();
		}else{
		   em.html('-');
		   tr.data('open',1);
		   trs.show();
		   nids += (nids==''?'':',') + cid;
		   j++;
		}
		$.cookie('DbgColumnOpen',nids);
		if(j>=toptrs.length){
			doall.html('折叠全部');
			doall.data('close',1);
		}else{
			doall.html('展开全部');
			doall.data('close',0);
		}
	});
	/* */
	$('.mlist',tb).on('click',function(ev){
	 	var modelid=$(this).parents('tr').attr('data-mid');
	 	var columnid=$(this).parents('tr').attr('data-cid');
		ev.preventDefault();
	 	location.href=dbgms_mod_url+'?con=content&modelid='+modelid+'&columnid='+columnid;
	});

	$('.addcon',tb).on('click',function(ev){
	 	var modelid=$(this).parents('tr').attr('data-mid');
	 	var columnid=$(this).parents('tr').attr('data-cid');
		ev.preventDefault();
	 	location.href=dbgms_mod_url+'?con=content&act=edit&modelid='+modelid+'&columnid='+columnid;
	});
});
</script>
</div>
<?php endif;?>
