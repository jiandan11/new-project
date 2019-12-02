
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l">意见反馈 </span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th>选</th>
    <th>ID</th>
    <th>反馈页面</th>
    <th>联系方式</th>
    <th>反馈内容</th>
    <th>IP</th>
    <th width="15%">浏览器信息</th>
    <th>反馈时间</th>
    <th>是否解决</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key=>$val) : ?>
	<tr id="tr<?php echo $val['id'];?>">
    <td><input type="checkbox" value="<?php echo $val['id'];?>" name="ids[]"></td>
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['url'];?></td>
    <td><?php echo $val['info'];?></td>
    <td><?php echo $val['content'];?></td>
    <td><?php echo $val['ip'];?></td>
    <td><?php echo $val['browser'];?></td>
    <td><?php echo get_time_deviation($val['uptime']);?></td>
    <td><?php echo $val ['solve']==0?'<a style="background:#DADADA;" onclick="">解决</a>':'已解决';?></td>
    <td><a onclick="edit('<?php echo $val['id'];?>')">回复</a> <a target="_blank" href="<?php echo $val['url'];?>">预览</a> <a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a></td>
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
