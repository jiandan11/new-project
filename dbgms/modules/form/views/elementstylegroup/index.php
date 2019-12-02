<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $curr_url;?>&act=add">创建风格组</a></span>
 </div>
 <table class="tblist">
  <thead>
   <tr class="list">
    <th>风格组id</th>
    <th>风格组名</th>
    <th>风格组描述</th>
    <th>操作时间</th>
    <th width="30%">操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key =>$val):?>
   <tr id="tr<?php echo $val['id'];?>">
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['name'];?></td>
    <td><?php echo $val['description'];?></td>
    <td><?php echo get_time_deviation($val['operatetime']);?></td>
    <td><a href="<?php echo $curr_url.'&page='.$page.'&act=edit&id='. $val['id'];?>">【编辑】</a>
<!--        <a href="<?php echo $curr_url.'&page='.$page.'&act=member&id='. $val['id'];?>">【查看基本表单元素成员】</a>-->
        <a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a></td>
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
 <script type="text/javascript">
 function cmsContentSearch(key, val) {
		key = key || '';
		val = val || '';
		if (key != '' && val != '') {
			$('#autokey').val(key);
			$('#autoval').val(val);
		} else {
			$('#autokey').add($('#autoval')).val('');
		}
		document.DbgMsFormSearch.submit();
	}
	function cmsContentOrder(field) {
		if ($('#orderby').val() == field) {
			$('#orderdesc').val($('#orderdesc').val().toUpperCase() == 'DESC' ? 'ASC' : 'DESC');
		} else {
			$('#orderby').val(field);
			$('#orderdesc').val('ASC');
		}
		cmsContentSearch();
	}   
    </script>
</div>