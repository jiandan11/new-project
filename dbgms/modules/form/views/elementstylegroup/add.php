
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $curr_url;?>">富表单元素风格组列表</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 创建
 </h2>
</div>
<!--  -->
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
  <input type="hidden" readonly="readonly" value="add" name="act" />
  <div id="tab1" style="display: block;" class="dbgms_tab">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">富表单元素风格组名称：</td>
      <td>
       <div class="hpft">
        <input type="text" class="itxt biaoci" name="name" id="title" style="width: 474px" value="<?php echo $row['name'];?>">
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">风格组描述：</td>
      <td>
       <div class="hpft">
        <textarea name="description" id="title" style="width: 474px" value="<?php echo $row['description'];?>" rows="3" cols="20"></textarea>
       </div>
      </td>
     </tr>
    </tbody>
   </table>
  </div>
  <div style="margin-left: 150px; margin-top: 30px; height: 100px;">
   <a class="dbgms_btn_submit" onclick="cmsContentUpdate()" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $curr_url;?>">返回列表</a>
  </div>
 </form>
<script type="text/javascript">
    function cmsContentUpdate(){ 	  
      $.ajax({ 
        url:"<?php echo $add_url;?>",
        type:"POST",
        data:$('#DbgMsFormEdit').serialize(),
        success:function(result){
          if(result==1){
            alert("成功!");
            location.href='<?php echo $curr_url;?>';
            return;
          }else{
            alert(result);
          }
        }
      });
    }
</script>
</div>