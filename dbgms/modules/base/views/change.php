
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">修改密码</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
</div>
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit">
  <input type="hidden" readonly="readonly" value="<?php echo $row['id'];?>" name="id"><input type="hidden" readonly="readonly" value="update" name="act">
  <table class="subtab">
   <tbody>
    <tr>
     <td class="ft">登录账号：</td>
     <td><input type="text" name="name" class="itxt" value="<?php echo $row['name'];?>" <?php echo empty($row['name'])?"":'style="color: #999;" readonly';?>></td>
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
