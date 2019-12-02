<style>
.fieldlab {
	border: 1px solid #7DC8FF;
	background: #F4FAFF;
	padding: 0 10px 8px 10px;
	width: 540px;
}

.fieldlab p {
	padding-top: 8px;
	width: 100%;
	display: inline-block;
	float: left;
}

table.subtab tr td.ft {
	width: 240px
}

table.subtab tr td.ft b {
	font-weight: normal;
	color: #999
}
</style>
<div class="dbg_warp">
 <div class="dbg_nav" id="dbg_nav">
  <ul>
   <li><a href="<?php echo $con_url;?>&sign=base" <?php if($sign=="base"){echo 'class="active"';}?>>基本设置</a></li>
   <li><a href="<?php echo $con_url;?>&sign=email" <?php if($sign=="email"){echo 'class="active"';}?>>邮箱设置</a></li>
   <li><a href="<?php echo $con_url;?>&sign=ftp" <?php if($sign=="ftp"){echo 'class="active"';}?>>FTP设置</a></li>
   <li><a href="<?php echo $con_url;?>&sign=group" <?php if($sign=="group"){echo 'class="active"';}?>>权限设置</a></li>
   <li><a href="<?php echo $con_url;?>&sign=seo" <?php if($sign=="seo"){echo 'class="active"';}?>>SEO设置</a></li>
   <li><a href="<?php echo $con_url;?>&sign=file" <?php if($sign=="file"){echo 'class="active"';}?>>上传设置</a></li>
   <li><a href="<?php echo $con_url;?>&sign=images" <?php if($sign=="images"){echo 'class="active"';}?>>图片设置</a></li>
   <li><a href="<?php echo $con_url;?>&sign=diy" <?php if($sign=="diy"){echo 'class="active"';}?>>自定义设置</a></li>
  </ul>
 </div>
 <form id="tool_set_form" name="tool_set_form">
  <input type="hidden" name="act" value="update" /> <input type="hidden" name="sign" value="<?php echo $sign;?>" />
  <table class="tblist" id="diytab">
   <thead>
    <tr>
     <th width="5%">ID</th>
     <th width="12%">标识</th>
     <th width="20%">描述</th>
     <th width="15%">键</th>
     <th>内容</th>
     <th width="15%">操作</th>
    </tr>
   </thead>
   <tbody>
     <?php foreach ( $config_info as $k=>$val):?>
     <tr id="tr<?php echo $val ['id'];?>">
     <td class="edittd" data-name="config_id[]"><?php echo $val ['id'];?></td>
     <td class="edittd" data-name="config_sign[]"><?php echo $val ['sign'];?></td>
     <td class="edittd" data-name="config_name[]"><?php echo $val ['name'];?></td>
     <td class="edittd" data-name="config_key[]"><?php echo $val ['key'];?></td>
     <td class="edittd" data-name="config_value[]"><?php echo $val ['value'];?></td>
     <td><a class="editbtn" onclick="diy_table('diytab',this,'<?php echo $val ['id'];?>')">编辑</a> <a onclick="config_save()">保存</a> <a onclick="del('<?php echo $val ['id'];?>')">删除</a></td>
    </tr>
     <?php endforeach;?>
    </tbody>
   <tfoot>
    <tr>
     <td colspan="8" align="center"><a id="editall" onclick="diy_table_all('diytab',this)" class="dbgms_btn">全部编辑</a> <a id="editall" onclick="config_save()" class="dbgms_btn">全部保存</a> <a class="dbgms_btn" onclick="diy_table_add('diytab',this)">新增一个配置</a></td>
    </tr>
   </tfoot>
  </table>
 </form>
      	<?php
							// for ( $i = 0; $i < count ( $config_info ); $i ++) {
							// foreach ( $config_info [$i] as $k => $v ) {
							// if ( $k == 'aid') {
							// $aid = $v;
							// }
							// if ( $k == 'info') {
							// $info = $v;
							// }
							// if ( $k == 'value') {
							// $value = $v;
							// }
							// }
							// echo '<tr><td style="width: 200px;">' . $info . '</td><td style="width: 500px;">
							// <input type="text" value="' . $value . '" name="' . $aid . '" style="width: 480px;"></td></tr>';
							// }
							?>
  <script type="text/javascript">
var is_update =true;
function diy_table(table_id,object,config_id){
	 
	if($(object).html()=="编辑"){
		$(object).closest('td').siblings('.edittd').html(function(i,html){
			if($(this).attr('data')!=undefined){
				$(this).html('<input type="text" style="padding:2px;width:95%;" name="'+ $(this).attr('data-name') +'" value="'+$(this).html()+'" />'); 
			}else{
				$(this).html('<input type="text" style="padding:2px;width:95%;" value="'+$(this).html()+'" />');
			}
			$(this).addClass('on');
		});
		$(object).html('取消');
		diy_table_if(table_id);
	}else if($(object).html()=="取消"){
		$(object).closest('td').siblings().each(function(i,v){
			  $(this).html($(this).find(':text').val());
			  $(this).removeClass('on');
		 });
  		 $(object).html('编辑');
  		diy_table_if(table_id);
	}
}
function diy_table_add(table_id,object,config_id){
	var html='<tr>'
    +'<td ></td>'
    +'<td class="edittd" data-name="config_sign[]"><?php echo $sign;?></td>'
    +'<td class="edittd" data-name="config_name[]"></td>'
    +'<td class="edittd" data-name="config_key[]"></td>'
    +'<td class="edittd" data-name="config_value[]"></td>'
    +'<td><a class="editbtn" onclick="diy_table(\'diytab\',this)">编辑</a> <a onclick="config_save()">保存</a> <a onclick="del()">删除</a></td>'
   +'</tr>';
	 //获取table最后一行 $("#tab tr:last")
     //获取table第一行 $("#tab tr").eq(0)
     //获取table倒数第二行 $("#tab tr").eq(-2)
   var $tr=$("#"+table_id+" tbody tr:last");
   //获取table第一行 $("#tab tr").eq(0)
   //获取table倒数第二行 $("#tab tr").eq(-2)
   //var $tr=$("#"+tab+" tr").eq(row);
   if($tr.size()==0){
	   $("#"+table_id+" tbody").append(html);
   }else{
	   $tr.after(html);
   }
}
function diy_table_all(table_id,object,config_id){
	if($(object).html()=="全部编辑"){
		$('#'+table_id).find('.edittd').each(function(i,val){ 
			//jq ---$(this).text() 和 $(this).html()
			//var obj = document.getElementById("td1");
			//alert(obj.innerText);
			if($(this).attr('data-name')!=undefined){
				$(this).html('<input type="text" style="padding:2px;width:95%;" name="'+ $(this).attr('data-name') +'" value="'+$(this).html()+'" />'); 
			}else{
				$(this).html('<input type="text" style="padding:2px;width:95%;" value="'+$(this).html()+'" />');
			}
			$(this).next().find('.editbtn').html('取消');
			$(this).addClass('on');
		});
		$(object).html("全部取消");
		is_update=false;
	}else if($(object).html()=="全部取消"){
  		$('#'+table_id).find('.edittd').each(function(i,val){
	  		$(this).html($(this).find(':text').val());
	  		$(this).next().find('.editbtn').html('编辑');
			$(this).removeClass('on');
  		});
  		$(object).html('全部编辑');
  		is_update=true;
	}
}	
function diy_table_if(table_id){
	$('#'+table_id).find('.edittd').each(function(i,val){ 
		if(!$(this).hasClass('on')){
			$('#editall').html('全部编辑');
			is_update=true;
		}
		if($(this).hasClass('on')){
			$('#editall').html('全部取消');
			is_update=false;
			return false;
		}
	});
}


/*提交*/
function config_save(){
	if(is_update){alert('未做修改~无需保存!');return false;}
	var str_data=$("#tool_set_form tr input").map(function(){
		 return ""+ $(this).attr("name")+"=" + $(this).val();
	}).get().join("&");
	$.ajax({
		url:"<?php echo $con_url;?>&act=update&sign=<?php echo $sign;?>&"+str_data,
		success:function(result){
			if(result == 1){
				alert("成功!");
				location.href='<?php echo base_url().'index?act=index';?>';
				return;
			}else{
				alert(result);
			}
		}
	});
}
</script>
</div>
