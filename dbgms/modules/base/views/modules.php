<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>plugin/artdialog/skins/default.css">
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>ui/css/dbgms.base.modules.css">
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">系统模块列表</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">APP列表</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">高级参数</a></li>
 </ul>
 <div class="more">
  <a href="javascript:;" onclick="window.location.reload();"><span class="icon icon-refresh"></span> 刷新</a>
 </div>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<div class="dbg_warp">
 <p style="text-align: center; font-weight: bold; font-size: 18px; color: red;">请把需要 系统模块 放在 【 /dbgms/modules/ 】文件夹下。然后执行以下对应的系统模块功能~</p>

 <div class="m-list3 m-list3-x m-applist">
  <ul class="f-cb">
   <li class="<?php echo $lists['base']['install']==1?'s-success':'s-warning'?>">
    <div class="u-img">
     <span class="icon icon-cogs"></span>
    </div>
    <div class="apptxt">
     <h3><a href="javascript:;">BASE基础系统</a></h3>
     <p>V2.0 - 2016.0421 - DbgMs</p>
     <p>基本功能</p>
     <p>
<?php if($lists['base']['install']==1):?>
 <?php if($lists['base']['disable']==1):?>
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('BASE',0)">启用</button>
 <?php else:?>  
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('BASE',1)">禁用</button>
 <?php endif;?> 
     <button type="button" class="dbgms_btn" onclick="dbgmsModUninstall('BASE')">卸载</button>
      <button type="button" class="dbgms_btn" onclick="dbgmsModTestdata('BASE')">安装测试数据</button>
      <button type="button" class="dbgms_btn" onclick="database('BASE')">备份数据</button>
      <button type="button" class="dbgms_btn" onclick="database('BASE')">恢复数据</button>
      <button type="button" class="dbgms_btn" onclick="database('BASE')">打包数据</button>
<?php else:?>   
 <button type="button" class="dbgms_btn" onclick="dbgmsModInstall('BASE')">安装</button>  
<?php endif;?> 
    </p>
    </div>
   </li>


   <li class="<?php echo $lists['cms']['install']==1?'s-success':'s-warning'?>">
    <div class="u-img">
     <span class="icon icon-file-alt"></span>
    </div>
    <div class="apptxt">
     <h3><a href="javascript:;">CMS 内容管理系统</a></h3>
     <p>V2.0 - 2016.0421 - DbgMs</p>
     <p>为内容提供网站内容管理</p>
     <p>
<?php if($lists['cms']['install']==1):?>
 <?php if($lists['cms']['disable']==1):?>
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('CMS',0)">启用</button>
 <?php else:?>  
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('CMS',1)">禁用</button>
 <?php endif;?> 
     <button type="button" class="dbgms_btn" onclick="dbgmsModUninstall('CMS')">卸载</button>
      <button type="button" class="dbgms_btn" onclick="dbgmsModTestdata('CMS')">安装测试数据</button>
      <button type="button" class="dbgms_btn" onclick="database('CMS')">备份数据</button>
      <button type="button" class="dbgms_btn" onclick="database('CMS')">恢复数据</button>
      <button type="button" class="dbgms_btn" onclick="database('CMS')">打包数据</button>
<?php else:?>   
 <button type="button" class="dbgms_btn" onclick="install('CMS')">安装</button>  
<?php endif;?>     
    </p>
    </div>
   </li>

   <li class="<?php echo $lists['erp']['install']==1?'s-success':'s-warning'?>">
    <div class="u-img">
     <span class="icon icon-group"></span>
    </div>
    <div class="apptxt">
     <h3><a href="javascript:;">ERP 企业资源管理系统</a></h3>
     <p>V2.0 - 2016.0421 - DbgMs</p>
     <p>ERP 企业资源管理系统</p>
     <p>
<?php if($lists['erp']['install']==1):?>
 <?php if($lists['erp']['disable']==1):?>
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('ERP',0)">启用</button>
 <?php else:?>  
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('ERP',1)">禁用</button>
 <?php endif;?> 
     <button type="button" class="dbgms_btn" onclick="dbgmsModUninstall('ERP')">卸载</button>
      <button type="button" class="dbgms_btn" onclick="dbgmsModTestdata('ERP')">安装测试数据</button>
      <button type="button" class="dbgms_btn" onclick="database('ERP')">备份数据</button>
      <button type="button" class="dbgms_btn" onclick="database('ERP')">恢复数据</button>
      <button type="button" class="dbgms_btn" onclick="database('ERP')">打包数据</button>
<?php else:?>   
 <button type="button" class="dbgms_btn" onclick="dbgmsModInstall('ERP')">安装</button>  
<?php endif;?> 
    </p>
    </div>
   </li>

   <li class="<?php echo $lists['member']['install']==1?'s-success':'s-warning'?>">
    <div class="u-img">
     <span class="icon icon-user"></span>
    </div>
    <div class="apptxt">
     <h3><a href="javascript:;">MEMBER 会员系统</a></h3>
     <p>V2.0 - 2016.0421 - DbgMs</p>
     <p>提供网站会员管理操作</p>
     <p>
<?php if($lists['member']['install']==1):?>
 <?php if($lists['member']['disable']==1):?>
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('MEMBER',0)">启用</button>
 <?php else:?>  
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('MEMBER',1)">禁用</button>
 <?php endif;?> 
     <button type="button" class="dbgms_btn" onclick="dbgmsModUninstall('MEMBER')">卸载</button>
      <button type="button" class="dbgms_btn" onclick="dbgmsModTestdata('MEMBER')">安装测试数据</button>
      <button type="button" class="dbgms_btn" onclick="database('MEMBER')">备份数据</button>
      <button type="button" class="dbgms_btn" onclick="database('MEMBER')">恢复数据</button>
      <button type="button" class="dbgms_btn" onclick="database('MEMBER')">打包数据</button>
<?php else:?>   
 <button type="button" class="dbgms_btn" onclick="dbgmsModInstall('MEMBER')">安装</button>  
<?php endif;?>     
    </p>
    </div>
   </li>

   <li class="<?php echo $lists['tool']['install']==1?'s-success':'s-warning'?>">
    <div class="u-img">
     <span class="icon icon-wrench"></span>
    </div>
    <div class="apptxt">
     <h3><a href="javascript:;">TOOL 扩展工具</a></h3>
     <p>V2.0 - 2016.0421 - DbgMs</p>
     <p>为内容APP提供扩展字段等</p>
     <p>
<?php if($lists['tool']['install']==1):?>
 <?php if($lists['tool']['disable']==1):?>
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('TOOL',0)">启用</button>
 <?php else:?>  
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('TOOL',1)">禁用</button>
 <?php endif;?>
     <button type="button" class="dbgms_btn" onclick="dbgmsModUninstall('TOOL')">卸载</button>
      <button type="button" class="dbgms_btn" onclick="dbgmsModTestdata('TOOL')">安装测试数据</button>
      <button type="button" class="dbgms_btn" onclick="database('TOOL')">备份数据</button>
      <button type="button" class="dbgms_btn" onclick="database('TOOL')">恢复数据</button>
      <button type="button" class="dbgms_btn" onclick="database('TOOL')">打包数据</button>
<?php else:?>   
 <button type="button" class="dbgms_btn" onclick="dbgmsModInstall('TOOL')">安装</button>  
<?php endif;?> 
    </p>
    </div>
   </li>

   <li class="<?php echo $lists['weixin']['install']==1?'s-success':'s-warning'?>">
    <div class="u-img">
     <span class="icon icon-comments-alt"></span>
    </div>
    <div class="apptxt">
     <h3><a href="javascript:;">WEIXIN 微信开发</a></h3>
     <p>V2.0 - 2016.0425 - DbgMs</p>
     <p>微信公众号开发</p>
     <p>
<?php if($lists['weixin']['install']==1):?>
 <?php if($lists['weixin']['disable']==1):?>
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('WEIXIN',0)">启用</button>
 <?php else:?>  
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('WEIXIN',1)">禁用</button>
 <?php endif;?>
     <button type="button" class="dbgms_btn" onclick="dbgmsModUninstall('WEIXIN')">卸载</button>
      <button type="button" class="dbgms_btn" onclick="dbgmsModTestdata('WEIXIN')">安装测试数据</button>
      <button type="button" class="dbgms_btn" onclick="database('WEIXIN')">备份数据</button>
      <button type="button" class="dbgms_btn" onclick="database('WEIXIN')">恢复数据</button>
      <button type="button" class="dbgms_btn" onclick="database('WEIXIN')">打包数据</button>
<?php else:?>   
 <button type="button" class="dbgms_btn" onclick="dbgmsModInstall('WEIXIN')">安装</button>  
<?php endif;?> 
    </p>
    </div>
   </li>

   <li class="<?php echo $lists['live']['install']==1?'s-success':'s-warning'?>">
    <div class="u-img">
     <span class="icon icon-facetime-video"></span>
    </div>
    <div class="apptxt">
     <h3><a href="javascript:;">LIVE 直播系统</a></h3>
     <p>V2.0 - 2016.0502 - DbgMs</p>
     <p>在线直播系统</p>
     <p>
<?php if($lists['live']['install']==1):?>
 <?php if($lists['live']['disable']==1):?>
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('LIVE',0)">启用</button>
 <?php else:?>  
 <button type="button" class="dbgms_btn" onclick="dbgmsModDisable('LIVE',1)">禁用</button>
 <?php endif;?>
     <button type="button" class="dbgms_btn" onclick="dbgmsModUninstall('LIVE')">卸载</button>
      <button type="button" class="dbgms_btn" onclick="dbgmsModTestdata('LIVE')">安装测试数据</button>
      <button type="button" class="dbgms_btn" onclick="database('LIVE')">备份数据</button>
      <button type="button" class="dbgms_btn" onclick="database('LIVE')">恢复数据</button>
      <button type="button" class="dbgms_btn" onclick="database('LIVE')">打包数据</button>
<?php else:?>   
 <button type="button" class="dbgms_btn" onclick="dbgmsModInstall('LIVE')">安装</button>  
<?php endif;?> 
    </p>
    </div>
   </li>



  </ul>
 </div>
 <script type="text/javascript">
var ajaxurl = '<?php echo $con_url;?>';
function dbgmsModDisable(sign, val) {
	if (confirm('确定要切换【' + sign + '】系统模块 状态吗？')) {
		$.ajax({
			url : ajaxurl + '&act=disable&val=' + val + '&sign=' + sign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$.msglayer('切换【' + sign + '】系统模块 状态成功');
					setTimeout(function(){
						location.href = ajaxurl;
					},1000);
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}
function dbgmsModInstall(sign) {
	if (confirm('确定要安装【'+sign+'】系统模块 吗？')) {
		$.ajax({
			url : ajaxurl + '&act=install&sign=' + sign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$.msglayer(' 【' + sign + '】系统模块 安装成功');
					setTimeout(function(){
						location.href = ajaxurl;
					},1000);
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}
function dbgmsModUninstall(sign) {
	if (confirm('确定要卸载【'+sign+'】系统模块 吗？')) {
		$.ajax({
			url : ajaxurl + '&act=uninstall&sign=' + sign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$.msglayer('【' + sign + '】系统模块 卸载成功');
					setTimeout(function(){
						location.href = ajaxurl;
					},1000);
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}
function dbgmsModTestdata(sign) {
	if (confirm('确定要卸载【'+sign+'】系统模块 吗？')) {
		$.ajax({
			url : ajaxurl + '&act=testdata&sign=' + sign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$.msglayer('安装【' + sign + '】系统模块 测试数据成功');
					setTimeout(function(){
						location.href = ajaxurl;
					},1000);
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}
function dbgmsModBackups(sign, val) {
 //export
	if (confirm('确定要备份【'+sign+'】系统模块 数据吗？')) {
		$.ajax({
			url : ajaxurl + '&act=backups&val=' + val + '&sign=' + sign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$.msglayer('切换【' + sign + '】系统模块 状态成功');
					setTimeout(function(){
						location.href = ajaxurl;
					},1000);
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}
function dbgmsModRestore(sign, val) {
 //restore
	if (confirm('确定要恢复【'+sign+'】系统模块 数据吗？')) {
		$.ajax({
			url : ajaxurl + '&act=restore&val=' + val + '&sign=' + sign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$.msglayer('切换【' + sign + '】系统模块 状态成功');
					setTimeout(function(){
						location.href = ajaxurl;
					},1000);
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}
function dbgmsModPackage(sign, val) {
 //package
	if (confirm('确定要将【'+sign+'】系统模块 数据打包成安装数据 吗？')) {
		$.ajax({
			url : ajaxurl + '&act=package&val=' + val + '&sign=' + sign,
			type : 'POST',
			async : false,
			dataType : 'json',
			success : function(result) {
				if (result.StatusCode == 200) {
					$.msglayer('切换【' + sign + '】系统模块 状态成功');
					setTimeout(function(){
						location.href = ajaxurl;
					},1000);
					return;
				} else {
					$.msglayer(result.msg);
				}
			}
		});
	}
}
 </script>
</div>
<div class="" style="display: none; position: absolute;">
 <div class="aui_outer">
  <table class="aui_border">
   <tbody>
    <tr>
     <td class="aui_nw"></td>
     <td class="aui_n"></td>
     <td class="aui_ne"></td>
    </tr>
    <tr>
     <td class="aui_w"></td>
     <td class="aui_c"><div class="aui_inner">
       <table class="aui_dialog">
        <tbody>
         <tr>
          <td colspan="2" class="aui_header"><div class="aui_titleBar">
            <div class="aui_title" style="cursor: move;"></div>
            <a class="aui_close" href="javascript:/*artDialog*/;">×</a>
           </div></td>
         </tr>
         <tr>
          <td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: none;"></div></td>
          <td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 20px 25px;"></div></td>
         </tr>
         <tr>
          <td colspan="2" class="aui_footer"><div class="aui_buttons" style="display: none;"></div></td>
         </tr>
        </tbody>
       </table>
      </div></td>
     <td class="aui_e"></td>
    </tr>
    <tr>
     <td class="aui_sw"></td>
     <td class="aui_s"></td>
     <td class="aui_se" style="cursor: se-resize;"></td>
    </tr>
   </tbody>
  </table>
 </div>
</div>