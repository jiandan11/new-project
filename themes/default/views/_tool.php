<!-- DbgMs通用工具 -->
<link rel="stylesheet" type="text/css" href="<?php echo $_baseurl;?>ui/plugin/tool/dbgms.tool.css" />
<script type="text/javascript" src="<?php echo $_baseurl;?>ui/plugin/tool/dbgms.tool.js"></script>
<!-- 通用返回顶部 -->
<div class="dbgms-tool-backtop">
 <img src="<?php echo $_baseurl;?>ui/plugin/tool/tool_backtop.png" />
 <p>TOP</p>
</div>
<?php if($_site['isopenqq']==1):?>
<!-- 通用qq客服 -->
<div class="dbgms-tool-qq dbgms_qq" id="DbgMsToolQq">
 <div class="dbgms_qq">
  <div class="dbgms_qq_hd">
   <a title="隐藏" class="dbgms_qq_minbtn"></a>
  </div>
  <div class="dbgms_qq_ct">
   <div class="qqserver" id="dbgms_qqarr"></div>
   <div style="text-align: left; margin-left: 4px;" id="dbgtool_phone"></div>
   <div class="dbgms-tool-qq-img">
    <p><img src="<?php echo $_baseurl;?>ui/plugin/tool/style1.jpg" style="width: 120px; height: 120px;" /></p>
   </div>
  </div>
  <div class="dbgms_qq_ft"></div>
 </div>
 <div class="dbgms_qq_maxbtn"></div>
</div>
<script type="text/javascript">
  $(function() {
   $("#DbgMsToolQq").qq({
    qq : "<?php echo $_site['qq'];?>",
    phone : "<?php echo $_site['phone'];?>",
    float : 'left',
    minStatue : false,
    durationTime : 300,
    AutoOpen:false,
   });
 });
 </script>
<?php endif;?>
<?php if($_site['isopencnzz']==1):?>
<div style="display: none;"><?php echo $_site['cnzz'];?></div>
<?php endif;?>