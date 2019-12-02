<script type="text/javascript" src="<?php echo base_url()?>ui/js/jquery.cookie.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>plugin/powerFloat/style.css" />
<script type="text/javascript" src="<?php echo base_url()?>plugin/powerFloat/powerFloat.js"></script>
<?php if($use=='add' ||$use=='edit' ):?>
<div class="dbg_warp">
 <div class="dbgms_tabs_wrap">
  <h2>
   <a href="<?php echo $con_url;?>">专辑管理</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
  </h2>
  <ul id="dbgms_tabs">
   <li><a class="on" href="javascript:void(0);" onclick="dbgjs_tab(this,'tab1')">基本信息</a></li>
   <li><a href="javascript:void(0);" onclick="dbgjs_tab(this,'tab2')">自定义调用</a></li>
  </ul>
  <div class="more">
   <a href="javascript:;" onclick="window.location.reload();"><span class="icon"></span> 刷新</a>
  </div>
  <script type="text/javascript">function dbgjs_tab(obj,id){$('#dbgms_tabs li a').removeClass('on');$('#dbgms_tabs li').removeClass('on');$(obj).addClass('on');$('.dbgms_tab').css("display","none");$('#'+id).css("display","block");}</script>
 </div>

 <form method="post" id="catform" action="index.php">
  <input type="hidden" name="tn" value="{$tn}" /> <input type="hidden" name="ac" value="{$ac}" /> <input type="hidden" name="id" value="{$id}" id="signId" /> <input type="hidden" name="sub" value="save" /> <input type="hidden" name="oldsign" value="{$row[sign]}" /> <input type="hidden" name="oldcattype" value="{$row[cattype]}" />
  <table cellspacing="0" class="subtab">
   <tr>
    <td class="ft">所属大分类</td>
    <td><select name="tid" style="width: 200px" class="tsel">
      <option value="0">{$topSelect}
    
    </select></td>
   </tr>
   <tr auto="1" field="text" name="{$tit}名称" min="1" max="30">
    <td class="ft">{$tit}名称</td>
    <td><input type="text" name="name" class="itxt" value="{$row[name]}" /></td>
   </tr>
   <tr auto="1" field="text" name="{$tit}标识" min="1" max="20">
    <td class="ft">{$tit}标识</td>
    <td><div class="hpft">
      <input type="text" name="sign" class="itxt" value="{$row[sign]}" style="width: 150px;" id="signVal" /> <a href="###" id="signBtn">检测唯一性</a>
     </div>
     <div class="hpdiv">
      <img src="style/img/s.gif" class="autohelp" alt="非静态生成时参与到URL得拼接中，仅可使用字母且保证唯一性\n替代{$tit}ID作为伪静态标识符，有助于SEO" />
     </div></td>
   </tr>

   <tr>
    <td class="ft">SEO标题</td>
    <td><input type="text" name="title" class="itxt" value="{$row[title]}" style="width: 416px;" /></td>
   </tr>

   {$form_thumb}

   <tr>
    <td class="ft">显示顺序</td>
    <td><input type="text" name="rank" class="itxt" value="{$row['rank']}" style="width: 150px;" /></td>
   </tr>
   <tr>
    <td class="ft">是否隐藏</td>
    <td><label><input type="radio" name="hidden" value="0" {if $row['hidden']==0}checked{/if}> 否</label>&nbsp;&nbsp; <label><input type="radio" name="hidden" value="1" {if $row['hidden']==1}checked{/if}> 是</label></td>
   </tr>
   <tr>
    <td class="ft">关联栏目</td>
    <td><div class="hpft">
      <select name="cid" style="width: 200px" class="tsel">
       <option value="0">-- 可关联栏目 -- {catlogSelect($row['cid'])}
      
      </select>
     </div>
     <div class="hpdiv">
      <img src="style/img/s.gif" class="autohelp" alt="关联栏目不会和栏目产生直接关系\n仅为了在方便在对应栏目下调用所关联类别" />
     </div></td>
   </tr>
   <tr>
    <td class="ft">每页显示</td>
    <td><input type="text" name="pagerow" class="itxt" value="{$row['pagerow']}" style="width: 150px;" /></td>
   </tr>
   <tr>
    <td class="ft">最多页数</td>
    <td><input type="text" name="maxpage" class="itxt" value="{$row[maxpage]}" style="width: 150px;" /> 0为不限</td>
   </tr>
   <tr>
    <td class="ft">CMD指数</td>
    <td><input type="text" name="cmd" class="itxt" value="{$row[cmd]}" style="width: 150px;" /></td>
   </tr>
   <tr>
    <td class="ft">静态生成</td>
    <td>
     <div class="labelwrp" id="urltypeLabel">
      <label><input type="radio" name="urltype" value="0" {if $row['urltype']==0}checked{/if}> 静态</label> <label><input type="radio" name="urltype" value="1" {if $row['urltype']==1}checked{/if}> 伪静态</label> <label><input type="radio" name="urltype" value="2" {if $row['urltype']==2}checked{/if}> 动态</label>
     </div>
     <div class="hpdiv">
      <img src="style/img/s.gif" class="autohelp" alt="如果服务器环境允许，推荐使用伪静态\n本程序使用前台缓存技术，伪静态并不会对MySQL进行频繁查询" />
     </div>
    </td>
   </tr>

   <tr>
    <td class="ft"><b>频道页</b></td>
    <td>
     <div class="hpft">
      模板 <input type="text" name="tpl" class="itxt" value="{$row[tpl]}" style="width: 180px;" />&nbsp;&nbsp; 生成路径 <input type="text" name="dir" class="itxt" value="{$row[dir]}" style="width: 260px;" />
     </div>
     <div class="hpdiv">
      <img src="style/img/s.gif" class="autohelp" alt="频道页是所有启用列表的一个集合单页面；若仅启用一个列表，此设置无效，{$tit}首页即所启用的列表页。\n启用的列表页是所绑定模型的内容集合页面、一个可以分页的列表页面。" />
     </div>
    </td>
   </tr>
   <tr>
    <td class="ft" style="vertical-align: top"><b>列表页</b></td>
    <td>
     <div style="width: 100%; margin-bottom: 8px; height: 16px;">
      <div style="width: 70px; float: left; margin-right: 18px;" />
      自定义名称
     </div>
     <div style="width: 70px; float: left; margin-right: 18px;" />标识符
     </div>
     <div style="width: 180px; float: left; margin-right: 18px;" />模板
     </div>
     <div style="width: 240px; float: left; margin-right: 18px;" />生成路径
     </div>
     <div style="width: 90px; float: left;" />绑定模型
     </div>
     </div> {loop $listsets $key $listset}
     <div style="width: 100%; margin-bottom: 8px;">
      <input type="text" name="list_name[]" class="itxt" value="{$listset[name]}" style="width: 70px;" />&nbsp;&nbsp; <input type="text" name="list_sign[]" class="itxt" value="{$listset[sign]}" style="width: 70px;" />&nbsp;&nbsp; <input type="text" name="list_tpl[]" class="itxt" value="{$listset[tpl]}" style="width: 180px;" />&nbsp;&nbsp; <input type="text" name="list_dir[]" class="itxt" value="{$listset[dir]}" style="width: 240px;" />&nbsp;&nbsp;
      <select name="list_cat[]" style="width: 90px" class="tsel">
       <option value="0">{$listset[select]}
      
      </select>
     </div> {/loop}
    </td>
   </tr>


   <tr class="sub">
    <td class="ft">&nbsp;</td>
    <td><input type="submit" class="btn" value="确认提交"></td>
   </tr>
  </table>
 </form>
 <div class="subtab" style="color: #808080; padding-top: 14px; display: none">当类别创建后，才可以编辑自定义调用</div>

 <script src="js/form.js"></script>
 <script language="javascript">
$(function(){
   $('#signBtn').bind('click',function(){
       var v=$.trim($('#signVal').val());
	   if(v==''){
	       adminmsg('标识不能为空');
	   }else{
	       var id=$('#signId').val(),msg;
		   $.post('index.php?tn={$tn}&ac=signcheck&id='+id+'&sign='+v+'&h='+now(),function(data){
		       if(data==1){
			      msg='该标识已经被使用';
			   }else{
			      msg='可以使用';
			   }
			   adminmsg(msg);
		   });
	   }
   });
   $.CheckFrm('#catform');
});
</script>
<?php elseif($use=='diys'):?>
<div class="selmenu">
  <ul>
   <input type="button" value=" 返回{$tit}管理 " class="btn2" style="float: right; margin-right: 4px" onclick="location.href='index.php?tn={$tn}&ac=types&tid={$tid}'">
   <a href="index.php?tn={$tn}&ac=edit&id={$id}">基本信息</a>
   <a href="###" class="active">自定义调用</a>
  </ul>
 </div>
 <table cellspacing="0" class="subtab tblist" id="diystb">
  <thead>
   <tr>
    <th width="15%">名称</th>
    <th width="12%">标识</th>
    <th>内容</th>
    <th width="12%" class="lst">操作</th>
   </tr>
  </thead>
  <tbody>
   {loop $diys $key $diy}
   <tr>
    <td>{$diy[name]}</td>
    <td>{$key}</td>
    <td>{htmltostr($diy['value'])}</td>
    <td><a href="###" class="diysbtns" rel="edit" key="{$key}">修改</a>&nbsp;&nbsp;<a href="###" class="diysbtns" rel="diysdel" key="{$key}">删除</a></td>
   </tr>
   {/loop}
   <tr class="btm">
    <td colspan="4" align="center"><input type="button" class="btn2 diysbtns" value="新增一个" rel="add" key="">&nbsp;&nbsp; <input type="button" class="btn2 diysbtns" value="镜像一份" rel="diyscopy" key=""></td>
   </tr>
  </tbody>
 </table>
 <script language="javascript">
$(function(){
   $('.diysbtns','#diystb').bind('click',function(ev){
        var m,key,type,tr,id,table,field,url,msg;
		id='{$id}';
		table='album';
		field='diys';
        ev.preventDefault();
		m=$(this);
		type=m.attr('rel');
		key=m.attr('key');
		url='index.php?tn=do&ac='+( (type=='diysdel'||type=='diyscopy') ? type : 'diys')+'&table='+table+'&field='+field+'&id='+id+'&key='+key+'&h='+now();
		if(type!='diysdel' || (type=='diysdel' && confirm('确定删除？')) ){
		     $.post(url,function(data){
			      if(data.substr(0,6)=='ERROR_'){
			         msg=data.substr(6,data.length-6);
				     adminmsg(msg)
			      }else{
			         if(type=='diysdel'){
					    m.parents('tr').remove();
						adminmsg("成功删除一个自定义调用字段");
				     }else if(type=='diyscopy'){
					    msgbox.box('镜像自定义调用',{width:500});
						msgbox.msg(data);
					 }else{
				        msgbox.box('自定义调用',{width:700});
					    msgbox.msg(data);
				     }
			      }
			 });
		}
   });
});
</script>

<?php else:?>
<script language="javascript">
function gsear(){
   document.topform.submit();
}
function bigtype(id){
   id=id||0;
   msgbox.box((id>0 ? '编辑' : '新增')+"大分类");
   $.post('index.php?tn=do&ac=bigtype&table=album&id='+id+'&h='+now(),function(data){
       msgbox.msg(data);
   })
}
function edit(id){
   location.href="index.php?tn={$tn}&ac=edit&id="+id;
}
function view(id){
   window.open("index.php?tn=do&ac=viewAlbum&id="+id);
}
function ranks(){
   $('#actype').val('ranks');
   document.tabform.submit();
}
function hides(id,type){
   var ids;
   id=id||0;
   type=type||'hides';
   $('#actype').val(type);
   if(id){
      $('#acid').val(id);
	  document.tabform.submit();
   }else{
      ids=getcheck();
	  if(ids==''){
	     alert('请至少选择一个');
	  }else{
	     $('#acid').val('');
		 document.tabform.submit();
	  }
   }
}
function shows(id){
   id=id||0;
   hides(id,'shows');
}
function updates(id){
   id=id||0;
   hides(id,'updates');
}
function makes(id){
   id=id||0;
   hides(id,'makes');
}
function repair(id){
   id=id||0;
   hides(id,'repair');
}
function dels(top,id){
   var ids='',msg;
   top=top||0;
   id=id||0;
   if(id==0){
      ids=getcheck();
   }
   if(id==0 && ids==''){
	  alert('请至少选择一个');
	  return ;
   }
   msg = top==1 ? '删除大分类并不会删除大分类下的 {$tit}\n\n原子级 {$tit} 将为转到默认分组下，仍旧删除？' : '确定不可恢复的删除所选 {$tit}？';
   if(confirm(msg)){
      $('#actype').val('dels');
	  if(id){
	     $('#acid').val(id);
		 document.tabform.submit();
	  }else{
	     $('#acid').val('');
		 document.tabform.submit();
	  }
   }
}
</script>
 <div class="dbg_warp">
  <div class="dbg_top">
   <div class="span_l">
    <div class="nav" style="float: left;">
     <a href=" " class="active">大分类</a>
     <?php foreach ($list as $val):?><a href=" " class="active"><?php echo $val['name'];?></a><?php endforeach;?> 
     <a href=" " class="active">默认</a> <a href=" " class="active">所有</a>
    </div>
   </div>
   <div class="span_r">
    <form method="get" id="topform" name="topform" action="index.php">
     <input type="hidden" name="tn" value="{$tn}"> <input type="hidden" name="ac" value="types"> <input type="hidden" name="tid" value="{$tid}"> <input type="text" name="q" class="titxt" value="{$q}">&nbsp;&nbsp; <input type="button" value=" 搜索 " class="dbgms_btn" onclick="gsear()"> <input type="button" class="dbgms_btn" value="新增大分类" onclick="bigtype()"> <input type="button" class="dbgms_btn" value="新增专辑"
      onclick="jumpurl('index.php?tn={$tn}&ac=add&tid={$tid}')">
    </form>
   </div>
  </div>
  <form method="get" id="tabform" name="tabform" action="index.php">
   <input type="hidden" name="tn" value="{$tn}" /> <input type="hidden" name="oldac" value="{$ac}" /> <input type="hidden" name="oldtid" value="{$tid}" /> <input type="hidden" name="id" id="acid" value="0" /> <input type="hidden" name="ac" id="actype" value="" />
   
   <?php if($use=='types'):?>
 <table cellspacing="0" class="tblist">
    <thead>
     <tr>
      <th width="5%" class="fst">选</th>
      <th width="6%">排序</th>
      <th width="6%">ID</th>
      <th width="12%">类别</th>
      <th width="12%">标识</th>
      <th>名称</th>
      <th width="32%" class="lst">操作</th>
     </tr>
    </thead>
    <tbody>
  <?php foreach ($list as $val):?>
   <tr>
      <td><input type="hidden" name="cid[]" value="<?php echo $val['id'];?>"><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>"></td>
      <td><input type="text" name="ranks[]" class="intxt" value="<?php echo $val['rank'];?>"></td>
      <td><?php echo $val['id'];?></td>
      <td><?php echo $val['typename'];?></td>
      <td><?php echo $val['sign'];?></td>
      <td><?php echo $val['name'];?> {if $list['cattype']>0} (<?php echo $val['num'];?>) {/if} {if $list['hidden']==1} <font color=red>[隐]</font> {/if}</td>
      <td><a href="<?php echo $con_url.'&use=edit&id='.$val['id'];?>">更改</a>&nbsp;&nbsp; <a href="###" onclick="updates(<?php echo $val['id'];?>)">更新缓存</a>&nbsp;&nbsp; <a href="###" onclick="repair(<?php echo $val['id'];?>)">修复统计</a>&nbsp;&nbsp; <a href="###" onclick="makes(<?php echo $val['id'];?>)">生成</a>&nbsp;&nbsp; <a href="###" onclick="dels(0,<?php echo $val['id'];?>)">删除</a>&nbsp;&nbsp; <a href="###"
       onclick="view(<?php echo $val['id'];?>)">访问</a></td>
     </tr>
  <?php endforeach;?>
   <tr class="btm">
      <td><input type="checkbox" onclick="checkall()"></td>
      <td colspan="7" style="padding-left: 0"><input type="button" onclick="ranks()" value="排序" class="btn3">&nbsp;&nbsp; <input type="button" onclick="hides();" value="隐藏" class="dbgms_btn">&nbsp;&nbsp; <input type="button" onclick="shows();" value="显示" class="dbgms_btn">&nbsp;&nbsp; <input type="button" onclick="makes();" value="生成" class="dbgms_btn">&nbsp;&nbsp; <input type="button" onclick="updates();" value="更新缓存" class="dbgms_btn">&nbsp;&nbsp;
       <input type="button" onclick="repair();" value="修复统计" class="dbgms_btn">&nbsp;&nbsp; <input type="button" onclick="dels(0)" value="删除" class="dbgms_btn">&nbsp;&nbsp; <input type="button" onclick="makes('all');" value="生成所有{$tit}" class="dbgms_btn"></td>
     </tr>
    </tbody>
  <?php else:?>
  <table cellspacing="0" class="tblist">
     <thead>
      <tr>
       <th width="6%" class="fst">选</th>
       <th width="7%">排序</th>
       <th width="6%">ID</th>
       <th>名称</th>
       <th width="22%" class="lst">操作</th>
      </tr>
     </thead>
     <tbody>
<?php foreach ($list as $val):?>
    <tr>
       <td><input type="hidden" name="cid[]" value="<?php echo $val['id'];?>"><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>"></td>
       <td><input type="text" name="ranks[]" class="intxt" value="<?php echo $val['rank'];?>"></td>
       <td><?php echo $val['id'];?></td>
       <td><a href="index.php?tn={$tn}&ac=types&tid=<?php echo $val['id'];?>"><?php echo $val['name'];?></a> {if $list['hidden']==1} [隐] {/if}</td>
       <td><a href="<?php echo $con_url.'&use=edit&id='.$val['id'];?>" onclick="bigtype(<?php echo $val['id'];?>)">更改</a>&nbsp;&nbsp; <a href="###" onclick="dels(1,<?php echo $val['id'];?>)">删除</a>&nbsp;&nbsp;</td>
      </tr>
<?php endforeach;?>
    <tr class="btm">
       <td><input type="checkbox" onclick="checkall()"></td>
       <td colspan="4" style="padding-left: 0"><input type="button" onclick="ranks()" value="排序" class="dbgms_btn">&nbsp;&nbsp; <input type="button" onclick="dels(1)" value="删除" class="dbgms_btn"></td>
      </tr>
     </tbody>
<?php endif;?>
   <tfoot>
      <tr>
       <td colspan="7">
        <div class="pages"><?php echo $pagebreak;?></div>
       </td>
      </tr>
     </tfoot>
    </table>
    </form>
<?php endif;?>
