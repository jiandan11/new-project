<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $curr_url;?>&act=add">创建富表单元素</a></span>
  <div class="span_r">
   <form name="DbgMsFormSearch" id="DbgMsFormSearch" action="<?php echo $curr_url;?>" method="get">
    <input type="hidden" name="con" value="richformelement" />
    <input type="text" name="q" class="titxt" value="<?php echo $q;?>" placeholder="请输入富表单元素名或所属风格组" style="width: 250px"> &nbsp;
    <input type="submit" value="搜索 " class="dbgms_btn">
   </form>
  </div>
 </div>
<style>
	.pop-window {
		position:fixed;
		top:55%;
		left:60%;
		width:30%;
		height:50%;
		margin:-180px 0 0 -330px;
		border-radius:5px;
		display:none;
		box-shadow: 0 0 10px #666;
                background-color: white;
                z-index: 5;
	}
	.zzinvisible{
		background-color:rgba(0,0,0,0.6);
		width:100%;height:900px;
		display: none; 
		position: absolute;
		top: 0;
		left: 0;
                z-index: 4;
	}
	.zzvisible{
		background-color:rgba(0,0,0,0.6);
		width:100%;height:900px;
		display: block; 
		position: absolute;
		top: 0;
		left: 0;
                z-index: 4;
	}
        .pop-window-close-a{
                font-size: 24px;
                padding-right: 7px;
        }
        .pop-window-close{
                text-align: right;
        }
</style>
 <table class="tblist">
  <thead>
   <tr class="list">
    <th width="6%">富表单元素rid</th>
    <th>富表单元素名称</th>
    <th>基本表单元素名称</th>
    <th>基本表单元素类型</th>
    <th>所属风格组</th>
    <th width="30%">富表单元素描述</th>
    <th width="8%">改动时间</th>
    <th width="20%">操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key =>$val):?>
   <tr id="tr<?php echo $val['rid'];?>">
    <td><?php echo $val['rid'];?></td>
    <td><?php echo $val['rname'];?></td>
    <td><?php echo $val['bname'];?></td>
    <td><?php echo $val['attrtype'];?></td>
    <td><?php echo $val['gname'];?></td>
    <td><?php echo $val['description'];?></td>
    <td><?php echo get_time_deviation($val['operatetime']);?></td>
    <td>
        <a class="overview-a" href="javascript:;" onclick="overview(<?php echo $val['rid'];?>,'<?php echo htmlspecialchars($val['html']);?>');">【预览】</a>
        <a class="set-style-a" href="javascript:;" onclick="setstyle(<?php echo $val['rid'];?>,'<?php echo htmlspecialchars($val['attrstyle']);?>');">【设置样式】</a>
        <a href="<?php echo $curr_url.'&page='.$page.'&act=edit&rid='. $val['rid'];?>">【修改】</a>
        <a onclick="dbgmsDelete('<?php echo $delete_url.$val['rid'];?>')">【删除】</a>
    </td>
   </tr>
<?php endforeach;?>
      <tr class="btm">
   </tr>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
<div class="zzinvisible" id="zzdiv"></div>
<div class="pop-window" id="pop-set-style">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-style-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rid" value="111" id="hiddenid">
             <div style="text-align: center;margin-bottom: 15px;"><h3>设置富表单元素样式</h3></div>
             <div style="padding:10px;">
                 <textarea name="attrstyle" style="width:100%;height: 150px;" id="stylevaluetextarea" placeholder="可不填，输入类似 style='background-color:red;'"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetStyle()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<div class="pop-window" id="overview">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="overview-close">×</a></div>
     <div>
        <div style="text-align: center;margin-bottom: 15px;"><h3>预览</h3></div>
        <div style="padding:10px;text-align: center;">
            <ul>
                <li id="overview-display-html">
                </li>
            </ul>
        </div>
     </div>
</div>
 <script type="text/javascript">
 function cmsContentSearch(key, val) {
		key = key || '';
		val = val || '';
		if (key != '' && val != '') {
			$('#autokey').val(key);
			$('#autoval').val(val);
		} else {
			$('#autokey').add($('#autoval')).val('');
		}
		document.DbgMsFormSearch.submit();
	}
	function cmsContentOrder(field) {
		if ($('#orderby').val() == field) {
			$('#orderdesc').val($('#orderdesc').val().toUpperCase() == 'DESC' ? 'ASC' : 'DESC');
		} else {
			$('#orderby').val(field);
			$('#orderdesc').val('ASC');
		}
		cmsContentSearch();
	}   
        jQuery(document).ready(function($) {
                $('.set-style-a').click(function(){
                        $('#pop-set-style').slideDown(100);
                        $('#zzdiv').attr('class','zzvisible');
                })
                $('#set-style-close').click(function(){
                        $('#pop-set-style').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                })
                
                $('.overview-a').click(function(){
                        $('#overview').slideDown(100);
                        $('#zzdiv').attr('class','zzvisible');
                })
                $('#overview-close').click(function(){
                        $('#overview').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                })

        })
        function setstyle(id,style){
                $('#stylevaluetextarea').val(style);//所选中的富表单元素的style
                $('#hiddenid').val(id);//所选中的富表单元素的id
        }
        function overview(id,html){
                html = '<label>label位置</label>' + html;
                $('#overview-display-html').html(html);
        }
    function cmsContentSetStyle(){ 	  
      $.ajax({ 
        url:"<?php echo $setstyle_url;?>",
        type:"POST",
        data:$('#DbgMsFormEdit').serialize(),
        success:function(result){
          if(result==1){
            alert("成功!");
            location.href='<?php echo $curr_url.'&page='.$page;?>';
            return;
          }else{
            alert(result);
          }
        }
      });
    }
    </script>
</div>