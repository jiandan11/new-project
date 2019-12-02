<script type="text/javascript" src="<?php echo base_url()?>plugin/color/soColorPacker.js"></script>
<?php if($act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $curr_url;?>">内容列表</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
 <ul id="dbgms_tabs">
  <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')"><span class="icon"></span> 常规信息</a></li>
  <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')"><span class="icon"></span> 高级参数</a></li>
 </ul>
 <div class="more">
  <a href="javascript:;" onclick="window.location.reload();"><span class="icon"></span> 刷新</a>
 </div>
 <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
</div>
<!--  -->
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
  <input type="hidden" readonly="readonly" value="<?php echo $row['id'];?>" name="id" /> <input type="hidden" readonly="readonly" value="update" name="act" /><input type="hidden" readonly="readonly" value="modelid" name="<?php echo $model['id'];?>" />
  <!-- 常规信息 -->
  <div id="tab1" style="display: block;" class="dbgms_tab">
   <table class="subtab">
    <tbody>
     <tr>
      <td class="ft">文档标题：</td>
      <td>
       <div class="hpft">
        <input type="text" class="itxt biaoci" name="title" id="title" style="width: 474px" value="<?php echo $row['title'];?>"> <a href="###" id="signBtn">检测唯一性</a>
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">发布时间：</td>
      <td>
       <div class="hpft">
        <input type="text" class="itxt" name="intime" style="width: 180px" value="<?php if(empty($row['intime'])){echo date("Y-m-d H:i:s",time());}else{echo date("Y-m-d H:i:s", $row['intime']);}?>" /> &nbsp;&nbsp;&nbsp; 最后更新时间：
       </div> <input type="text" class="itxt" name="uptime" style="width: 180px" title="留空则以当前真实时间为准" value="<?php if(empty($row['uptime'])){echo date("Y-m-d H:i:s",time());}else{echo date("Y-m-d H:i:s", $row['uptime']);}?>">
      </td>
     </tr>
     <tr>
      <td class="ft">责任编辑：</td>
      <td>
       <div class="hpft">
        <input type="hidden" readonly="readonly" value="<?php echo $_admin['id'];?>" name="adminid"> <input type="text" class="itxt" name="adminname" style="width: 180px" value="<?php echo $_dbgms_admin['name'];?>"> &nbsp;&nbsp;&nbsp; 文档状态： <select name="state" style="width: 150px">
         <option value="0">正常发布</option>
         <option value="-1">定时发布</option>
         <option value="-10">内容库</option>
         <option value="-5">待审核</option>
         <option value="3">栏目内容</option>
         <option value="5">大头条</option>
         <option value="7">短头条_1</option>
         <option value="8">短头条_2</option>
         <option value="9">黑头条</option>
         <option value="10">小头条</option>
         <option value="20">幻灯</option>
         <option value="25">滚动</option>
         <option value="30">一级推荐</option>
         <option value="35">二级推荐</option>
         <option value="40">三级推荐</option>
         <option value="45">位置一</option>
         <option value="50">位置二</option>
         <option value="-90">回收站</option>
        </select>
        <script type="text/javascript">$(function(){$("select[name='state']").attr("value","<?php echo empty($row['state'])?0:$row['state'];?>");});</script>
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">作者(来源)：</td>
      <td>
       <div>
        <input type="hidden" readonly="readonly" value="<?php echo empty($row['authorid'])?0:$row['authorid'];?>" name="authorid">
        <!--  -->
        <input type="text" readonly="readonly" class="itxt" style="width: 180px; color: #999;" value="<?php echo $row['username'];?>">
       </div>
      </td>
     </tr>
     <tr>
      <td class="ft">推荐位置：</td>
      <td>
       <div class="labelwrp" style="width: 650px; line-height: 30px;">
        <label><input type="checkbox" name="weizhi[]" value="1">(R)右边推荐</label>
       </div>
      </td>
     </tr> 
<?php dbg_diyfield ( 'load', 'column', $model,$row['columnid'] );?>
<?php foreach($diyfields as $k=>$val){$val['path'] = $model['sign'];dbg_diyfield ( 'load', $val['type'], $val, $row[$val['field']] );}?>
      <tr>
      <td class="ft">关键词：</td>
      <td><input type="text" name="keywords" id="keywords" class="itxt" value="<?php echo $row['keywords'];?>" /> <span id="get_keywords" class="u-ico f-csp"><span class="icon"></span> 提取</span></td>
     </tr>
     <tr>
      <td class="ft">描述：</td>
      <td>
       <div class="hpft">
        <textarea name="description" id="description" class="diyfield_description"><?php echo $row['description'];?></textarea>
        <span class="diyfield_description_extract"><a href="javascript:;" id="get_description">提取描述</a></span>
       </div>
      </td>
     </tr>
    </tbody>
   </table>
  </div>
  <!-- 高级参数 -->
  <div id="tab2" class="dbgms_tab" style="display: none;">
   <table class="subtab">
    <tbody>
     <tr>
      <td>是否允许评论等信息!</td>
     </tr>
    </tbody>
   </table>
  </div>
  <div style="margin-left: 150px; margin-top: 30px; height: 100px;">
   <a class="dbgms_btn_submit" onclick="content_update()" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $curr_url;?>">返回列表</a>
  </div>
 </form>
 <script type="text/javascript">
  var get_fields = new function(){}; 
  var tpl_val = new function(){}; 
  var befrom_val = new function(){}; 
  var image_val =  new function(){}; 
  $(document).ready(function() { 
  	//颜色
  	$('#corol_button').soColorPacker({
  	textChange:false, 
  	callback:function(c){
  		$('#title').css("color", c.color);
  		$('#font_color').val(c.color);
  		}
  	});
  	//加粗
  	$('#bold_button').click(function(){
  		if($('#font_bold').val()==0){
  			$('#title').css("font-weight",'bold');
  			$('#font_bold').val(1);
  			}else{
  			$('#title').css("font-weight",'normal');	
  			$('#font_bold').val(0);
  		}
  	});

  	//提取关键词
  	$('#get_keywords').click(function(){
  		$.ajax({ 
  		    url:"<?php echo $con_url;?>&act=get_keyword",
  		    type:"POST",
  		    data:{title:$('#title').val(),content:$('#description').val()},
            dataType:'json',
  		    success:function(result){
  		    	if(result.status=='ok'){
  		    		$('#keywords').val(result.data);
  	  			}else{
 	   		       alert(result.msg);
  	  			}
  		    }
  	   });
  	});
  	 //提取描述
   $('#get_description').click(function() {
          var content=UE.getEditor('editor').getContent();
		    content=content.substring(0,500);
		    content=content.replace(/\s+/g," ")
		    content=content.replace(/[\r\n]/g," ");
		    content = content.replace(/<\/?[^>]*>/g,'');
		    if(content.length > 250){
		    content = content.substring(0,250);
    }
    $("#description").val(content);
   });
   //时间选择
  
  	//内容来源列表	
  	function befrom_list(id){
  		var list = [ 
  		{
  			href: "javascript:befrom_val('"+id+"','DUXCMS');",
  			text: "DUXCMS"
  		},
  		 {
  			text: "请选择内容来源"
  		}];
  		return list;
  	}


  });

function content_update(){
  <?php if( defined ( 'ISUEDITOR' )!=''):?> 
//  if (!UE.getEditor('editor').hasContents()){
//      alert('请先填写内容!');
//     }else{
   document.getElementById("<?php echo ISUEDITOR;?>").value=UE.getEditor('editor').getContent();
//     }
    <?php endif;?>
  $.ajax({ 
    url:"<?php echo $update_url;?>",
    type:"POST",
    data:$('#DbgMsFormEdit').serialize(),
    success:function(result){
      if(result==1){
        alert("成功!");
        location.href='<?php echo $curr_url.'&page='.$page;?>';
        return;
        console.log(result);
      }else{
        alert(result);
      }
    }
  });
}
</script>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $curr_url;?>&act=edit">新增内容</a></span>
  <div class="span_r">
   <form name="topSearchform" id="topSearchform" action="<?php echo $curr_url;?>" method="get">
    <!--  -->
    <input type="hidden" name="modelid" value="<?php echo $search['modelid'];?>" /> <input type="hidden" name="con" value="content" />
    <!--  -->
    <input type="hidden" name="orderby" id="orderby" value="<?php echo $search['orderby'];?>"> <input type="hidden" name="orderdesc" id="orderdesc" value="<?php echo $search['orderdesc'];?>">
    <!--  -->
    <input type="hidden" name="autokey" id="autokey" value="<?php echo $search['autokey'];?>" /> <input type="hidden" name="autoval" id="autoval" value="" />
    <!--  -->
    <select class="tsel" name="qtype" style="width: 110px">
     <option value="title">文档标题</option>
     <option value="description">简要内容</option>
     <option value="keywords">关键词</option>
    </select> &nbsp; <input type="text" name="q" class="titxt" value="<?php echo empty($search['q'])?'标题、描述、关键词':$search['q'];?>" onfocus="if (value =='标题、描述、关键词'){value=''}" onblur="if (value ==''){value='标题、描述、关键词'}" style="width: 250px"> &nbsp;
    <!--  -->
    <select class="tsel" name="columnid" id="searchcolumnid" style="width: 150px">
     <option value="0">全部栏目</option>
<?php foreach( $column_list as $val):?>
<option style="font-weight: bold;" value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
<?php if (!empty($val['list'])){foreach( $val['list'] as $val2):?>
<option style="font-weight: bold;" value="<?php echo $val2['id'];?>">&nbsp;&nbsp;|-->&nbsp;<?php echo $val2['name'];?></option>
<?php if (!empty($val2['list'])){foreach( $val2['list'] as $val3):?>
<option style="font-weight: bold;" value="<?php echo $val3['id'];?>">&nbsp;&nbsp;&nbsp;&nbsp;|---▶ &nbsp;<?php echo $val3['name'];?></option>
<?php endforeach;}?>
<?php endforeach;}?>
<?php endforeach;?>
          </select> &nbsp; <select class="tsel" name="tlimit" style="width: 90px">
     <option value="0">不限时间</option>
     <option value="1">24小时内</option>
     <option value="3">3天内</option>
     <option value="7">一周内</option>
     <option value="30">一个月内</option>
     <option value="90">三个月内</option>
     <option value="180">半年内</option>
     <option value="360">一年内</option>
    </select> &nbsp;
    <!--  -->
    <input type="button" value="搜索 " class="dbgms_btn" onclick="dbgcms_content_search()"> <input type="button" value="更新所有缓存" class="dbgms_btn" onclick="alert('暂无');">
   </form>
  </div>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th width="3%">选</th>
    <th width="4%"><a href="javascript:void(0);" onclick="dbgcms_content_order('id')">ID</a></th>
    <th width="6%">推荐位置</th>
    <th width="40%"><a href="javascript:void(0);" onclick="dbgcms_content_order('title')">标题</a></th>
    <th><a href="javascript:void(0);" onclick="dbgcms_content_order('columnid')">栏目</a></th>
    <th>状态(位置)</th>
    <th>点击量</th>
    <th>发布者</th>
    <th>更新时间</th>
    <th>审核员</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key =>$val):?>
	   <tr id="tr<?php echo $val['id'];?>">
    <td><input type="checkbox" value="<?php echo $val['id'];?>" name="ids[]"></td>
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['weizhi'];?></td>
    <td><?php echo $val['title'];?></td>
    <td><?php echo $val['cname'];?></td>
    <td><?php echo $val['statename'];?></td>
    <td><?php echo $val['hits'];?></td>
    <td><?php echo $val['username'];?></td>
    <td><?php echo get_time_deviation($val['uptime']);?></td>
    <td><?php echo $val['adminname'];?></td>
    <td><a href="<?php echo $curr_url.'&page='.$page.'&act=edit&id='. $val['id'];?>">【编辑】</a><a target="_blank" href="<?php echo $val['link'];?>">[ 预览 ]</a><a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a></td>
   </tr>
<?php endforeach;?>
      <tr class="btm">
    <td><input type="checkbox" id="checkall" onclick="dbgmsCheckAll()"></td>
    <td colspan="12"><input type="button" onclick="dbgmsPause();" value="排序" class="dbgms_btn"> <input type="button" onclick="dbgmsPause();" value="CDN" class="dbgms_btn"> <input type="button" value="更新收录" class="dbgms_btn"> <input type="button" value="更新缓存" class="dbgms_btn"></td>
   </tr>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
 <script type="text/javascript">
    $(function(){
        $("select[name='columnid']").attr("value","<?php echo empty($search['columnid'])?'0':$search['columnid'];?>");
        $("select[name='qtype']").attr("value","<?php echo empty($search['qtype'])?'title':$search['qtype'];?>");
        $("select[name='tlimit']").attr("value","<?php echo empty($search['tlimit'])?'0':$search['tlimit'];?>");
        /*栏目id 修改就跳转*/
        $('#searchcolumnid').on('change',function(){
        	var searchcolumnid = $(this).children('option:selected').val();
        	dbgcms_content_search();
        });
    });
    function dbgcms_content_search(key,val){
    	key = key || '';
    	val = val || '';
    	if(key != '' && val != ''){
    		$('#autokey').val(key);
    		$('#autoval').val(val);
    	}else{
    		$('#autokey').add($('#autoval')).val('');
    	}
    	document.topSearchform.submit();
    }

    function dbgcms_content_order(field){
    	if($('#orderby').val() == field){
    		$('#orderdesc').val($('#orderdesc').val().toUpperCase() == 'DESC' ? 'ASC':'DESC');
    	}else{
    		$('#orderby').val(field);
    		$('#orderdesc').val('ASC');
    	}
    	dbgcms_content_search();
    }
    </script>
</div>
<?php endif;?>