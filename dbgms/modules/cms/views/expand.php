<?php if($act=='manageedit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url.'&act=manage&id='.$row['expandid'];?>">多维栏目属性分类</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">基本信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">高级设置</a></li>
 </ul>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
  <input type="hidden" readonly="readonly" value="<?php echo $row['id']?>" name="id"> <input type="hidden" readonly="readonly" value="<?php echo $row['expandid']?>" name="expandid"> <input type="hidden" readonly="readonly" value="manageupdate" name="act">
  <fieldset>
   <!-- 网站信息 -->
   <div id="tab1" style="display: block;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft">名称：</td>
       <td><input type="text" name="title" class="itxt" value="<?php echo $row['title'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp; </font></td>
      </tr>
      <tr>
       <td class="ft">标识：</td>
       <td><input type="text" name="sign" class="itxt" value="<?php echo $row['sign'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;提示：英文字母 </font></td>
      </tr>
      <tr>
       <td class="ft">排序：</td>
       <td><input type="text" name="rank" class="itxt" value="<?php echo $row['rank'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp; </font></td>
      </tr>
      <tr>
       <td class="ft">类型：</td>
       <td><label><input type="radio" name="type" value="0" <?php echo $row['type']==0?'checked':NULL;?>>单选</label>&nbsp;&nbsp; <label><input type="radio" name="type" value="1" <?php echo $row['type']==1?'checked':NULL;?>>多选</label></td>
      </tr>
      <tr>
       <td class="ft">多维参数：</td>
       <td><textarea class="rtxt" name="config" style="height: 300px;"><?php echo $row['config'];?></textarea> &nbsp;*&nbsp; <font style="color: #999">&nbsp;&nbsp;相关选项参考(value|name)，每个相关参数，单独一行;如：(1|描述)</font></td>
      </tr>
     </tbody>
    </table>
   </div>
  </fieldset>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>','<?php echo $con_url.'&act=manage&id='.$row['expandid'];?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>&act=manage">返回列表</a>
  </div>
 </form>
</div>
<?php elseif($act=='manage'):?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"> <a class="dbgms_btn" href="<?php echo $con_url;?>&act=manageedit">新增属性</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回</a>
  </span> <span class="span_r"> <input type="button" value="更新所有缓存" class="dbgms_btn" onclick="upcache()">
  </span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th>选</th>
    <th>ID</th>
    <th>属性名称</th>
    <th>属性英文名</th>
    <th>顺序</th>
    <th width="20%">内容</th>
    <th>类型</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key=>$val):?>
<tr id="tr<?php echo ($key+1);?>">
    <td><input type="checkbox" value="<?php echo $val['id'];?>" name="ids[]"></td>
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['title'];?></td>
    <td><?php echo $val['sign'];?></td>
    <td><?php echo $val['rank'];?></td>
    <td><?php echo $val['config']?></td>
    <td><?php echo $val['type'];?></td>
    <td>
     <div>
      <a href="<?php echo $con_url.'&act=manageedit&id='.$val['id'];?>">编辑</a>
      <!--  -->
      <a onclick="dbgmsDelete('<?php echo $con_url.'&act=managedelete&id='.$val['id']?>')">删除</a>
     </div>
    </td>
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
<?php elseif($act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">多维栏目管理</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">基本信息</a></li>
 </ul>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
  <input type="hidden" readonly="readonly" value="<?php echo $row['id']?>" name="id"><input type="hidden" readonly="readonly" value="update" name="act">
  <fieldset>
   <!-- 网站信息 -->
   <div id="tab1" style="display: block;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft">名称：</td>
       <td><input type="text" name="title" class="itxt" value="<?php echo $row['title'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp; </font></td>
      </tr>
      <tr>
       <td class="ft">表单：</td>
       <td><input type="text" name="table" class="itxt" value="<?php echo $row['table'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;提示：英文字母 </font></td>
      </tr>
     </tbody>
    </table>
   </div>
  </fieldset>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a>
  </div>
 </form>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"> <a class="dbgms_btn" href="<?php echo $con_url;?>&act=edit">新增多维分类</a>
  </span> <span class="span_r"> <input type="button" value="更新所有缓存" class="dbgms_btn" onclick="upcache()">
  </span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th>选</th>
    <th>ID</th>
    <th>名称</th>
    <th>表单</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key=>$val):?>
<tr id="tr<?php echo $val['id'];?>">
    <td><input type="checkbox" value="<?php echo $val['id'];?>" name="ids[]"></td>
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['title'];?></td>
    <td><?php echo $val['table'];?></td>
    <td>
     <div>
      <a href="<?php echo $con_url.'&act=manage&id='.$val['id'];?>">管理</a>
      <!--  -->
      <a href="<?php echo $con_url.'&act=edit&id='.$val['id'];?>">编辑</a><a onclick="dbgmsDelete('<?php echo $con_url.'&act=delete&id='.$val['id']?>')">删除</a>
     </div>
    </td>
   </tr>
<?php endforeach;?>
  <tr class="btm">
    <td><input type="checkbox" id="checkall" onclick="dbgmsCheckAll()"></td>
    <td colspan="12"></td>
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