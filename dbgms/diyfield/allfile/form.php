<tr auto="1" field="{$type}" name="{$field[name]}" min="{$field[min]}" max="{$field[max]}" check="{$field[check]}">
 <td class="ft">{$field[name]}：</td>
 <td>
  <style type="text/css">
.allfile_img {
	width: 250px;
	height: 180px;
	display: none;
	position: absolute;
	z-index: 5555;
	background-color: #fff;
}

.allfile_txt {
	width: 350px;
	height: 18px;
	padding: 3px 0 1px 3px;
	border: 1px solid #ccc;
	border-color: #aaa #ccc #ccc #aaa;
	background: #fff;
	color: #222;
	float: left;
}

.allfile_upimg {
	float: left;
}

.allfile_upimg .btns {
	float: left;
	width: 50px;
	height: 23px;
	position: relative;
	margin-left: 6px;
	overflow: hidden;
}

.allfile_upimg .btns input {
	position: absolute;
	font-size: 53px;
	left: -90px;
	top: -30px;
	filter: alpha(opacity = 0);
	opacity: 0;
}

.allfile_upimg .btns button {
	border-style: solid;
	border-width: 1px;
	cursor: pointer;
	overflow: hidden;
	width: 50px;
	text-align: center;
	height: 23px;
	background: #C8CFDA;
	border: 1px solid #5E718C;
}

.allfile_upimg .frr {
	float: left;
	margin-left: 6px;
	margin-top: 4px;
}
</style> <img id="{$key}1" src="#" class="allfile_img" style="display: none;">
  <div class="allfile_upimg">
   <input type="hidden" name="{$key}_old" value="{$value}" /> <input type="text" name="{$key}" id="{$key}" class="allfile_txt" value="{$value}" />
   <div class="btns" title="支持类型：{$atts[types]}">
    <input type="file" id="{$key}_file" name="{$key}_file" onchange="uploadimg('{$key}','{$upload_options[uptype]}','{$upload_options[filetype]}')" size="1" types="{$atts[types]}" maxsize="{$atts[maxsize]}" updir="{$atts[dir]}" water="{$atts[water]}" waterfile="{$atts[waterfile]}" fwidth="{$atts[width]}" fheight="{$atts[height]}" tosmall="{$atts[tosmall]}" bcolor="{$atts[bcolor]}">
    <button>上 传</button>
   </div>
   <div class="frr">
    <label><input type="checkbox" name="{$key}_crt" value="1" {if $value==''} checked{/if}> 采集</label> {if $isimg}<a href="###" class="upimg-cut" id="{$key}_crt">【裁剪】</a>{/if}
   </div>
  </div> <script type="text/javascript" src="/js/jquery-form.js"></script> <script type="text/javascript">
/*绑定事件 allfile_txt*/
$(document).ready(function(){
  var imgid = '{$key}1';
  var is_showimg = $('#{$key}');/*获取对象,不用每次*/
  is_showimg.mouseover(function(){
    url = is_showimg.val();
    if(url!=''){ srcval="{$upload_options[url]}"+url;
   		var imgshowdiv = $('#'+imgid);
   		dw=500;
		dh=500;
   		imgReady(srcval,function(){
			var img=this,dradot,nradot;
			w=srcw=img.width;
			h=srch=img.height;
			if(srcw>dw||srch>dh){
				dradot=dw/dh;
				nradot=srcw/srch;
				if(nradot>dradot){
					w=dw;
					h=w/nradot;
				}else{
					h=dh;
					w=h*nradot;
				}
			}
			imgshowdiv.css({width:w,height:h});
			imgshowdiv.attr('src',srcval);
			pos=is_showimg.offset();
			imgshowdiv.css({left:pos.left,top:(pos.top+is_showimg.outerHeight()+2)});
			imgshowdiv.show();
		});
    	imgshowdiv.show();
	}else{$('#'+imgid).hide();}  
  });
  is_showimg.mouseout(function(){$('#'+imgid).hide();}); 
    isimg=function(src){
		var ext = src=='' ? '' : getext(src);
		return (ext=='jpg'||ext=='jpeg'||ext=='png'||ext=='gif'||ext=='bmp') ? 1 : 0;
    };
 	$('#{$key}_crt').unbind('click').click(function(ev){
		ev.preventDefault();
		var hash,src=is_showimg.val();
		if(isimg(src)){
			hash=is_showimg.attr('hash')||'fst';
			src+='?'+hash;
			upload_file =  $('#{$key}_file');
			$.ByImgCut(src,{
				width: upload_file.attr("fwidth")||0,
				height: upload_file.attr("fheight")||0,
				tosmall: upload_file.attr("tosmall")||0,
				bcolor: upload_file.attr("bcolor")||'#FFFFFF',
				allfileurl:"{$upload_options[url]}",/*自定义传参进去 */
				alluseurl:"index.php?tn=tool_allfile&ac=imgcut&src=",/*自定义传参进去 */
				callback:function(vrsrc){
					is_showimg.val(vrsrc).attr('hash',now());
				}
			});
		}
	});
});	
function uploadimg(inputid,allfile_uptype,allfile_filetype){
	var frm;
	frm=$('#subfrm');
	$('<input type="hidden" name="tn" value="tool_allfile"/>').appendTo(frm);
	$('<input type="hidden" name="ac" value="upload" />').appendTo(frm);
	$('<input type="hidden" name="allfile_uptype" value="'+allfile_uptype+'" />').appendTo(frm);
	$('<input type="hidden" name="allfile_filetype" value="'+allfile_filetype+'" />').appendTo(frm);
	$(document).ready(function(){
		  var options = {
		  url:"/index.php?tn=tool_allfile&ac=upload&name="+inputid+"&modelsign={$upload_options[modelsign]}", 
		  type:"POST",
		  dataType:"json",
		  success :function(data){
			   if(data.type=="no"){alert(data.info);}else {$("#"+inputid).val(data.info);}
		  },
		}; 
	    $('#subfrm').ajaxSubmit(options);
	    /*重要:总是返回false,以防止标准的浏览器提交和页面导航 ,为了防止刷新   */
	    return false;
	});
}
/*imgReady=(function(){var d=[],c=null,b=function(){var e=0;for(;e<d.length;e++){d[e].end?d.splice(e--,1):d[e]()}!d.length&&a()},a=function(){clearInterval(c);c=null};return function(f,k,m,j){var l,g,n,i,e,h=new Image();h.src=f;if(h.complete){k.call(h);m&&m.call(h);return}g=h.width;n=h.height;h.onerror=function(){j&&j.call(h);l.end=true;h=h.onload=h.onerror=null};l=function(){i=h.width;e=h.height;if(i!==g||e!==n||i*e>1024){k.call(h);l.end=true}};l();h.onload=function(){!l.end&&l();m&&m.call(h);h=h.onload=h.onerror=null};if(!l.end){d.push(l);if(c===null){c=setInterval(b,40)}}}})();*/

</script>
 </td>
</tr>