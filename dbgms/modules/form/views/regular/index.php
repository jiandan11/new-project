<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $add_url;?>">创建规则</a></span>
  <div class="span_r">
   <form name="DbgMsFormSearch" id="DbgMsFormSearch" action="<?php echo $curr_url;?>" method="get">
    <input type="hidden" name="con" value="regular" />
    <input type="text" name="q" class="titxt" value="<?php echo $q;?>" placeholder="请输入规则名"  style="width: 250px"> &nbsp;
    <input type="submit" value="搜索 " class="dbgms_btn">
   </form>
  </div>
 </div>
 <table class="tblist">
  <thead>
   <tr class="list">
    <th width="5%">规则regid</th>
    <th width="10%">规则名称</th>
    <th width="10%">规则类型</th>
    <th width="30%">规则行为</th>
    <th width="8%">改动时间</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key =>$val):?>
   <tr id="tr<?php echo $val['regid'];?>">
    <td><?php echo $val['regid'];?></td>
    <td><?php echo $val['regname'];?></td>
    <td>
        <?php 
        if($val['regtype'] == 1){
            echo '函数';
        }elseif($val['regtype'] == 2){
            echo '正则';
        }
        ?>
    </td>
    <td>
        <?php 
        if($val['regtype'] == 1){
            echo $val['function'];
        }elseif($val['regtype'] == 2){
            echo $val['expression'];
        }
        ?>
    </td>
    <td><?php echo get_time_deviation($val['operatetime']);?></td>
    <td>
        <a href="<?php echo $curr_url.'&page='.$page.'&act=edit&regid='. $val['regid'];?>">【修改】</a>
        <a onclick="dbgmsDelete('<?php echo $delete_url.$val['regid'];?>')">【删除】</a>
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