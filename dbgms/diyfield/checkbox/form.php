<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td>
  <div class="labelwrp">
<?php foreach ($field['_arr'] as $val):?>
<label> &nbsp;&nbsp; <input type="checkbox" name="<?php echo $field['field'];?>[]" value="<?php echo $val['value'];?>" <?php echo in_array($val['value'],$field['value'])?'checked':NULL;?>><?php echo $val['name'];?>   </label> 
<?php endforeach;?>
  </div>
  <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?></td>
</tr>