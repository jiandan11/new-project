<?php $uploadurl =site_url().'/index/cms?do=do&name='.$field['formfield']."&modelsign=".$field['path'];?>
<?php include_once 'cssjs.php';?>
<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td>
  <div class="dbg_diyfield_down">
   <input type="text" name="<?php echo $field['field'];?>" class="dbg_diyfield_down_value" value="<?php echo $field['value'];?>">
   <div class="btns" title="支持类型：gif,jpg,jpeg,png,bmp">
    <input type="file" class="dbg_diyfield_down_upload" name="<?php echo $field['formfield'];?>_down" />
    <button>上 传</button>
   </div>
   <input type="hidden" class="dbg_diyfield_down_data" data-form="<?php echo $field['form'];?>" data-url="<?php echo $uploadurl;?>">
  </div>
    <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?></td>
</tr>
