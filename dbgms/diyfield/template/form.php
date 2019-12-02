<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td><select name="<?php echo $field['field'];?>">
   <option value="">--请选择--</option>
   <option selected="selected" value="0">&nbsp;默认</option>
   <option value="1">&nbsp;album/cj2014_news.html</option>
   <option value="2">&nbsp;album/moba_detail.html</option>
   <option value="3">&nbsp;album/fangtan.html</option>
   <option value="4">&nbsp;album/tfc2015_news.html</option>
 </select> 
   <?php if($field['help']!=''):?>
    <div class="hpdiv mt3">
   <img src="<?php echo base_url()?>ui/img/s.gif" class="autohelp" title="<?php echo $field['help'];?>" alt="<?php echo $field['help'];?>" />
  </div>
    <?php endif;?>
  <script type="text/javascript">$(function(){$("select[name='<?php echo $field['field'];?>']").attr("value","<?php echo $field['value'];?>");});</script></td>
</tr>
