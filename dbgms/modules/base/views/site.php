<?php if($act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">站点管理</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">网站信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">SEO设置</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab3')">数据库设置</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab4')">其他</a></li>
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
       <td><input type="text" name="base[name]" class="itxt" value="<?php echo $row['base']['name'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp; </font></td>
      </tr>
      <tr>
       <td class="ft">标识：</td>
       <td><input type="text" name="base[sign]" class="itxt" value="<?php echo $row['base']['sign'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;提示：英文字母 、数字、（其他出错，不处理!） </font></td>
      </tr>
      <tr>
       <td class="ft">绑定域名：</td>
       <td><input type="text" name="base[domain]" class="itxt" value="<?php echo $row['base']['domain'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp; 不要添加 http://</font></td>
      </tr>
      <tr>
       <td class="ft">模板名称：</td>
       <td><input type="text" name="base[themes]" class="itxt" value="<?php echo $row['base']['themes'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp; </font></td>
      </tr>
      <tr>
       <td class="ft">项目路径：</td>
       <td><input type="text" name="base[project]" class="itxt" maxlength="100" value="<?php echo $row['base']['project'];?>"><font style="color: #999">&nbsp;&nbsp;默认情况下为www,可以自行更改。如：domain/www/</font></td>
      </tr>
      <tr>
       <td class="ft">模板路径：</td>
       <td><input type="text" name="base[tplpath]" class="itxt" value="<?php echo $row['base']['tplpath'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;位于views目录下的模板文件夹（风格管理\界面设置\模板管理）</font></td>
      </tr>
      <tr>
       <td class="ft">url存入缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="base[savecache]" value="1" <?php echo $row['base']['savecache']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="domain[savecache]" value="0" <?php echo $row['base']['savecache']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后缓存文件讲写死url</font>
       </td>
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
       <td><input type="text" name="seo[title]" class="itxt" value="<?php echo $row['base']['title'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;显示在网站头部的标题信息</font></td>
      </tr>
      <tr>
       <td class="ft">站点关键词：</td>
       <td><input type="text" name="seo[keywords]" class="itxt" value="<?php echo $row['base']['keywords'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;针对搜索引擎的站点关键词</font></td>
      </tr>
      <tr>
       <td class="ft">站点描述：</td>
       <td><textarea class="rtxt" name="seo[description]" maxlength="200"><?php echo $row['base']['description'];?></textarea> &nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;针对搜索引擎的站点简介信息</font></td>
      </tr>
      <tr>
       <td class="ft">版权信息：</td>
       <td><input type="text" name="seo[copyright]" class="itxt" value="<?php echo $row['base']['copyright'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;显示在网站底部的网站版权信息</font></td>
      </tr>
      <tr>
       <td class="ft">ICP备案号：</td>
       <td><input type="text" name="seo[icp]" class="itxt" value="<?php echo $row['base']['icp'];?>">&nbsp;*&nbsp;<font style="color: #999">&nbsp;&nbsp;显示在网站底部的网站版权信息</font></td>
      </tr>
     </tbody>
    </table>
   </div>
   <!-- 邮箱设置 -->
   <div id="tab3" style="display: none;" class="dbgms_tab">
    <table class="subtab" id="cattab">
     <tbody>
      <tr>
       <td class="ft">数据库地址：</td>
       <td><input type="text" name="db[host]" class="itxt" value="<?php echo $row['db']['host'];?>">&nbsp;*&nbsp;</td>
      </tr>

      <tr>
       <td class="ft">数据库帐号：</td>
       <td><input type="text" name="db[user]" class="itxt" value="<?php echo $row['db']['user'];?>">&nbsp;*&nbsp;</td>
      </tr>
      <tr>
       <td class="ft">数据库密码：</td>
       <td><input type="text" name="db[pwd]" class="itxt" value="<?php echo $row['db']['pwd'];?>">&nbsp;*&nbsp;</td>
      </tr>
      <tr>
       <td class="ft">数据库端口：</td>
       <td><input type="text" name="db[port]" class="itxt" value="<?php echo $row['db']['port'];?>">&nbsp;*&nbsp;</td>
      </tr>
      <tr>
       <td class="ft">数据库名称：</td>
       <td><input type="text" name="db[name]" class="itxt" value="<?php echo $row['db']['name'];?>">&nbsp;*&nbsp;</td>
      </tr>
      <tr>
       <td class="ft">数据库前缀：</td>
       <td><input type="text" name="db[prefix]" class="itxt" value="<?php echo $row['db']['prefix'];?>">&nbsp;*&nbsp;</td>
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
         <label><input type="radio" name="trait[dbgyzm]" value="1" <?php echo $site['trait']['dbgyzm']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[dbgyzm]" value="0" <?php echo $site['trait']['dbgyzm']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将显示详细的错误信息</font>
       </td>
      </tr>
      <tr>
       <td class="ft">前台验证码：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[webyzm]" value="1" <?php echo $site['trait']['webyzm']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[webyzm]" value="0" <?php echo $site['trait']['webyzm']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp; 付费 ——用户功能组的时候设置才有效果</font>
       </td>
      </tr>
      <tr>
       <td class="ft">错误调试模式：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[debug]" value="1" <?php echo $site['trait']['debug']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[debug]" value="0" <?php echo $site['trait']['debug']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将显示详细的错误信息</font>
       </td>
      </tr>

      <tr>
       <td class="ft">伪静态模式：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[static]" value="1" <?php echo $site['trait']['static']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[static]" value="0" <?php echo $site['trait']['static']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;开启后将会去除URL中的index.php</font>
       </td>
      </tr>
      <tr>
       <td class="ft">数据缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[fcache]" value="1" <?php echo $site['trait']['fcache']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[fcache]" value="0" <?php echo $site['trait']['fcache']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;这里取php文件缓存(3种：json,序列化,php文件)</font>
       </td>
      </tr>
      <tr>
       <td class="ft">静态缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[hcache]" value="1" <?php echo $site['trait']['hcache']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[hcache]" value="0" <?php echo $site['trait']['hcache']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;针对页面访问进行一定时间的静态缓存</font>
       </td>
      </tr>
      <tr>
       <td class="ft">数据库缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[dbcache]" value="1" <?php echo $site['trait']['dbcache']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[dbcache]" value="0" <?php echo $site['trait']['dbcache']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;缓存数据库查询信息减少数据库压力</font>
       </td>
      </tr>
      <tr>
       <td class="ft">COOKIE标识：</td>
       <td><input type="text" name="trait[cookie_prefix]" class="itxt" maxlength="100" value="<?php echo $site['trait']['cookie'];?>"><font style="color: #999">&nbsp;&nbsp;如果一个空间多个网站请自行调整本参数</font></td>
      </tr>
      <tr>
       <td class="ft">SESSION缓存：</td>
       <td>
        <div class="labelwrp">
         <label><input type="radio" name="trait[session]" value="1" <?php echo $site['trait']['session']==1?' checked ':NULL;?>>开启</label> <label><input type="radio" name="trait[session]" value="0" <?php echo $site['trait']['session']==0?' checked ':NULL;?>>关闭</label>
        </div> <font style="color: #999">&nbsp;&nbsp;服务器对SESSION支持不好的情况下开启</font>
       </td>
      </tr>
     </tbody>
    </table>
   </div>
  </fieldset>
  <div style="margin-left: 150px; margin-top: 30px;">
   <a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a>
  </div>
 </form>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"> <a class="dbgms_btn" href="<?php echo $con_url;?>&act=edit">新增站点</a>
  </span> <span class="span_r"> <input type="button" value="更新所有缓存" class="dbgms_btn" onclick="upcache()">
  </span>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th>选</th>
    <th>号数</th>
    <th>名称</th>
    <th width="20%">域名</th>
    <th>模板</th>
    <th>更新时间</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key=>$val):?>
<tr id="tr<?php echo ($key+1);?>">
    <td><input type="checkbox" value="<?php echo ($key+1);?>" name="ids[]"></td>
    <td><?php echo ($key+1);?></td>
    <td><?php echo $val['base']['name'];?></td>
    <td><?php echo $val['base']['domain'];?></td>
    <td><?php echo $val['base']['themes'];?></td>
    <td><?php echo get_time_deviation($val['base']['time']);?></td>
    <td>
     <div>
      <a href="<?php echo $con_url.'&act=edit&domainid='.$val['base']['sign'];?>">编辑</a>
      <!--  -->
      <a href="<?php echo empty($val['base']['domain'])?'###':'http://'.$val['base']['domain'];?>" target="_blank">访问</a>
      <!--  -->
      <a onclick="dbgmsDelete('<?php echo $con_url.'&act=delete&id='.($key+1).'&domainid='.$val['base']['sign'];?>')">删除</a>
     </div>
    </td>
   </tr>
<?php endforeach;?>
  <tr class="btm">
    <td><input type="checkbox" id="checkall" onclick="dbgmsCheckAll()"></td>
    <td colspan="12"><input type="button" value="更新缓存" class="dbgms_btn"></td>
   </tr>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
</div>
<?php endif;?>