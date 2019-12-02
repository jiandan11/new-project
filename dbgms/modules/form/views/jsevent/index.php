<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $add_url;?>">创建事件</a></span>
  <div class="span_r">
   <form name="DbgMsFormSearch" id="DbgMsFormSearch" action="<?php echo $curr_url;?>" method="get">
    <input type="hidden" name="con" value="regular" />
    <input type="text" name="q" class="titxt" value="<?php echo empty($search['q'])?'请输入事件名称':$search['q'];?>"
           onfocus="if (value =='请输入事件名称'){value=''}" onblur="if (value ==''){value='请输入事件名称'}" style="width: 250px"> &nbsp;
    <input type="button" value="搜索 " class="dbgms_btn" onclick="cmsContentSearch()">
   </form>
  </div>
 </div>
 <table class="tblist">
  <thead>
   <tr class="list">
    <th width="5%">事件jseid</th>
    <th width="10%">事件名称</th>
    <th width="10%">事件名</th>
    <th width="10%">函数名</th>
    <th width="8%">改动时间</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key =>$val):?>
   <tr id="tr<?php echo $val['jseid'];?>">
    <td><?php echo $val['jseid'];?></td>
    <td><?php echo $val['jsename'];?></td>
    <td><?php echo $val['eventname'];?></td>
    <td><?php echo $val['functionname'];?></td>
    <td><?php echo get_time_deviation($val['operatetime']);?></td>
    <td>
        <a href="<?php echo $curr_url.'&page='.$page.'&act=edit&jseid='. $val['jseid'];?>">【修改】</a>
        <a onclick="dbgmsDelete('<?php echo $delete_url.$val['jseid'];?>')">【删除】</a>
    </td>
   </tr>
<?php endforeach;?>
      <tr class="btm">
   </tr>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
</div>