<?php include_once 'cssjs.php';?>
<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td>
  <div class="swfup_wrap" clt="1" sizes="96_72">
   <div class="swfup_up">
    <div class="swfup_btn" id="SwfUp_<?php echo $field['field'];?>_wrp">
     <span id="SwfUp_<?php echo $field['field'];?>"></span>
    </div>
    <div class="swfup_msg">(最大 1 MB 支持GIF/JPG/JPEG/PNG/BMP)</div>
   </div>
   <div class="swfup_tit">
    <b class="sa">图片</b> <b class="sb">说明</b> <b class="sc">操作</b>
   </div>
   <div class="swfup_list">
    <ol class="swfup_scl">
<?php  foreach($field['value'] as $val){if($val['url'] != null):?>
<li><div class="sa">
       <div class="swfup_pic">
        <img src="<?php echo $field['fileurl'].'/'.$val['url']?>"><input type="hidden" value="<?php echo $val['url']?>" name="<?php echo $field['field'];?>_img[]">
       </div>
      </div>
      <div class="sb">
       <textarea style="display: none" name="<?php echo $field['field'];?>_msg[]"><?php echo $val['msg']?></textarea>
       <div class="swfup_intro"><?php echo $val['msg']?></div>
      </div>
      <div class="sc">
       <div class="swfup_dos">
        <b class="dos_up" title="上移"></b><b class="dos_down" title="下移"></b> <b class="dos_del" title="删除"></b>
       </div>
      </div></li>
<?php endif;}?>
</ol>
   </div>
  </div>
   <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?> <script type="text/javascript">
  $(document).ready(function() {  
      var SWF_<?php echo $field['field'];?>=new SWFUpload({
             button_placeholder_id : "SwfUp_<?php echo $field['field'];?>",
             upload_url: "<?php echo $dbgmsurl?>index/cms?do=do&use=swfupload_add&modelsign=<?php echo $field['path'];?>",
             // Flash Settings
	         flash_url:"<?php echo base_url()?>plugin/swfupload/swfupload.swf",
	         flash9_url:"<?php echo base_url()?>plugin/swfupload/swfupload_fp9.swf",
	         button_image_url:"<?php echo base_url()?>plugin/swfupload/img/swfupload.png",
	       	 post_params: {"maxsize":"2048","water":"0","waterfile":"default.png","uptypes":"gif,jpg,jpeg,png,bmp"},
	         file_size_limit : "2048 KB",
	         post_params: {"PHPSESSID":"<?php echo session_id();?>"},
	         file_types : "*.gif;*.jpg;*.jpeg;*.png;*.bmp",
	         file_upload_limit : 0
	   	}); 
	});
</script>
 </td>
</tr>
