<?php if($act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">单页管理</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
</div>

<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit">
  <input type="hidden" readonly="readonly" value="<?php echo $row['id'];?>" name="id" />
  <!--  -->
  <input type="hidden" readonly="readonly" value="<?php echo $model['id'];?>" name="modelid" /><input type="hidden" readonly="readonly" value="update" name="act" />
  <table class="subtab">
   <tbody>
    <tr>
     <td class="ft">单页名称：</td>
     <td>
      <div class="hpft">
       <input type="text" class="itxt" name="title" value="<?php echo $row['title'];?>"> <a href="###" id="signBtn">检测唯一性</a>
      </div>
     </td>
    </tr>
    <tr>
     <td class="ft">修改时间：</td>
     <td><input type="text" class="itxt" name="uptime" value="<?php if(empty($row['uptime'])){echo date("Y-m-d H:i:s",time());}else{echo date("Y-m-d H:i:s", $row['uptime']);}?>"></td>
    </tr>
    <tr>
     <td class="ft">单页类型：</td>
     <td><select name="sign" style="width: 150px">
       <option <?php if($row['sign']=='普通'){echo 'selected=""';}?> value="普通">普通</option>
       <option <?php if($row['sign']=='其他'){echo 'selected=""';}?> value="其他">其他</option>
     </select></td>
    </tr>
<?php $diyf['form']='DbgMsFormEdit';$diyf['name']='碎片内容';$diyf['field']='content';dbg_diyfield ( 'load', 'ueditor', $diyf,$row['content'] );?>
     <tr style="height: 100px;">
     <td></td>
     <td><a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a></td>
    </tr>
   </tbody>
  </table>
 </form>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $con_url;?>&act=edit">新增单页</a></span><span class="span_r"><input type="button" value="更新所有缓存" class="dbgms_btn"> </span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th>选</th>
    <th>ID</th>
    <th>标识</th>
    <th>名称</th>
    <th>显示</th>
    <th>更新时间</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key=>$val):?>
   <tr id="tr<?php echo $val['id'];?>">
    <td><input type="checkbox" value="<?php echo $val['id'];?>" name="ids[]"></td>
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['sign'];?></td>
    <td><?php echo $val['title'];?></td>
    <td><?php echo $val['disable']==0?'<font style="color:green;font-size:16px;">√</font>':'<font style="color:red;font-size: 18px;" >×</font>';?></td>
    <td><?php echo get_time_deviation($val['uptime']);?></td>
    <td><a href="<?php echo $con_url.'&act=edit&id='.$val['id'];?>">编辑</a> <a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a></td>
   </tr>
<?php endforeach;?>
     <tr class="btm">
    <td><input type="checkbox" id="checkall" onclick="dbgmsCheckAll()"></td>
    <td colspan="12"><input type="button" value="更新缓存" class="dbgms_btn"></td>
   </tr>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
</div>
<?php endif;?>  