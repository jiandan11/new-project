<style>
/*    .invisible{
        display: none;
    }*/
</style>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $curr_url;?>">富表单元素验证规则列表</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 创建
 </h2>
</div>
<!--  -->
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
  <input type="hidden" readonly="readonly" value="edit" name="act" />
  <input type="hidden" readonly="readonly" value="<?php echo $row['regid'];?>" name="regid" />
  <div id="tab1" style="display: block;" class="dbgms_tab">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">验证规则名称：</td>
      <td>
       <div class="hpft">
           <input type="text" class="itxt biaoci" name="regname" id="title" style="width: 474px" value="<?php echo $row['regname'];?>">
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">验证类型选择：</td>
      <td>
       <div class="hpft">
           <select name="regtype" class="regtype">
               <option value="1" <?php if($row['regtype'] == 1):?>selected="selected"<?php endif;?>>函数</option>
               <option value="2" <?php if($row['regtype'] == 2):?>selected="selected"<?php endif;?>>正则</option>
           </select>
       </div>
      </td>
     </tr>
     <tr class="invisible" id="function">
      <td class="ft">函数：</td>
      <td>
       <div class="hpft">
           <select name="function">
               <option value="" id="function1">&nbsp;</option>
               <option value="trim" <?php if($row['function'] == "trim"):?>selected="selected"<?php endif;?>>trim</option>
               <option value="is_numeric" <?php if($row['function'] == "is_numeric"):?>selected="selected"<?php endif;?>>is_numeric</option>
               <option value="is_int" <?php if($row['function'] == "is_int"):?>selected="selected"<?php endif;?>>is_int</option>
               <option value="!empty" <?php if($row['function'] == "!empty"):?>selected="selected"<?php endif;?>>!empty</option>
           </select>
       </div>
      </td>
     </tr>
     <tr class="invisible" id="expression">
      <td class="ft">正则表达式：</td>
      <td>
       <div class="hpft">
           <input type="text" class="itxt biaoci" name="expression" value="<?php echo htmlspecialchars($row['expression']);?>" id="expression1" style="width: 474px">
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">验证失败提示语：</td>
      <td>
       <div class="hpft">
            <input type="text" class="itxt biaoci" name="prompt" value="<?php echo $row['prompt'];?>" id="prompt" style="width: 474px" placeholder="验证失败提示语">
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">规则描述：</td>
      <td>
       <div class="hpft">
        <textarea name="description" id="title" style="width: 474px" rows="3" cols="20"><?php echo $row['description'];?></textarea>
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
//    $('#function').attr('class','');
//    $(function(){
//        $('.regtype').change(function(){
//            if($(this).val() == 1){
//                $('#expression').attr('class','invisible');
//                $('#expression1').attr('value','');
//                $('#function').attr('class','');
//            }else if($(this).val() == 2){
//                $('#function').attr('class','invisible');
//                $('#function1').attr('selected','selected');
//                $('#expression').attr('class','');
//            }
//        });
//    });
    
    function cmsContentUpdate(){ 	  
      $.ajax({ 
        url:"<?php echo $edit_url;?>",
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