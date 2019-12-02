<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $addstep1_url;?>">创建富表单</a></span>
  <div class="span_r">
   <form name="DbgMsFormSearch" id="DbgMsFormSearch" action="<?php echo $curr_url;?>" method="get">
    <input type="hidden" name="con" value="richform" />
    <input type="text" name="q" class="titxt" value="<?php echo $q;?>" placeholder="请输入富表单名称或绑定产品名称" style="width: 250px"> &nbsp;
    <input type="submit" value="搜索 " class="dbgms_btn">
   </form>
  </div>
 </div>
<style>
	.pop-window {position:fixed;top:40%;left:50%;width:40%;height:65%;margin:-180px 0 0 -330px;border-radius:5px;display:none;box-shadow: 0 0 10px #666;background-color: white;z-index: 5;}
	.zzinvisible{background-color:rgba(0,0,0,0.6);width:100%;height:900px;display: none;position: absolute;top: 0;left: 0;z-index: 4;}
	.zzvisible{background-color:rgba(0,0,0,0.6);width:100%;height:900px;display: block;position: absolute;top: 0;left: 0;z-index: 4;}
        .pop-window-close-a{font-size: 24px;padding-right: 7px;}
        .pop-window-close{text-align: right;}
        .formdivmulti{padding:10px;overflow: hidden;}
        .formdivmulti label{width:18%;float:left;}
        .formdivmulti textarea{float:left;width:80%;height:80px;}
        .replicate{background-color:#7AAE21;margin: 10px;overflow: hidden;padding:5px;}
        .replicate .left1{float:left;font-size: 20px;margin-right: 30px;}
        .replicate .left2{float:left;overflow: hidden;font-size: 20px;}
        .replicate .left2 input{width:350px;height:30px;}
</style>
 <table class="tblist">
  <thead>
   <tr class="list">
    <th width="5%">富表单rfid</th>
    <th width="8%">富表单名称</th>
    <th width="8%">关联数据库表</th>
<!--    <th width="30%">富表单元素描述</th>-->
    <th width="20%">成功跳转地址</th>
    <th width="6%">绑定产品</th>
    <th width="6%">改动时间</th>
    <th>操作/设置/管理</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key =>$val):?>
   <tr id="tr<?php echo $val['rfid'];?>">
    <td><?php echo $val['rfid'];?></td>
    <td><?php echo $val['rfname'];?></td>
    <td><?php echo $val['tablename'];?></td>
<!--    <td><?php //echo $val['description'];?></td>-->
    <td><?php echo $val['jumpurl'];?></td>
    <td><?php echo $val['bindproductname'];?></td>
    <td><?php echo get_time_deviation($val['operatetime']);?></td>
    <td>
        <a href="<?php echo $curr_url.'&page='.$page.'&act=edit&rfid='. $val['rfid'];?>">【修改】</a>
        <a onclick="dbgmsDelete('<?php echo $delete_url.$val['rfid'];?>')">【删除】</a>
        <a class="overview-a" href="<?php echo $curr_url.'&page='.$page.'&act=overview&rfid='. $val['rfid'];?>" target="_blank">【预览】</a>
        <a class="set-style-a" href="javascript:;" 
           onclick="setstyle(<?php echo $val['rfid'];?>,'<?php echo htmlspecialchars($val['outdivstyle']);?>','<?php echo htmlspecialchars($val['formstyle']);?>','<?php echo htmlspecialchars($val['ulstyle']);?>','<?php echo htmlspecialchars($val['buttondivstyle']);?>');">【外层样式】</a>
        <a href="<?php echo $curr_url.'&page='.$page.'&act=manageelement&rfid='. $val['rfid'].'&rfname='.$val['rfname'];?>">【表单元素管理】</a>
        <a href="javascript:;" onclick="buildhtml(<?php echo $val['rfid'];?>);">【生成html】</a>
        <a href="javascript:;" onclick="builddbtable(<?php echo $val['rfid'];?>);">【生成数据库表】</a>
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
<div class="replicate">
    <div class="left1">表单的复制</div>
    <form method="post" id="DbgMsFormReplicateTable" name="DbgMsFormEdit" enctype="multipart/form-data" class="left2">
        <label>复制 </label><input type="text" name="sourcerfid" class="text" placeholder="请输入一个数据源表单rfid">
        <label>生成新的表 </label><input type="text" name="destinationrids" class="text" placeholder="请输入表单所绑定的表名和名称 例如 tablename|新的表单">
        <a class="dbgms_btn_submit" onclick="replicateTable()" href="javascript:;">执行</a><span>执行成功将自动生成数据库和html文件</span>
    </form>
</div>
<div class="zzinvisible" id="zzdiv"></div>
<div class="pop-window" id="pop-set-style">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-style-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" id="hiddenid">
             <div style="text-align: center;margin-bottom: 15px;"><h3>设置富表单外层样式</h3></div>
             <div class="formdivmulti">
                 <label>外层div样式：</label>
                 <textarea name="outdivstyle" id="outdivstyle" placeholder="可不填，输入类似 style='background-color:red;'"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>form标签样式：</label>
                 <textarea name="formstyle" id="formstyle" placeholder="可不填，输入类似 style='background-color:red;'"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>ul标签样式：</label>
                 <textarea name="ulstyle" id="ulstyle" placeholder="可不填，输入类似 style='background-color:red;'"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>button区div样式：</label>
                 <textarea name="buttondivstyle" id="buttondivstyle" placeholder="可不填，输入类似 style='background-color:red;'"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetStyle()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<div class="pop-window" id="overview">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="overview-close">×</a></div>
     <div>
        <div style="text-align: center;margin-bottom: 15px;"><h3>预览</h3></div>
        <div style="padding:10px;text-align: center;">
            <ul>
                <li id="overview-display-html">
                </li>
            </ul>
        </div>
     </div>
</div>
 <script type="text/javascript"> 
        jQuery(document).ready(function($) {
                $('.set-style-a').click(function(){
                        $('#pop-set-style').slideDown(100);
                        $('#zzdiv').attr('class','zzvisible');
                })
                $('#set-style-close').click(function(){
                        $('#pop-set-style').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                })
        })
        
        function setstyle(id,outdivstyle,formstyle,ulstyle,buttondivstyle){
                $('#hiddenid').val(id);//所选中的富表单元素的id
                $('#outdivstyle').val(outdivstyle);//所选中的富表单元素的style
                $('#formstyle').val(formstyle);//所选中的富表单元素的style
                $('#ulstyle').val(ulstyle);//所选中的富表单元素的style
                $('#buttondivstyle').val(buttondivstyle);//所选中的富表单元素的style
        }
        
        function cmsContentSetStyle(){ 	  
          $.ajax({ 
            url:"<?php echo $setstyle_url;?>",
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
        function buildhtml(rfid){
          $.ajax({ 
            url:"<?php echo $buildhtml_url;?>",
            type:"POST",
            data:{'rfid':rfid},
            success:function(result){
              if(result==1){
                alert("成功!");
                location.href='<?php echo $con_url.'&page='.$page;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function builddbtable(rfid){
            if (!confirm("此操作将导致数据丢失,且不可挽回,确认生成数据库表？")) {
                    window.event.returnValue = false;
            }else{
                    $.ajax({ 
                      url:"<?php echo $builddbtable_url;?>",
                      type:"POST",
                      data:{'rfid':rfid},
                      success:function(result){
                        if(result==1){
                          alert("成功!");
                          return;
                        }else{
                          alert(result);
                        }
                      }
                    });
            }
        }
        function replicateTable(){
          $.ajax({ 
            url:"<?php echo $replicatetable_url;?>",
            type:"POST",
            data:$('#DbgMsFormReplicateTable').serialize(),
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