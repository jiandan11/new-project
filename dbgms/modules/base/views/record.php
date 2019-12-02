<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>ui/css/record.css">
<div class="g-home-top s-home-top">
 <div class="m-home-top-list s-home-top-list">
  <ul>
   <li><span class="icon icon-folder-open-alt"></span> 栏目数：<span class="u-label u-label-info"><?php echo $total_column;?></span></li>
   <li><span class="icon icon-file"></span> 内容数：<span class="u-label u-label-info"><?php echo $total_news;?></span></li>
   <li><span class="icon icon-file"></span> 文件数：<span class="u-label u-label-info">?</span></li>
   <li><span class="icon icon-file"></span> TAG数：<span class="u-label u-label-info">?</span></li>
  </ul>
 </div>
 <div class="f-cb"></div>
</div>
<!-- 统计信息 -->
<div class="g-home-module s-home-module">
 <div class="u-title u-tt u-tt-md">
  <span class="f-fl">本站7天访问趋势</span> <span class="f-fr u-tt-sm "> <span class="u-label u-label-success">展示量(PV)</span> <span class="u-label u-label-warning">访问次数</span> <span class="u-label u-label-info">独立访客(IP)</span></span>
  <div class="f-cb"></div>
 </div>
 <div class="m-chart">
  <canvas id="myChart"></canvas>
 </div>
</div>
<!-- 统计信息 -->
<div class="g-home-module s-home-module">
 <div class="u-title u-tt u-tt-md">统计信息</div>
 <table class="m-table  m-table-row">
  <thead>
   <tr>
    <th width="250">实时备忘事件~ ( 记录未完成或待办事宜 )</th>
    <th></th>
    <th>内容统计</th>
    <th></th>
    <th>访问统计</th>
    <th></th>
   </tr>
  </thead>
  <tbody>
   <tr>
    <!-- onblur 事件会在对象失去焦点时发生。 -->
    <td rowspan="5"><textarea id="notebook" style="padding: 2px 5px;" cols="33" rows="10" onblur="" placeholder="实时更新备忘事件~"><?php echo $notebook;?></textarea></td>
    <td></td>
    <td>待审核：</td>
    <td></td>
    <td>今日访问人数</td>
    <td></td>
   </tr>
   <tr>
    <td></td>
    <td>昨日新增：</td>
    <td></td>
    <td>今日访问量</td>
    <td></td>
   </tr>
   <tr>
    <td></td>
    <td>新增图片</td>
    <td></td>
    <td>总访问人数</td>
    <td></td>
   </tr>
   <tr>
    <td></td>
    <td>新增反馈</td>
    <td></td>
    <td>总访问人数</td>
    <td></td>
   </tr>
  </tbody>
 </table>
 <script type="text/javascript">
 $(document).ready(function(){
   $('#notebook').on('change',function(){
    console.log($(this).val());
     $.ajax({
         url:'<?php echo $con_url?>&act=update',
         type:'post',
         data:{notebook:$(this).val()},
         success:function(result){
             
         }
     });
   });
});
  </script>
</div>
<!-- 个人信息 -->
<div class="g-home-module s-home-module">
 <div class="u-title u-tt u-tt-md">个人信息</div>
 <table class="m-table  m-table-row">
  <tbody>
   <tr>
    <td class="cola">您好：</td>
    <td width="250">_ _ _ <?php echo $_admin['name'];?>_ _ _ </td>
    <td class="cola">所属：</td>
    <td></td>
   </tr>
   <tr>
    <td>本次登录时间：</td>
    <td><?php echo date("Y-m-d H:i:s",$_admin['logintime']);?></td>
    <td>本次登录 IP：</td>
    <td><?php echo $_admin['loginip'];?></td>
   </tr>
  </tbody>
 </table>
</div>
<!-- 系统信息 -->
<div class="g-home-module s-home-module">
 <div class="u-title u-tt u-tt-md">系统信息</div>
 <table class="m-table  m-table-row">
  <tbody>
   <tr>
    <td class="cola">系统名称：</td>
    <td width="250">Dbg MS</td>
    <td class="cola">意见反馈：</td>
    <td><a class="writer" target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=team@dbgms.cn" style="font-size: 12px; color: #849B2E;" title="意见反馈">反馈</a></td>
   </tr>
   <tr>
    <td class="cola">安全提示：</td>
    <td width="550" colspan="3"><a href="http://www.dbgms.cn/" target="_blank" style="color: #ff0000;">※ 建议您将dbgms目录设置为755（linux）或只读（windows），点击查看教程</a></td>
   </tr>
   <tr>
    <td class="cola">DbgMS程序版本：</td>
    <td width="250">DbgMS v2.0 Release 2016/01/19 ~</td>
    <td class="cola">服务器时间：</td>
    <td><?php echo date("Y-m-d G:i T",time());?></td>
   </tr>
   <tr>
    <td class="cola">操作系统软件：</td>
    <td width="250"><?php echo $sys_info['os'];?></td>
    <td class="cola">服务器软件：</td>
    <td><?php echo $sys_info['web_server'];?></td>
   </tr>
   <tr>
    <td class="cola">MySQL 版本：</td>
    <td width="250">数据库及大小 5.6.21-log (2.65 MB)</td>
    <td class="cola">上传文件：</td>
    <td><?php echo $sys_info['fileupload'];?></td>
   </tr>
   <tr>
    <td class="cola">版权所有：</td>
    <td width="250">小庄（系统设计+UI设计+程序开发）</td>
    <td class="cola">团队成员：</td>
    <td>小庄</td>
   </tr>
   <tr>
    <td class="cola">官方网站：</td>
    <td width="250"><a href="http://www.dbgms.cn/" target="_blank" style="color: #849B2E;">http://www.dbgms.cn/</a></td>
    <td class="cola">技术支持：</td>
    <td><a href="http://www.dbgms.cn/" target="_blank" style="color: #849B2E;">使用手册</a></td>
   </tr>
   <tr>
    <td class="cola">技术QQ：</td>
    <td width="250">240337740</td>
    <td class="cola">官方QQ讨论群：</td>
    <td>87208295</td>
   </tr>
   <tr>
    <td>最新版本：</td>
    <td><button type="button" class="u-btn u-btn-sm" onclick="dbgmsVersionUpdate()">检测更新</button></td>
    <td>授权查询：</td>
    <td><button type="button" class="u-btn u-btn-sm">查询授权</button></td>
   </tr>
   <tr>
    <td class="cola">授权类型：</td>
    <td width="250">未授权（点击购买）</td>
    <td class="cola">序列号：</td>
    <td>未激活（点击激活）</td>
   </tr>
   <tr>
    <td style="border-bottom: none">系统工具：</td>
    <td style="border-bottom: none" colspan="3"><button type="button" id="sysinfo" class="u-btn u-btn-c4 u-btn-sm">环境信息</button> &nbsp;&nbsp;
     <button type="button" id="sysbom" class="u-btn u-btn-c4 u-btn-sm">BOM清除</button></td>
   </tr>
  </tbody>
 </table>
</div>
<script type="text/javascript">
function dbgmsVersionUpdate() {
  $.ajax({
   url : 'http://www.dbgms.cn/versionupdate/inspect?version=2.0.2016.04.22',
   type : 'GET',
   async : false,
   dataType : 'jsonp',
   jsonp: "callbackparam",//服务端用于接收callback调用的function名的参数  
   jsonpCallback:"success_jsonpCallback",//callback的function名称  
   error: function() {
	   alert('请求错误~');
   },
   success : function(result) {
    if (result.StatusCode == 200) {
      $.msglayer(result.msg);
      return;
    } else {
       $.msglayer(result.msg);
    }
   }
  });
}
// function success_jsonpCallback(){  
//     alert('back');  
// }  
function dbgmsVersionGrant() {
  $.ajax({
   url : 'http://www.dbgms.cn/versionupdate/grant?code=',
   type : 'GET',
   async : false,
   dataType : 'jsonp',
   error: function() {
	   alert('请求错误~');
   },
   success : function(result) {
    if (result.StatusCode == 200) {
      $.msglayer(result.msg);
      return;
    } else {
       $.msglayer(result.msg);
    }
   }
  });
}
</script>