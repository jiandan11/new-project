<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td><input type="text" name="<?php echo $field['field'];?>" class="itxt biaoci" value="<?php echo $field['value'];?>" style="width: 100px"> <font style="color: #999">（只能输入有效的数字）</font>
  <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?></td>
</tr>