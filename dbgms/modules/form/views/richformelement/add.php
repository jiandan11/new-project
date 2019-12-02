
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $curr_url;?>">富表单元素列表</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 创建
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
      <td class="ft">富表单元素名称：</td>
      <td>
       <div class="hpft">
           <input type="text" class="itxt biaoci" name="rname" id="name" style="width: 474px" placeholder="请输入富表单元素名称">
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">选择基本表单标签：</td>
      <td>
       <div class="hpft">
        <select name="bid" id="DbgMsColumnSelect" onchange="visiblespan()">
           <option value="0">&nbsp;&nbsp;-&nbsp;&nbsp;请选择</option>
           <?php foreach ($tags as $key => $value) :?>
           <option value="<?php echo $key;?>"><?php echo $value['type'];?>--<?php echo $value['description'];?></option>
           <?php endforeach;?>
        </select>
        <?php //foreach ($tags as $key => $value) :?>
<!--        <span id="description<?php //echo $key;?>" style="display:none;" class="description"><?php //echo $value['description'];?></span>-->
        <?php //endforeach;?>
<!--        <script>
            function visiblespan(){
                var value = $("#DbgMsColumnSelect").children('option:selected').val();
                if(value != 0){
                    $(".description").attr('style','display:none;');
                    $("#description"+value).attr('style','display:inline;');
                }
            }
        </script>-->
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">选择风格组：</td>
      <td>
       <div class="hpft">
        <select name="gid" id="groupDbgMsColumnSelect" onchange="visiblespan()">
           <option value="0">&nbsp;&nbsp;-&nbsp;&nbsp;非必选</option>
           <?php foreach ($groups as $key => $value) :?>
           <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?>--<?php echo $value['description'];?></option>
           <?php endforeach;?>
        </select>
        <?php foreach ($groups as $key => $value) :?>
        <span id="groupdescription<?php echo $value['id'];?>" style="display:none;" class="groupdescription"><?php echo $value['description'];?></span>
        <?php endforeach;?>
        <script>
            function visiblespan(){
                var value = $("#groupDbgMsColumnSelect").children('option:selected').val();
                if(value != 0){
                    $(".groupdescription").attr('style','display:none;');
                    $("#groupdescription"+value).attr('style','display:inline;');
                }
            }
        </script>
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">此富表单元素描述：</td>
      <td>
       <div class="hpft">
           <textarea name="description" id="title" style="width: 474px" rows="3" cols="20" maxlength="96"></textarea>
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">此富表单的样式style：</td>
      <td>
       <div class="hpft">
           <textarea name="attrstyle" id="title" style="width: 474px" rows="3" cols="20" maxlength="96" placeholder="可不填，输入类似 style='background-color:red;'"></textarea>
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
            location.href='<?php echo $curr_url.'&page='.$page;?>';
            return;
          }else{
            alert(result);
          }
        }
      });
    }
</script>
</div>