<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">管理员功能设置</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">功能信息</a></li>
 </ul>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
  <input type="hidden" readonly="readonly" value="update" name="act">
  <fieldset>
   <!-- 网站信息 -->
   <div id="tab1" style="display: block;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft">是否开启图片删除功能：</td>
       <td>
           开启<input type="radio" name="config[endelimg]" value="1" <?php if($row['endelimg'] == 1):?>checked="checked"<?php endif;?> style="margin-right: 20px;">
           关闭<input type="radio" name="config[endelimg]" value="0" <?php if($row['endelimg'] == 0):?>checked="checked"<?php endif;?>>
           &nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;开启后，当删除文章的同时，将会删除文章里面的图片。</font></td>
      </tr>
      <tr>
       <td class="ft">是否开启展示广告功能：</td>
       <td>
           开启<input type="radio" name="config[enshowadv]" value="1" <?php if($row['enshowadv'] == 1):?>checked="checked"<?php endif;?> style="margin-right: 20px;">
           关闭<input type="radio" name="config[enshowadv]" value="0" <?php if($row['enshowadv'] == 0):?>checked="checked"<?php endif;?>>
           &nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;开启后，当列表页为空后，将允许展示广告。</font></td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td>&nbsp;&nbsp;</td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td>&nbsp;&nbsp;</td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 站点设置 -->
  </fieldset>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a>
  </div>
 </form>
</div>
