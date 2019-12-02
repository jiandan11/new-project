<?php $uploadurl =site_url().'/index/cms?do=do&name='.$field['formfield']."&modelsign=".$field['path'];?>
<?php include_once 'cssjs.php';?>
<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td>
  <div class="dbg_diyfield_file">
   <img src="<?php echo empty($field['value'])?'###':DBG_FILEURL.$field['value'];?>" class="dbg_diyfield_file_img" data-fileurl="<?php echo DBG_FILEURL;?>" /> <input type="text" name="<?php echo $field['field'];?>" class="dbg_diyfield_file_value" value="<?php echo $field['value'];?>">
   <div class="btns" title="支持类型：gif,jpg,jpeg,png,bmp">
    <input type="file" class="dbg_diyfield_file_upload" name="<?php echo $field['formfield'];?>_file" />
    <button>上 传</button>
   </div>
   <div class="frr">
    <label><input type="checkbox" checked="checked"> 采集</label> <a href="###" class="dbg_diyfield_file_cut" class="upimg-cut">【裁剪】</a>
   </div>
   <input type="hidden" class="dbg_diyfield_file_data" data-form="<?php echo $field['form'];?>" data-url="<?php echo $uploadurl;?>">
  </div>
    <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?>
    <font style="color: #999">（如果图片是一样的，请复制链接~请勿重新上传，节省空间资源）</font>
 </td>
</tr>
