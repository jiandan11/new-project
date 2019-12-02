<?php if($act=='sendpm'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">管理员</a><font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 发送私信
 </h2>
</div>
<div class="dbg_warp">
 <form method="post" id="admin_email" name="admin_email">
  <input type="hidden" name="id" value="<?php echo $row['id'];?>"> <input type="hidden" readonly="readonly" value="sendemail" name="act">
  <table class="subtab">
   <tbody>
    <tr>
     <td class="ft">发件人：</td>
     <td><input type="text" name="name" class="itxt" value="<?php echo $_admin['name'];?>" style="width: 460px; color: gray" readonly></td>
    </tr>
    <tr>
     <td class="ft">发件邮箱：</td>
     <td><input type="text" name="email" class="itxt" value="<?php echo $_admin['email'];?>" style="width: 460px; color: gray" readonly></td>
    </tr>
    <tr>
     <td class="ft">收件邮箱：</td>
     <td><input type="text" name="toemail" class="itxt" value="<?php echo $toemail;?>" style="width: 460px"></td>
    </tr>
    <tr>
     <td class="ft">主题：</td>
     <td><input type="text" name="subject" class="itxt" value="" style="width: 460px"></td>
    </tr>
    <tr>
     <td class="ft">正文：</td>
     <td><textarea name="content" class="rtxt" style="width: 460px; height: 300px;"></textarea></td>
    </tr>
   </tbody>
  </table>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('admin_email','<?php echo $con_url;?>')" href="javascript:;">确认提交</a><a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a>
  </div>
 </form>
</div>
<?php elseif($act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">管理员</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
</div>
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit">
  <input type="hidden" readonly="readonly" value="<?php echo $row['id'];?>" name="id"><input type="hidden" readonly="readonly" value="update" name="act">
  <table class="subtab">
   <tbody>
    <tr>
     <td class="ft">登录账号：</td>
     <td><input type="text" name="name" class="itxt" value="<?php echo $row['name'];?>" <?php echo empty($row['name'])?"":'style="color: #999;" readonly="readonly"';?>></td>
    </tr>
    <tr>
     <td class="ft">作者：</td>
     <td><input type="text" name="alias" class="itxt" value="<?php echo $row['alias'];?>"></td>
    </tr>
    <tr>
     <td class="ft">Email：</td>
     <td><input type="text" name="email" class="itxt" value="<?php echo $row['email'];?>"></td>
    </tr>
    <tr>
     <td class="ft">重设密码：</td>
     <td><input type="text" name="pwd" class="itxt"></td>
    </tr>
    <tr>
     <td class="ft">组别(权限)：</td>
     <td><select class="tsel" name="groupid" style="width: 140px">
 		<?php foreach ( $grouplist as $val):?>
         <option <?php echo $row['groupid']==$val['id']?'selected=""':"";?> value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
       	<?php endforeach;?>
       	</select></td>
    </tr>
    <tr>
     <td class="ft">是否必须：</td>
     <td><label><input type="radio" name="ismust" value="1" <?php echo $row['ismust']==1?'checked':"";?>>是</label>&nbsp;&nbsp; <label><input type="radio" name="ismust" value="0" <?php echo $row['ismust']==0?'checked':"";?>>否</label></td>
    </tr>
    <tr>
     <td class="ft">Q Q：</td>
     <td><input type="text" name="qq" class="itxt" value="<?php echo $row['qq'];?>" style="width: 120px;"></td>
    </tr>
    <tr>
     <td class="ft">统计信息：</td>
     <td>
      <ul>
       <li><a href="#">文档总数：0</a></li>
       <li>注册时间：<?php echo date('Y-m-d H:i',$row['regtime']);?>&nbsp;&nbsp;&nbsp;&nbsp;注册IP：<?php echo $row['regip'];?></li>
       <li>最后登录：<?php echo date('Y-m-d H:i',$row['logintime']);?>&nbsp;&nbsp;&nbsp;&nbsp;登录IP：<?php echo $row['loginip'];?></li>
      </ul>
     </td>
    </tr>
   </tbody>
  </table>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a>
  </div>
 </form>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a href="<?php echo $con_url;?>">管理组</a></span>
  <!--  -->
  <span class="span_r"><a class="dbgms_btn" href="<?php echo $con_url;?>&act=edit">添加管理员</a></span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th width="5%">ID</th>
    <th width="10%">用户名</th>
    <th width="15%">Email</th>
    <th>权限</th>
    <th width="10%">最后登录IP</th>
    <th width="10%">最后登录时间</th>
    <th>是否必须</th>
    <th>是否禁用</th>
    <th width="20%" class="lst">操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ( $list as $val):?>
	 <tr id="tr<?php echo $val['id'];?>">
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['name'];?></td>
    <td><?php echo $val['email'];?></td>
    <td><?php echo $val['groupname'];?></td>
    <td><?php echo $val['loginip'];?></td>
    <td><?php echo get_time_deviation($val['logintime']);?></td>
    <td><?php echo $val['ismust']==1?'[ √ ]':'[ × ]';?></td>
    <td><?php echo $val['disable']==1?'<a style="background:#DADADA;" onclick="dbgmsDisable('.$val['id'].',0)">启用</a>':'<a onclick="dbgmsDisable('.$val['id'].',1)">禁用</a>';?></td>
    <td><a href="<?php echo $con_url.'&act=edit&id='.$val['id'];?>">修改</a> <a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a> <a href="<?php echo $con_url.'&act=sendpm&email='.$val['email']?>">发送私信</a></td>
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
</div>
<?php endif;?>
