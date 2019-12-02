<style type="text/css">
.fieldlab {
	border: 1px solid #7DC8FF;
	background: #F4FAFF;
	padding: 0 10px 8px 10px;
	width: 540px;
}

.fieldlab p {
	padding-top: 8px;
	width: 100%;
	display: inline-block;
	float: left;
}
</style>
<?php if($act=='diyfield_edit'):?>
<!-- 自定义字段编辑 -->
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $curr_url.'&act=diyfield&id='.$model_id;?>">自定义字段</a><font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font>编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">常规信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">高级参数</a></li>
 </ul>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<div class="dbg_warp">
 <form id="DbgMsFormEdit" name="DbgMsFormEdit">
  <input type="hidden" name="modelid" value="<?php echo $model_id;?>" /> <input type="hidden" name="fid" value="<?php echo $fid;?>" /> <input type="hidden" readonly="readonly" value="diyfield_update" name="act">
  <div id="tab1" style="display: block;" class="dbgms_tab">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">提示文字：</td>
      <td><input type="text" class="itxt" name="name" style="width: 270px" value="<?php echo $row['name'];?>"><font style="color: #999">&nbsp;&nbsp;中文提示</font></td>
     </tr>
     <tr>
      <td class="ft">字段标识：</td>
      <td><input type="text" class="itxt" name="field" style="width: 150px" value="<?php echo $row['field'];?>"><font style="color: #999">&nbsp;&nbsp;命名规则,英文、数字、下划线，英文开头</font></td>
     </tr>
     <tr>
      <td class="ft">数据类型：</td>
      <td><select name="type" id="selecttype">
        <option value="text">单行文本 text</option>
        <option value="number">数字 number</option>
        <option value="file">单个附件 file</option>
        <option value="download">文件下载 download</option>
        <option value="textarea">多行文本 textarea</option>
        <option value="swfupload">批量图集 swfupload</option>
        <option value="ueditor">HTML编辑器 ueditor</option>
        <option value="ueditor_en">HTML编辑器 ueditor_en</option>
        <option value="city">详细地址 city</option>
        <option value="relation">模型数据关联 relation</option>
        <option value="template">自定义模板 template</option>
        <!-- <option value="datetime">日期时间 datetime</option> -->
        <option value="radio">单选列表 radio</option>
        <option value="checkbox">多选列表 checkbox</option>
        <!--  <option value="video">视频媒体 video</option> -->
        <!--                   <option value="audio">音频媒体 audio</option> -->
        <!--                   <option value="sys">自定义字段 sys</option> -->
      </select> <select name="relationid" id="relationid" style="display: none;" disabled="disabled">
                    <?php foreach ($model_list as $key=>$val):?>
                    <option value="<?php echo $val['id']?>" <?php if($row['model']==$val['id']){echo 'selected=""';}?>><?php echo $val['name']?></option>
                    <?php endforeach;?>
              </select> <script type="text/javascript">
                $(function(){
                	$("select[name='type']").attr("value","<?php echo $row['type'];?>");
                    $('#selecttype').change(function(e){
                      var seleval =$("#selecttype  option:selected").val();
                      if(seleval=='relation'){$('#relationid').show();$('#relationid').removeAttr("disabled"); }else{$('#relationid').hide();$('#relationid').attr("disabled","disabled"); }
                    });
                });
              </script></td>
     </tr>
     <tr>
      <td class="ft">字段类型：</td>
      <td><select name="fieldtype">
        <option value="VARCHAR">变长字符 VARCHAR</option>
        <option value="CHAR" selected="selected">定长字符 CHAR</option>
      </select></td>
     </tr>
     <tr>
      <td class="ft">是否编辑：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="disable" value="1" <?php echo $row['disable']==1?' checked ':NULL;?>>隐藏</label> <label><input type="radio" name="disable" value="0" <?php echo $row['disable']==0?' checked ':NULL;?>>显示</label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后，发布时候，可以显示编辑</font>
      </td>
     </tr>
     <tr>
      <td class="ft">存储长度：</td>
      <td><input type="text" class="itxt" name="length" value="<?php echo $row['length'];?>" style="width: 150px"></td>
     </tr>
     <tr>
      <td class="ft">默认值：</td>
      <td><input type="text" class="itxt" name="default" value="<?php echo $row['default'];?>" style="width: 150px"></td>
     </tr>
     <tr>
      <td class="ft">参数：</td>
      <td><div>
        <textarea name="param" class="rtxt" style="width: 460px;"><?php echo $row['param'];?></textarea>
        <!--  -->
        <font style="color: #999">&nbsp;&nbsp;相关选项参考(value|name)，每个相关参数，单独一行;如：(1|描述)</font>
       </div></td>
     </tr>
     <tr>
      <td class="ft">帮助提示：</td>
      <td><textarea name="help" class="rtxt" style="width: 460px;"><?php echo $row['help'];?></textarea></td>
     </tr>
    </tbody>
   </table>
  </div>
  <div id="tab2" style="display: none;" class="dbgms_tab">是否允许评论等信息!</div>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $curr_url.'&id='.$model_id;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $curr_url;?>">返回列表</a>
  </div>
 </form>
</div>
<?php elseif($act=='diyfield'):?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a href="<?php echo $curr_url;?>">模型管理</a><font style="color: #666;">&gt;&gt;</font><a href="">字段</a></span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th class="fst">名称</th>
    <th width="15%">字段</th>
    <th width="15%">类型</th>
    <th width="12%">必填</th>
    <th width="12%">默认</th>
    <th width="24%" class="lst">操作</th>
   </tr>
  </thead>
  <tbody>
    <?php foreach ($list as $key=>$val) :?>
	 <tr id="tr<?php echo $key;?>">
    <td><?php echo $val['name'];?></td>
    <td><?php echo $val['field'];?></td>
    <td><?php echo $val['type'];?></td>
    <td>是</td>
    <td><?php echo $val['default'];?></td>
    <td>
    <?php echo $key==0?'<font style="color:gray">&nbsp;&nbsp;上移&nbsp;</font>':'<a href="'.$curr_url.'&act=diyfield_up&id='.$model_id.'&fid='.$key.'">上移</a> ';?>
	<?php if($key>=count ( $list )-1):?>
    <font style="color: gray">&nbsp;&nbsp;下移&nbsp;</font> 
	<?php else:?>
     <a href="<?php echo $curr_url.'&act=diyfield_down&id='.$model_id.'&fid='.$key;?>">下移</a> 
	<?php endif;?>	 
     <a href="<?php echo $curr_url.'&act=diyfield_edit&id='.$model_id.'&fid='.$key;?>">修改</a><a href="javascript:void(0);" onclick="field_del('<?php echo $key;?>')">删除</a>
    </td>
   </tr>
        <?php endforeach;?>
   </tbody>
  <tfoot>
   <tr>
    <td colspan="8" align="center"><a class="dbgms_btn" href="<?php echo $curr_url.'&act=diyfield_edit&id='.$model_id;?>">新增一个字段</a></td>
   </tr>
  </tfoot>
 </table>
 <script type="text/javascript">
function field_del(fid){
if (!confirm("确认删除？")) {
	window.event.returnValue = false;
}else{
	$.ajax({
		url:"<?php echo $curr_url.'&act=diyfield_del&id='.$model_id;?>&fid="+fid,
		type:'POST',
		async: false,
		success:function(result){
			if(result==1){location.href='<?php echo $curr_url.'&act=diyfield&id='.$model_id;?>';return;}else{alert(result);}
		}
	});
}
}
</script>
</div>
<?php elseif($act=='install' || $act=='uninstall'):?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a href="<?php echo $curr_url;?>">模型管理</a> <font style="color: #666;">&gt;&gt;</font>
   <?php echo $act=='install'?'安装':'卸载';?></span>
 </div>
 <form id="DbgMsFormEdit" name="DbgMsFormEdit">
  <input type="hidden" name="id" value="<?php echo $row['id'];?>" /> <input type="hidden" name="table" value="<?php echo $row['table'];?>" /> <input type="hidden" name="action" value="<?php echo $act;?>">
  <table class="subtab">
   <tbody>
    <tr>
     <td class="ft"><b><?php echo $act=='install'?'安装确认':'卸载确认';?></b></td>
     <td>&nbsp;</td>
    </tr>
    <tr>
     <td class="ft">模型名称：</td>
     <td><?php echo $row['name'];?></td>
    </tr>
    <tr>
     <td class="ft">模型标识：</td>
     <td><?php echo $row['sign'];?></td>
    </tr>
    <tr>
     <td class="ft">数据表名称：</td>
     <td><?php echo $row['table'];?></td>
    </tr>
	<?php if($act=='install'):?>
     <tr>
     <td class="ft">数据表信息：</td>
     <td>确定开始创建数据表“<?php echo $row['table'];?>”,安装该内容模型!</td>
    </tr>
    <?php elseif($act=='uninstall'):?>
     <tr>
     <td class="ft">数据表信息：</td>
     <td><b>“<?php echo $row['table'];?>”表共有【<?php echo $row['total'];?>】条数据。 已录入数据，建议保留数据表 ，请根据实际需要选择，本操作不可恢复</b></td>
    </tr>
    <tr>
     <td class="ft">&nbsp;</td>
     <td><label style="color: red"><input type="checkbox" name="deldata" value="1" checked>删除数据表</label></td>
    </tr>
     <?php endif;?>
          <tr>
     <td class="ft">模型文件：</td>
     <td><?php echo $row['template'];?></td>
    </tr>
    <tr class="sub">
     <td class="ft">&nbsp;</td>
     <td><a class="dbgms_btn" href="javascript:void(0);" onclick="install_uninstall()">确认</a> <a class="dbgms_btn" href="<?php echo $curr_url;?>">取消</a></td>
    </tr>
   </tbody>
  </table>
 </form>
 <script type="text/javascript">
	function install_uninstall(){
	if (!confirm("确认<?php echo $act='install'?'安装':'卸载';?>?")) {
		window.event.returnValue = false;
	}else{
		$.ajax({
			url: "<?php echo $curr_url;?>&act=install_uninstall",type:'POST',async: false,dataType:'json',
			data:$('#DbgMsFormEdit').serialize(),
			success:function(result){if(result==1){location.href='<?php echo $curr_url;?>';return;}else{alert(result);}}
		});
	}
    }
    </script>
</div>
<?php elseif($act=='add' || $act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $curr_url;?>">模型管理</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">常规信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">高级参数</a></li>
 </ul>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<div class="dbg_warp">
 <form id="DbgMsFormEdit" name="DbgMsFormEdit">
  <input type="hidden" name="id" value="<?php echo $row['id'];?>" /> <input type="hidden" name="action" value="<?php echo $use;?>" /> <input type="hidden" readonly="readonly" value="update" name="act">
  <!-- 常规信息 -->
  <div id="tab1" style="display: block;" class="dbgms_tab">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">模型名称：</td>
      <td><input <?php echo $act=='edit'?'style="color:gray" readonly':'';?> type="text" name="name" class="itxt" value="<?php echo $row['name'];?>"><font color="#999">&nbsp;&nbsp;*必填项</font></td>
     </tr>
     <tr>
      <td class="ft"><b>模型标识</b>：</td>
      <td><input <?php if($act=='edit'){echo 'style="color:gray" readonly';}?> id="form_sign" type="text" name="sign" class="itxt" value="<?php echo $row['sign'];?>"><font color="#999">&nbsp;&nbsp;*必填项</font></td>
     </tr>
     <tr>
      <td class="ft">数据表名称：</td>
      <td><input style="color: #999;" type="text" class="itxt" id="form_table" readonly><font color="#999">&nbsp;&nbsp;数据库表单名称自动为 db_模型标识组合</font></td>
     </tr>
     <tr>
      <td class="ft">字段：</td>
      <td>
       <div class="labelwrp fieldlab">
        <p>【默认基础字段】</p>
        <p></p>
        <div>
         <label><input type="checkbox" checked disabled="disabled">自动ID</label> <label><input type="checkbox" checked disabled="disabled">栏目ID</label>
         <!--  -->
         <label><input type="checkbox" checked disabled="disabled">责任编辑ID</label> <label><input type="checkbox" checked disabled="disabled">作者ID</label>
         <!--  -->
         <label><input type="checkbox" checked disabled="disabled">文档状态</label> <label><input type="checkbox" checked disabled="disabled">入库时间</label>
         <!--  -->
         <label><input type="checkbox" checked disabled="disabled">修改时间</label> <label><input type="checkbox" checked disabled="disabled">收录时间</label>
         <!--  -->
         <label><input type="checkbox" checked disabled="disabled">标题</label> <label><input type="checkbox" checked disabled="disabled">描述</label>
         <!--  -->
         <label><input type="checkbox" checked disabled="disabled">关键字</label> <label><input type="checkbox" checked disabled="disabled">点击量</label>
         <!--  -->
         <label><input type="checkbox" checked disabled="disabled">推荐位置</label> <label><input type="checkbox" checked disabled="disabled">是否收录</label>
        </div>
        <label><input type="checkbox" checked disabled="disabled">高级参数</label>
        <p>【自定义字段】</p>
        <p><?php foreach($row['diyfield'] as $val){echo '<label><input type="checkbox" value="' . $val['field'] . '" checked disabled="">' . $val['name'] . '</label>';}?></p>
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">绑定表单：</td>
      <td><select name="formid" style="width: 200px; height: 25px;">
        <optgroup label="内容管理">
         <option value="1" selected="selected">内容表单</option>
         <option value="2">极简表单</option>
         <option value="3">图文表单</option>
        </optgroup>
      </select></td>
     </tr>
     <tr>
      <td class="ft">显示顺序：</td>
      <td><input type="text" name="rank" class="itxt" value="<?php echo $row['rank'];?>"></td>
     </tr>
     <tr>
      <td class="ft"><b>模型扩展</b>：</td>
      <td><font color="gray">供开发人员使用，模型如果有特殊需求才进行配置</font></td>
     </tr>
     <tr>
      <td class="ft">所需文件：</td>
      <td><textarea class="rtxt" style="width: 500px; height: 126px"></textarea></td>
     </tr>
     <tr>
      <td class="ft">&nbsp;</td>
      <td><label><input type="checkbox" value="1">重新编译文件</label></td>
     </tr>
     <tr>
      <td class="ft">安装程序</td>
      <td><textarea class="rtxt" style="width: 500px; height: 40px;"></textarea></td>
     </tr>
    </tbody>
   </table>
  </div>
  <!-- 高级参数 -->
  <div id="tab2" style="display: none;" class="dbgms_tab">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft"></td>
      <td><font style="color: red;"><b>[ 模型-栏目-内容 逐级设置 ]</b> <br> </font></td>
     </tr>
     <tr>
      <td class="ft">数据 缓存：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[iscache]" value="0" <?php echo $row['param']['iscache']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[iscache]" value="1" <?php echo $row['param']['iscache']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后将 对内容进行文件缓存</font>
      </td>
     </tr>
     <tr>
      <td class="ft">数据 缓存：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[cache_open]" value="0" <?php echo $row['param']['cache_open']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[cache_open]" value="1" <?php echo $row['param']['cache_open']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后将 对内容进行文件缓存</font>
      </td>
     </tr>
     <tr>
      <td class="ft">内容 审核：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[state_open]" value="0" <?php echo $row['param']['state_open']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[state_open]" value="1" <?php echo $row['param']['state_open']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后将 对内容 进行审核,默认关闭,关联 前台用户发布文章的时候，请开启审核，以增加内容的有效性</font>
      </td>
     </tr>
     <tr>
      <td class="ft"></td>
      <td><font style="color: red;"><b>[ 评论相关 ]</b> <br> </font></td>
     </tr>
     <tr>
      <td class="ft">评论表名：</td>
      <td><input style="color: gray" readonly type="text" name="param[comment_table]" class="itxt" value="<?php echo $row['table'];?>_comment"></td>
     </tr>
     <tr>
      <td class="ft">&nbsp;</td>
      <td><a class="dbgms_btn" onclick="cmsModelComment()" href="javascript:void(0);">检测表单存在性</a> <a class="dbgms_btn" onclick="cmsModelComment('install')" href="javascript:void(0);">安装</a> <a class="dbgms_btn" onclick="cmsModelComment('uninstall')" href="javascript:void(0);">卸载</a></td>
     </tr>
<?php if(!empty($row['param']['comment_table'])):?>
      <tr>
      <td class="ft">评论开启：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[comment_open]" value="0" <?php echo $row['param']['comment_open']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[comment_open]" value="1" <?php echo $row['param']['comment_open']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后将 对内容 进行评论,表单命名为{ 数据表名称_comment }</font>
      </td>
     </tr>
     <tr>
      <td class="ft">游客评论：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[comment_guest]" value="0" <?php echo $row['param']['comment_guest']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[comment_guest]" value="1" <?php echo $row['param']['comment_guest']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;是否允许未登录的游客评论~</font>
      </td>
     </tr>
     <tr>
      <td class="ft">评论审核：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[comment_state]" value="0" <?php echo $row['param']['comment_state']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[comment_state]" value="1" <?php echo $row['param']['comment_state']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后将 对内容 进行审核,默认关闭,关联 前台用户发布文章的时候，请开始审核</font>
      </td>
     </tr>
     <tr>
      <td class="ft">评论验证码：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[comment_captcha]" value="0" <?php echo $row['param']['comment_captcha']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[comment_captcha]" value="1" <?php echo $row['param']['comment_captcha']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;</font>
      </td>
     </tr>
<?php endif;?>
      <tr>
      <td class="ft">点击 统计：</td>
      <td>
       <div class="labelwrp">
        <label><input type="radio" name="param[isclick]" value="0" <?php echo $row['param']['isclick']==0?'checked':"";?>>关闭</label>
        <!--  -->
        <label><input type="radio" name="param[isclick]" value="1" <?php echo $row['param']['isclick']==1?'checked':"";?>>开启</label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后将 对内容 进行点击量统计</font>
      </td>
     </tr>
    </tbody>
   </table>
  </div>

  <div style="margin-left: 150px; margin-top: 30px; height: 100px;">
   <a class="dbgms_btn_submit" onclick="content_sql()" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $curr_url;?>">返回列表</a>
  </div>
 </form>
 <script type="text/javascript">
$(document).ready(function(){
	var form_sign = $('#form_sign');
	var form_table = $('#form_table');
	if(form_sign.val()!=false){
        form_table.val('db_'+form_sign.val());
	}
	form_sign.on('change',function(){
		form_table.val('db_'+$(this).val());
	});
});
function content_sql(){
 $.ajax({ 
	url:"<?php echo $con_url;?>",data:$('#DbgMsFormEdit').serialize(),type:"POST",
	success:function(result){if(result==1){alert("成功!");location.href='<?php echo $curr_url;?>';return;}else{alert(result);}}
 });
}
/*安装卸载模型*/
function cmsModelComment(type){
 var comment_table = $("input[name='param[comment_table]']").val();
 var comment_open = $("input[name='param[comment_open]']").val();
 var comment_captcha = $("input[name='param[comment_captcha]']").val();
 console.log(type);
 if(comment_table=='_comment'){
    $.msglayer('请先安装模型~');
    return;
 }else{
    if(type=='install'){
    	$.ajax({ 
    	    url:"<?php echo $con_url;?>&act=comment_table&type="+type,
            data:$('#DbgMsFormEdit').serialize(),type:"POST",dataType:'json',
    		success:function(result){if(result.StatusCode==200){
              $.msglayer('安装成功~');setTimeout(function(){window.location.reload();},1500);return;}else{$.msglayer(result.msg);}
            }
         });
    }else if(type=='uninstall'){
    	$.ajax({ 
    	    url:"<?php echo $con_url;?>&act=comment_table&type="+type,
            data:$('#DbgMsFormEdit').serialize(),type:"POST",dataType:'json',
    		success:function(result){if(result.StatusCode==200){
               $.msglayer('卸载成功~');setTimeout(function(){window.location.reload();},1500);return;}else{$.msglayer(result.msg);}
            }
         });
    }else{
	 $.ajax({ 
	    url:"<?php echo $con_url;?>&act=comment_table",
        data:$('#DbgMsFormEdit').serialize(),type:"POST",dataType:'json',
		success:function(result){if(result.StatusCode==200){$.msglayer('存在');return;}else{$.msglayer(result.msg);}}
     });
    }
  }
}
</script>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a href="<?php echo $curr_url;?>">模型管理</a></span><span class="span_r"><input type="button" value="更新缓存 " class="dbgms_btn" onclick="dbgjs_upcache('<?php echo $curr_url;?>')"> <a class="dbgms_btn" href="<?php echo $curr_url;?>&act=add">添加模型</a> </span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th width="50px;">ID</th>
    <th width="150px;">名称</th>
    <th>标识</th>
    <th>数据表</th>
    <th>是否安装</th>
    <th>是否禁用</th>
    <th width="270px;">操作</th>
   </tr>
  </thead>
  <tbody>
     <?php foreach ($list as $key=>$val):?>
    <tr id="tr<?php echo $val['id'];?>">
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['name'];?></td>
    <td><?php echo $val['sign'];?></td>
    <td><?php echo $val['table'];?></td>
    <td><?php echo $val['install']==1?'<a href="'.$curr_url.'&act=uninstall&id='.$val['id'].'">卸载</a>':'<a href="'.$curr_url.'&act=install&id='.$val['id'].'" style="background:#DADADA;">安装</a>';?></td>
    <td><?php echo $val['disable']==1?'<a style="background:#DADADA;" onclick="open_close('.$val['id'].','.$val['install'].',0)">启用</a>':'<a onclick="open_close('.$val['id'].','.$val['install'].',1)">禁用</a>';?></td>
    <td><a href="<?php echo $curr_url.'&act=diyfield&id='.$val['id'];?>">字段</a><a href="<?php echo $edit_url.'&id='.$val['id'];?>">编辑</a><a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a></td>
   </tr>
    <?php endforeach;?>
    </tbody>
  <tfoot>
   <tr>
    <td colspan="7">============( 非技术管理员请不要操作！ )============</td>
   </tr>
  </tfoot>
 </table>
 <script type="text/javascript">
function open_close(id,install,val){
  if(install==0){alert("请先安装!");return false;}
  $.ajax({
    url:"<?php echo $curr_url;?>&act=open_close&id="+id+"&install="+install+"&disable="+val,
    data:$('#DbgMsFormEdit').serialize(),type:'POST',async: false,dataType:'json',
    success:function(result){if(result==1){location.href='<?php echo $curr_url;?>';return;}else{alert(result);}}
  });
}
</script>
</div>
<?php endif;?>