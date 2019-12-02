<?php include_once 'cssjs.php';?>
<tr <?php echo $field['disable']==1?'style="display:none;"':'';?> id="<?php echo $field['id'];?>">
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td colspan="5">
  <div>
   <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
   <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
   <!--  -->
   <script id="editor<?php echo $field['field'];?>" type="text/plain" style="height: 300px; width: 800px;"></script>
   <textarea style="display: none;" id="<?php echo $field['field'];?>" name="<?php echo $field['field'];?>" class="itxt"><?php echo $field['value'];?></textarea>
  </div>
  <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?> 
     <font style="color: #999">（如果内容只有一张图片，建议把标题也添加到内容~以免服务器响应问题，造成图片内容缺失~）</font> <script type="text/javascript">
	   //实例化编辑器 创建多个编辑器 20160428
	    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
	    var ue_<?php echo $field['field'];?> = UE.getEditor('editor<?php echo $field['field'];?>',{ scaleEnabled:true, autoFloatEnabled:false});
	    ue_<?php echo $field['field'];?>.ready(function(){ 
             this.setContent($('#<?php echo $field['field'];?>').val());
        });
        ue_<?php echo $field['field'];?>.addListener( "contentChange", function ( type, arg1, arg2 ) {
            setTimeout(function(){
              document.getElementById("<?php echo $field['field'];?>").value = ue_<?php echo $field['field'];?>.getContent();
            },500);
            setTimeout(function(){
                document.getElementById("<?php echo $field['field'];?>").value = ue_<?php echo $field['field'];?>.getContent();
            },1000);
            setTimeout(function(){
                document.getElementById("<?php echo $field['field'];?>").value = ue_<?php echo $field['field'];?>.getContent();
            },1500);
	   });
</script>
 </td>
</tr>
