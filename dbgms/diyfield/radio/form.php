<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td>
  <div class="labelwrp">
   <label><input type="radio" name="<?php echo $field['field'];?>" value="0" <?php echo $field['value']==0?'checked':NULL;?>>&nbsp;无 </label>
<?php foreach ($field['radio_arr'] as $val):?>
<label> &nbsp;&nbsp; <input type="radio" name="<?php echo $field['field'];?>" value="<?php echo $val['value'];?>" <?php echo $field['value']==$val['value']?'checked':NULL;?>><?php echo $val['name'];?>   </label> 
<?php endforeach;?>
  </div>
  <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?></td>
</tr>