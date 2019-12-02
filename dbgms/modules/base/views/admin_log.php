<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a href="<?php echo $con_url;?>">操作日志</a> </span> <span class="span_r"> <a class="dbgms_btn" href="<?php echo $con_url;?>&act=truncate&type=2">删除2天外操作日志</a> <a class="dbgms_btn" href="<?php echo $con_url;?>&act=truncate&type=all">清空操作日志</a>
  </span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th width="5%">ID</th>
    <th width="10%">管理员</th>
    <th width="15%">昵称</th>
    <th>权限</th>
    <th width="10%">操作IP</th>
    <th width="10%">操作时间</th>
    <th>操作信息</th>
   </tr>
  </thead>
  <tbody>
    <?php foreach ($list as $k=>$val):?>
	 <tr id="tr<?php echo $val['id'];?>">
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['aname'];?></td>
    <td><?php echo $val['alias'];?></td>
    <td><?php echo $val['groupname'];?></td>
    <td><?php echo $val['ip'];?></td>
    <td><?php echo get_time_deviation($val['intime']);?></td>
    <td><?php echo $val['aname'].'___'.$val['content'];?></td>
   </tr>
    <?php endforeach;?>
      </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
</div>
