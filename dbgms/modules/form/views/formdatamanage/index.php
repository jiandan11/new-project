<style>
    #DbgMsFormSearch select{width:160px;height:26px;}
    .export{border: 1px solid green;border-radius: 10px;float: right;margin: 5px;padding: 5px;}
</style>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l">【<?php echo $basedata['rfname'];?>】表单数据管理</span>
  <div class="export"><a href="<?= $exportformdata_url;?>&rfid=<?= $rfid.'&q_sql='.$q_sql;?>">导出当前搜索结果的数据</a></div>
  <div class="span_r">
   <form name="DbgMsFormSearch" id="DbgMsFormSearch" action="<?php echo $con_url;?>" method="get">
    <input type="hidden" name="con" value="formdatamanage" />
    <input type="hidden" name="rfid" value="<?=$rfid;?>" />
    <select name="keytag">
        <?php foreach ($needshowfields as $key => $value):?>
        <option value="<?php echo $value['attrname'];?>" <?php if($value['attrname'] == $keytag):?>selected="selected"<?php endif;?> ><?= $value['nametag'];?></option>
        <?php endforeach;?>
    </select>
    <input type="text" name="q" class="titxt" value="<?php echo $q;?>" placeholder="请输入关键字,搜索时间输入类似:2016-08-01" style="width: 300px"> &nbsp;
    <input type="submit" value="搜索 " class="dbgms_btn">
   </form>
  </div>
 </div>
 <table class="tblist">
  <thead>
   <tr class="list">
    <?php foreach ($needshowfields as $key => $value):?>
        <th><?php echo $value['nametag'];?></th>
    <?php endforeach;?>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key =>$val):?>
   <tr id="tr<?php echo $val['id'];?>">
    <?php foreach ($needshowfields as $key1 => $value1):?>
        <?php if($value1['attrname'] == 'operatetime'):?>
            <td><?php echo get_time_deviation($val[$value1['attrname']]);?></td>
        <?php else:?>
            <td><?php echo $val[$value1['attrname']];?></td>
        <?php endif;?>
    <?php endforeach;?>
    <td>
<!--        <a href="<?php //echo $curr_url.'&page='.$page.'&act=viewdetail&rfid='.$rfid.'&id='. $val['id'];?>">【查看详情】</a>-->
        <a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'].'&rfid='.$rfid;?>')">【删除】</a>
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