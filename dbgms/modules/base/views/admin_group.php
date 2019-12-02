<?php if($act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">管理组</a><font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font>编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">基本设置</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">内容模型</a></li>
<?php foreach ($dbg_menu['head']  as $val):?>
<li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab_<?php echo $val['sign']?>')"><?php echo $val['name']?></a></li>
<?php endforeach;?>   
  </ul>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>

<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" action="index.php">
  <input type="hidden" readonly="readonly" name="act" value="update"><input type="hidden" name="id" value="<?php echo $row['id'];?>">

  <div id="tab1" style="display: block;" class="dbgms_tab">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">名称：</td>
      <td><input type="text" class="itxt" name="name" style="width: 270px" value="<?php echo $row['name'];?>"></td>
     </tr>
     <tr>
      <td class="ft">图标：</td>
      <td><input type="text" class="itxt" name="icon" style="width: 270px" value="<?php echo $row['icon'];?>"></td>
     </tr>
     <tr>
      <td class="ft">是否禁用：</td>
      <td><label> <input type="radio" name="disable" value="1" <?php if($row['disable']=='1'){echo 'checked';}?>>禁用
      </label>&nbsp;&nbsp; <label> <input type="radio" name="disable" value="0" <?php if($row['disable']=='0'||$row['disable']==''){echo 'checked';}?>>启用
      </label></td>
     </tr>
     <tr>
      <td class="ft">发送私信：</td>
      <td><label> <input type="radio" name="sendpm" value="1" <?php if($row['sendpm']=='1'){echo 'checked';}?>>允许
      </label>&nbsp;&nbsp; <label> <input type="radio" name="sendpm" value="0" <?php if($row['sendpm']=='0'||$row['sendpm']==''){echo 'checked';}?>>拒绝
      </label></td>
     </tr>
     <tr>
      <td class="ft">是否开启客服：</td>
      <td>
       <div class="labelwrp">
        <label> <input type="radio" name="openqq" value="1" <?php if($row['openqq']=='1'){echo 'checked';}?>>开启
        </label> <label> <input type="radio" name="openqq" value="0" <?php if($row['openqq']=='0'||$row['openqq']==''){echo 'checked';}?>>关闭
        </label>
       </div> <font style="color: #999">&nbsp;&nbsp;开启后将显示 技术咨询QQ</font>
      </td>
     </tr>
    </tbody>
   </table>
  </div>

  <div id="tab2" class="dbgms_tab" style="display: none;">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">选择：</td>
      <td><a class="dbgms_btn" onclick="selectall('tab2','ok');" href="javascript:void(0);">全选</a> <a class="dbgms_btn" onclick="selectall('tab2','no');" href="javascript:void(0);">取消</a></td>
     </tr>
     <?php foreach ($dbg_menu['content'] as $val):?>
      <tr>
      <td class="ft"><b><?php echo $val['name'];?></b>：</td>
      <td>
       <div>
        <label><input type="radio" name="menu[content_<?php echo $val['id'];?>]" value="1" <?php if($row['menu']['content_'.$val['id']]==1){echo 'checked';}?>>允许显示菜单 </label>&nbsp;&nbsp;
        <!--  -->
        <label><input type="radio" name="menu[content_<?php echo $val['id'];?>]" value="0" <?php if(empty($row['menu']['content_'.$val['id']])){echo 'checked';}?>> 拒绝 </label>
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft"></td>
      <td></td>
     </tr>
      <?php endforeach;?>
     </tbody>
   </table>
  </div>
   
<?php foreach ($dbg_menu as $val):?>
   <div id="tab_<?php echo $val['modules']?>" class="dbgms_tab" style="display: none;">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">选择：</td>
      <td><a class="dbgms_btn" onclick="selectall('tab_<?php echo $val['modules']?>','ok');" href="javascript:void(0);">全选</a> <a class="dbgms_btn" onclick="selectall('tab_<?php echo $val['modules']?>','no');" href="javascript:void(0);">取消</a></td>
     </tr>
     <?php foreach ($val['controllers'] as $con):?>
      <tr>
      <td class="ft"><b><?php echo $con['name'];?></b>：</td>
      <td>
       <div>
        <label><input type="radio" name="menu[<?php echo $val['modules'].'_'.$con['con'];?>]" value="1" <?php if($row['menu'][$val['modules'].'_'.$con['con']]==1){echo 'checked';}?>>允许显示菜单 </label>&nbsp;&nbsp;
        <!--  -->
        <label><input type="radio" name="menu[<?php echo $val['modules'].'_'.$con['con'];?>]" value="0" <?php if(empty($row['menu'][$val['modules'].'_'.$con['con']])){echo 'checked';}?>> 拒绝 </label>
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft"></td>
      <td>
       <!--  
       <label> <input type="checkbox" onclick="dbgmsCheckAll('cms[]')"><b>【选】</b>
       </label>&nbsp;&nbsp; <label> <input checked type="checkbox" name="" value="list"> 列表
       </label>&nbsp;&nbsp; <label> <input checked type="checkbox" name="" value="edit"> 添加
       </label>&nbsp;&nbsp; <label> <input checked type="checkbox" name="" value="update"> 编辑
       </label>&nbsp;&nbsp; <label> <input checked type="checkbox" name="" value="delete"> 删除
       </label>&nbsp;&nbsp; <label> <input checked type="checkbox" name="" value="other"> 其他...
       </label>&nbsp;&nbsp;-->
      </td>
     </tr>
      <?php endforeach;?>
     </tbody>
   </table>
  </div>
<?php endforeach;?>  
   <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a>
  </div>
 </form>
 <script>
var selectall = new function(){}; 
window.selectall = function selectall(tabid,type){
 if(type=="ok"){
	 $("#"+tabid + " input[type=radio][value=1]").attr("checked",true);
	 $("#"+tabid + " input[type='checkbox']").attr("checked",true);
 }else{
	 $("#"+tabid + " input[type=radio][value=0]").attr("checked",true);
	 $("#"+tabid + " input[type='checkbox']").removeAttr("checked");
 }
}
 
</script>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a href="<?php echo $con_url;?>">管理组</a></span>
  <!--  -->
  <span class="span_r"><a class="dbgms_btn" href="<?php echo $con_url;?>&act=edit">添加权限</a></span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th width="5%">ID</th>
    <th width="10%">名称</th>
    <th width="10%">图标</th>
    <th width="10%">cms</th>
    <th width="10%">crm</th>
    <th width="10%">tool</th>
    <th>是否禁用</th>
    <th>发送私信</th>
    <th class="lst">操作</th>
   </tr>
  </thead>
  <tbody>
   <?php foreach ($list as $val):?>
	 <tr id="tr<?php echo $val['id'];?>">
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['name'];?></td>
    <td><?php echo $val['icon'];?></td>
    <td>cms内容管理</td>
    <td>crm成员管理</td>
    <td>tool功能</td>
    <td><?php echo $val['disable']==1?'<a style="background:#DADADA;" onclick="dbgmsDisable('.$val['id'].',0)">启用</a>':'<a onclick="dbgmsDisable('.$val['id'].',1)">禁用</a>';?></td>
    <td><?php echo $val['sendpm']==1?'[ √ ]':'[ × ]';?></td>
    <td><a href="<?php echo $con_url.'&act=edit&id='.$val['id'] ;?>">修改</a><a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a></td>
   </tr>
     <?php endforeach;?>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
 <script type="text/javascript">
  function dbgmsDisable(disableId, disableVal) {
		var ajaxurl = '<?php echo $con_url;?>';
		$.ajax({
			url : ajaxurl + '&act=disable&val=' + disableVal + '&id=' + disableId,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					location.href = ajaxurl;
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
 </script>
<?php endif;?> 
 </div>
