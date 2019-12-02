<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td><input type="text" name="<?php echo $field['field'];?>" class="itxt" value="<?php echo $field['value'];?>">
  <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
 <?php endif;?>
 </td>
</tr>
<script type="text/javascript">

//当插入上传音乐时候
function form_change(path) {
 // document.getElementById('upload_submit1').click();
 $(document).ready(function() {
  var options = {
   url : "<?php echo base_url('use/upload/return_info');?>",// 后台的处理，也就是form里的action
   type : "POST",
   dataType : "json",
   success : function(data) {
    if (data.type == "no") {
     alert("格式错误,请选择mp3或者wma格式！");
     $('#zhw_upload').val("");
    } else {
     $('#song').val(data.song);
     $('#artistID').val(data.artistID);
     alert("确定无误后.可以上传音乐！");
    }
   }
  };
  $('#upload_form').ajaxSubmit(options);
  // ！重要的！---总是返回false，以防止标准的浏览器提交和页面导航
  return false; // 为了防止刷新
 });
}
//插入数据库
function ajaxSubmit_sql_oss() {
 if ($('#zhw_upload').val() == "") {
  alert('音乐文件不能为空,请选择!');
  return;
 } else if ($('#song').val() == "") {
  alert('歌名不能为空,请填写!');
  return;
 } else if ($('#artistID').val() == "") {
  alert('歌手不能为空,上传失败!');
  return;
 }
 $(document).ready(function() {
  var options = {
   url : "<?php echo base_url('dbgcms/music/sql/insert_oss');?>",// 后台的处理，也就是form里的action
   type : "POST",
   dataType : "text",
   beforeSend : function() {
    $('#upload_window22').show();
    // $('#upload_window22').html("<div
    // id='upload-load-image'></div>");
    // $('#upload-load-image').css("display","block");//加载前显示loading
   },
   success : function(data) {
    if (data == "ok") {
     $('#upload_window22').hide();// 加载成功后隐藏loading
     // $('#upload_window22').css("display","none");
     // $('#upload-load-image').remove();//移除
     // $('#upload-load-image').empty();//删除所有子节点
     // $('#upload_window22').html(data);
     alert('上传成功！');
     location.href = '<?php echo base_url("dbgcms/music");?>';
    } else if (data == "no") {
     alert('插入数据错误！');
    } else if (data == "category") {
     alert('用户权限不够,请联系管理员！');
     location.href = '<?php echo base_url("dbgcms/music");?>';
     return;
    }
   }
  };
  $('#upload_form').submit(function() {
   $(this).ajaxSubmit(options);
   // ！重要的！---总是返回false，以防止标准的浏览器提交和页面导航
   return false; // 为了防止刷新
  });
 });
}</script>