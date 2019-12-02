<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">初始化</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">网站信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab6')">常用工具</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">英文信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab3')">邮箱设置</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab4')">性能设置</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab5')">上传设置</a></li>
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
       <td class="ft">网站名称：</td>
       <td><input type="text" name="base[title]" class="itxt" value="<?php echo $row['base']['title'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;显示在网站头部的标题信息</font></td>
      </tr>
      <tr>
       <td class="ft">站点关键词：</td>
       <td><input type="text" name="base[keywords]" class="itxt" value="<?php echo $row['base']['keywords'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;针对搜索引擎的站点关键词</font></td>
      </tr>
      <tr>
       <td class="ft">站点描述：</td>
       <td><textarea class="rtxt" name="base[description]" maxlength="200"><?php echo $row['base']['description'];?></textarea> &nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;针对搜索引擎的站点简介信息</font></td>
      </tr>
      <tr>
       <td class="ft">网站主页：</td>
       <td><input type="text" name="base[domain]" class="itxt" value="<?php echo $row['base']['domain'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;网址</font></td>
      </tr>
      <tr>
       <td class="ft">版权信息：</td>
       <td><input type="text" name="base[copyright]" class="itxt" value="<?php echo $row['base']['copyright'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;显示在网站底部的网站版权信息</font></td>
      </tr>
      <tr>
       <td class="ft">ICP备案号：</td>
       <td><input type="text" name="base[icp]" class="itxt" value="<?php echo $row['base']['icp'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;显示在网站底部的网站版权信息</font></td>
      </tr>
<?php $baselogo['form']='DbgMsFormEdit';$baselogo['name'] = '网站logo';$baselogo['field'] = 'base[logo]';$baselogo['path']='site';dbg_diyfield ( 'load', 'file', $baselogo,$row['base']['logo'] );?>
      <tr>
       <td class="ft"></td>
       <td>宽度：<input type="text" style="width: 50px;" name="base[logow]" class="itxt" value="<?php echo $row['base']['logow'];?>"> 高度：<input type="text" style="width: 50px;" name="base[logoh]" class="itxt" value="<?php echo $row['base']['logoh'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp; 网站 logo 宽度高度(不填为默认 280 * 85)</font>
       </td>
      </tr>
      <tr>
       <td class="ft">是否开启英文站点风格：</td>
       <td>
           开启<input type="radio" name="base[enablelanguage]" value="1" <?php if($row['base']['enablelanguage'] == 1):?>checked="checked"<?php endif;?> style="margin-right: 20px;">
           关闭<input type="radio" name="base[enablelanguage]" value="0" <?php if($row['base']['enablelanguage'] == 0):?>checked="checked"<?php endif;?>>
           &nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;开启后，可设置英文风格的站点信息</font></td>
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
   <!-- 常用工具 -->
   <div id="tab6" style="display: none;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft"></td>
       <td><font style="color: red;"><b>[ 常用工具：浮动在线客服QQ ]</b> <br /> </font></td>
      </tr>
      <tr>
       <td class="ft">是否开启：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="base[isopenqq]" value="1" <?php echo $row['base']['isopenqq']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="base[isopenqq]" value="0" <?php echo $row['base']['isopenqq']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将显示 在线咨询QQ</font>
       </td>
      </tr>
      <tr>
       <td class="ft">客服QQ：</td>
       <td><input type="text" name="base[qq]" class="itxt" value="<?php echo $row['base']['qq'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;多个QQ请用（，）逗号隔开</font></td>
      </tr>
      <tr>
       <td class="ft">热线电话：</td>
       <td><input type="text" name="base[phone]" class="itxt" value="<?php echo $row['base']['phone'];?>">&nbsp;*&nbsp;</td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td><font style="color: red;"><b>[ 常用工具： 流量统计 ]</b> <br /> </font></td>
      </tr>
      <tr>
       <td class="ft">是否开启：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="base[isopencnzz]" value="1" <?php echo $row['base']['isopencnzz']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="base[isopencnzz]" value="0" <?php echo $row['base']['isopencnzz']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将进行流量统计</font>
       </td>
      </tr>
      <tr>
       <td class="ft">统计代码：</td>
       <td><textarea class="rtxt" name="base[cnzz]"><?php echo $row['base']['cnzz'];?></textarea></td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td><font style="color: red;"><b>[ 常用工具： 站点维护 ]</b> <br /> </font></td>
      </tr>
      <tr>
       <td class="ft">是否维护：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="base[isopensite]" value="1" <?php echo $row['base']['isopensite']==1?' checked ':NULL;?>>是</label> <label><input type="radio" name="base[isopensite]" value="0" <?php echo $row['base']['isopensite']==0?' checked ':NULL;?>>否</label>
        </div> <font style="color: #999">&nbsp;&nbsp;网站维护,暂时关闭;</font>
       </td>
      </tr>
      <tr>
       <td class="ft">关闭提示：</td>
       <td><textarea class="rtxt" name="base[closeinfo]"><?php echo $row['base']['closeinfo'];?></textarea></td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td><font style="color: red;"><b>[ 常用工具： ~~~ ]</b> <br /> </font></td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 英文信息 -->
   <div id="tab2" style="display: none;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft">网站名称：</td>
       <td><input type="text" name="en[title]" class="itxt" value="<?php echo $row['en']['title'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;显示在网站头部的标题信息</font></td>
      </tr>
      <tr>
       <td class="ft">站点关键词：</td>
       <td><input type="text" name="en[keywords]" class="itxt" value="<?php echo $row['en']['keywords'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;针对搜索引擎的站点关键词</font></td>
      </tr>
      <tr>
       <td class="ft">站点描述：</td>
       <td><textarea class="itxt" name="en[description]" maxlength="200" style="width: 400px; height: 126px; margin: 0px; vertical-align: middle; overflow: auto; resize: none;"><?php echo $row['en']['description'];?></textarea> &nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;针对搜索引擎的站点简介信息</font></td>
      </tr>
      <tr>
       <td class="ft">中英文版本：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[lang]" value="0">开启</label> <label><input type="radio" name="trait[lang]" value="1" checked="checked">关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后支持 中英文</font>
       </td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 邮箱设置 -->
   <div id="tab3" style="display: none;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft"></td>
       <td><font style="color: red;"><b>[ 邮箱设置：如果要系统用统一的邮箱发送，并且初始化里设置了，其他可以不用设置 ]</b> <br> </font></td>
      </tr>
      <tr>
       <td class="ft">SMTP_服务器：</td>
       <td><div>
         <p style="color: #999; line-height: 25px;">[ 只提供 SMTP 服务]</p>
         <p style="color: #999; line-height: 25px;">[ QQ企业：smtp.exmail.qq.com (延迟慢)]</p>
         <p style="color: #999; line-height: 25px;">[ 163邮箱：smtp.163.com (快)]</p>
         <p style="color: #999; line-height: 25px;">[ 域名邮箱：smtp.xxx.com (延迟慢)]</p>
         <p style="color: #999; line-height: 25px;">[ 其他：... ]</p>
        </div></td>
      </tr>
      <tr>
       <td class="ft">SMTP_服务器：</td>
       <td><input type="text" name="email[smtp_host]" class="itxt" value="<?php echo $row['email']['smtp_host'];?>"></td>
      </tr>
      <tr>
       <td class="ft">SMTP_端口：</td>
       <td><input type="text" name="email[smtp_port]" class="itxt" value="<?php echo $row['email']['smtp_port'];?>"></td>
      </tr>
      <tr>
       <td class="ft">SMTP_邮箱：</td>
       <td><input type="text" name="email[smtp_user]" class="itxt" value="<?php echo $row['email']['smtp_user'];?>"></td>
      </tr>
      <tr>
       <td class="ft">SMTP_密码：</td>
       <td><input type="password" name="email[smtp_pass]" class="itxt" value="<?php echo $row['email']['smtp_pass'];?>"></td>
      </tr>
      <tr>
       <td class="ft">站长邮箱：</td>
       <td><input type="text" name="email[name]" class="itxt" value="<?php echo $row['email']['name'];?>">&nbsp;*&nbsp;</td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 性能设置 -->
   <div id="tab4" style="display: none;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft">后台验证码：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[dbgmscaptcha]" value="1" <?php echo $row['trait']['dbgmscaptcha']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[dbgmscaptcha]" value="0" <?php echo $row['trait']['dbgmscaptcha']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将显示详细的错误信息</font>
       </td>
      </tr>
      <tr>
       <td class="ft">错误调试模式：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[debug]" value="1" <?php echo $row['trait']['debug']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[debug]" value="0" <?php echo $row['trait']['debug']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将显示详细的错误信息</font>
       </td>
      </tr>

      <tr>
       <td class="ft">伪静态模式：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[static]" value="1" <?php echo $row['trait']['static']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[static]" value="0" <?php echo $row['trait']['static']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将会去除URL中的index.php</font>
       </td>
      </tr>
      <tr>
       <td class="ft">数据缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[fcache]" value="1" <?php echo $row['trait']['fcache']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[fcache]" value="0" <?php echo $row['trait']['fcache']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;这里取php文件缓存(3种：json,序列化,php文件)</font>
       </td>
      </tr>
      <tr>
       <td class="ft">静态缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[hcache]" value="1" <?php echo $row['trait']['hcache']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[hcache]" value="0" <?php echo $row['trait']['hcache']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;针对页面访问进行一定时间的静态缓存</font>
       </td>
      </tr>

      <tr>
       <td class="ft">数据库缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[dbcache]" value="1" <?php echo $row['trait']['dbcache']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[dbcache]" value="0" <?php echo $row['trait']['dbcache']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;缓存数据库查询信息减少数据库压力</font>
       </td>
      </tr>
      <tr>
       <td class="ft">COOKIE标识：</td>
       <td><input type="text" name="trait[cookie]" class="itxt" maxlength="100" value="<?php echo $row['trait']['cookie'];?>"><font style="color: #999">&nbsp;&nbsp;如果一个空间多个网站请自行调整本参数</font></td>
      </tr>
      <tr>
       <td class="ft">SESSION缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[session]" value="1" <?php echo $row['trait']['session']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[session]" value="0" <?php echo $row['trait']['session']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;服务器对SESSION支持不好的情况下开启</font>
       </td>
      </tr>
      <tr>
       <td class="ft"></td>
       <td><font style="color: red;"><b>[ 常用设置：自动清除SESSION缓存 ]</b> <br /> </font></td>
      </tr>
      <tr>
       <td class="ft">是否开启：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[delsessionopen]" value="1" <?php echo $row['trait']['delsessionopen']==1?' checked ':NULL;?>>开启</label>
         <!--  -->
         <label><input type="radio" name="trait[delsessionopen]" value="0" <?php echo $row['trait']['delsessionopen']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将根据 间隔时间 自动删除 /data/public/ 下的session缓存</font>
       </td>
      </tr>
      <tr>
       <td class="ft">间隔时间：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[delsessiontime]" value="86400" <?php echo $row['trait']['delsessiontime']==86400?' checked ':NULL;?>>24小时</label>
         <!--  -->
         <label><input type="radio" name="trait[delsessiontime]" value="43200" <?php echo $row['trait']['delsessiontime']==43200?' checked ':NULL;?>>12小时</label>
        </div> <font style="color: #999">&nbsp;&nbsp;与当前时间的间隔</font>
       </td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 上传设置 -->
   <div id="tab5" style="display: none;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft">缩图开关：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="upload[thumb]" value="0">开启</label> <label><input type="radio" name="upload[thumb]" value="1" checked="checked">关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;只针对图片处理默认选项</font>
       </td>
      </tr>
      <tr>
       <td class="ft">缩图方式：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="upload[type]" value="0">开启</label> <label><input type="radio" name="upload[type]" value="1" checked="checked">关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;只针对图片处理默认选项</font>
       </td>
      </tr>
      <tr>
       <td class="ft">缩图尺寸：</td>
       <td>
        <div class="labelwrp">
         <label>宽度：<input name="upload[thumb_width]" type="text" value="500">
         </label>&nbsp;&nbsp; <label>高度：</label> <input name="upload[thumb_height]" type="text" value="500">
        </div> <font style="color: #999">&nbsp;&nbsp;单位：像素</font>
       </td>
      </tr>
      <tr>
       <td class="ft">水印开关：</td>
       <td><label><input type="radio" name="upload[watermark]" value="0">开启</label> <label><input type="radio" name="upload[watermark]" value="1" checked="checked">关闭</label> <font style="color: #999">&nbsp;&nbsp;只针对图片处理默认选项</font></td>
      </tr>
      <tr>
       <td class="ft">水印位置：</td>
       <td><select name="upload[watermark_point]">
         <option value="0" <?php echo $row['upload']['watermark_img']==0?'selected="selected"':"";?>>随机</option>
         <option value="1" <?php echo $row['upload']['watermark_img']==1?'selected="selected"':"";?>>左上</option>
         <option value="2" <?php echo $row['upload']['watermark_img']==2?'selected="selected"':"";?>>中上</option>
         <option value="3" <?php echo $row['upload']['watermark_img']==3?'selected="selected"':"";?>>右上</option>
         <option value="4" <?php echo $row['upload']['watermark_img']==4?'selected="selected"':"";?>>左中</option>
         <option value="5" <?php echo $row['upload']['watermark_img']==5?'selected="selected"':"";?>>正中</option>
         <option value="6" <?php echo $row['upload']['watermark_img']==6?'selected="selected"':"";?>>右中</option>
         <option value="7" <?php echo $row['upload']['watermark_img']==7?'selected="selected"':"";?>>左下</option>
         <option value="8" <?php echo $row['upload']['watermark_img']==8?'selected="selected"':"";?>>中下</option>
         <option value="9" <?php echo $row['upload']['watermark_img']==9?'selected="selected"':"";?>>右下</option>
       </select></td>
      </tr>
      <tr>
       <td class="ft">水印图片：</td>
       <td><input type="text" name="upload[watermark_img]" class="itxt" maxlength="100" value="<?php echo $row['upload']['watermark_img'];?>"><font style="color: #999">&nbsp;&nbsp;位于 /other/file/watermark下的图片文件</font></td>
      </tr>
      <tr>
       <td class="ft">上传格式：</td>
       <td><input type="text" name="upload[format]" class="itxt" maxlength="100" value="<?php echo $row['upload']['format']?>"><font style="color: #999">&nbsp;&nbsp;系统会自动过滤危险文件</font></td>
      </tr>
      <tr>
       <td class="ft">上传大小：</td>
       <td><input type="text" name="upload[size]" class="itxt" maxlength="100" value="<?php echo $row['upload']['size'];?>"><font style="color: #999">&nbsp;&nbsp;单位：M 程序限制上传大小，服务器限制请自行调整</font></td>
      </tr>
      <tr>
       <td class="ft">上传路径：</td>
       <td><input type="text" name="upload[path]" class="itxt" maxlength="100" value="<?php echo $row['upload']['path'];?>"><font style="color: red;">&nbsp;&nbsp; 网站根网址+/other/file/ </font></td>
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
