<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td><div class="hpft">
   <input type="hidden" name="<?php echo $field['field'];?>" value="<?php echo $field['value'];?>" id="<?php echo $field['field'];?>_id"> <input type="text" class="itxt" id="<?php echo $field['field'];?>_name" readonly style="color: #666;">&nbsp; <input type="button" value=" 选 择 " class="btn3 webgame_selbox"> <input type="button" value=" 重 置 " class="btn3" onclick="resetApp()">
  </div> <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?>
    <script type="text/javascript">
      function resetApp(){ $('#<?php echo $field['field'];?>_name').val(''); $('#<?php echo $field['field'];?>_id').val('');}
      $(function(){
          var value=<?php echo $field['value'];?>;
        var url='<?php echo $$dbgmsurl?>index/cms?con=model&act=guanlian&id=<?php echo $field['relationid'];?>';
          $.ajax({
            url:url,dataType:"json",
            success :function(result){
              $.each(result.data, function(i, item){if(item.id==value){$('#<?php echo $field['field'];?>_name').val(item.name);}}); 
            }
          });
        $('.webgame_selbox').bind('click',function(){
               var url='<?php echo $$dbgmsurl?>index/cms?con=model&act=guanlian&id=<?php echo $field['relationid'];?>&pagerow=20&key=~key~';
               msgbox.list('选择<?php echo $field['name'];?>',url,0,function(set){
               $('#<?php echo $field['field'];?>_name').val(set.name);
               $('#<?php echo $field['field'];?>_id').val(set.rel);
            });
          });
      });
   </script></td>
</tr>