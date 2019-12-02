<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft">所属栏目：</td>
 <td><select name="columnid" id="DbgMsColumnSelect">
   <option value="0">&nbsp;&nbsp;-&nbsp;&nbsp;请选择</option>
<?php foreach( $column_arr as $val):?>
<option data-expand="<?php echo $val['param']['expand']?>" value="<?php echo $val['id'];?>" <?php echo $val['property']==2||$val['property']==0?'disabled':NULL;?>>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo $val['name'];?></option>
	<?php if (!empty($val['list'])){foreach( $val['list'] as $val2):?>
	<option data-expand="<?php echo $val2['param']['expand']?>" value="<?php echo $val2['id'];?>" <?php echo $val2['property']==2||$val2['property']==0?'disabled':NULL;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |-▶ &nbsp;&nbsp;<?php echo $val2['name'];?></option>
	    <?php if (!empty($val2['list'])){foreach( $val2['list'] as $val3):?>
	    <option data-expand="<?php echo $val3['param']['expand']?>" value="<?php echo $val3['id'];?>" <?php echo $val3['property']==2||$val3['property']==0?'disabled':NULL;?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; |-▶ &nbsp;&nbsp;<?php echo $val3['name'];?></option>
    <?php endforeach;}?>
  <?php endforeach;}?>
<?php endforeach;?>
</select> <script type="text/javascript">$(function(){$("select[name='columnid']").attr("value","<?php echo empty($field['value'])?0:$field['value'];?>");});</script></td>
</tr>
<style type="text/css">
.fieldlab {
	border: 1px solid #7DC8FF;
	background: #F4FAFF;
	padding: 0 10px 8px 10px;
	width: 540px;
}

.fieldlab p {
	padding-top: 8px;
	width: 100%;
	display: inline-block;
	float: left;
	line-height: 30px;
}
</style>
<tr style="display: none;" id="DbgMsExpandSxTr">
 <td class="ft">多维筛选：</td>
 <td>
  <div class="labelwrp fieldlab" id="DbgMsExpandSx"></div>
 </td>
</tr>
<tr style="display: none;" id="DbgMsExpandLmTr">
 <td class="ft">多维栏目：</td>
 <td><select name="param[esign]" id="DbgMsExpandLm1">
 </select> <select style="display: none;" name="param[evalue]" id="DbgMsExpandLm2">
 </select></td>
</tr>
<script type="text/javascript">
$(document).ready(function(){
     var DbgMsColumnUrl ='<?php echo site_url();?>/index/cms?con=column&act=glexpand';
	 $("#DbgMsColumnSelect").on("change",function(){
        var expandid = $(this).find("option:selected").attr('data-expand');
        var columnid = $(this).val();
        var resultlist  = '';
        var result_array = <?php echo empty($field['param'])?'':$field['param'];?>;
	    if(expandid>0){
	       $('#DbgMsExpandLmTr').show();
	       $.ajax({
              url:DbgMsColumnUrl+'&columnid='+columnid+'&expandid='+expandid,
              type:'get',
              dataType:'json',
              success:function(result){
            	  resultlist = result;
                  $('#DbgMsExpandLmTr').show();
                  var htmls='';
                  htmls += '<option value="0">&nbsp;&nbsp;-&nbsp;&nbsp;请选择</option>';

                  $('#DbgMsExpandSxTr').show();
                  var htmls_xuanze = '';
                 
                  $.each(result,function(i,row){
                      
                      if(row.list!=undefined){
                    	  htmls += '<option data-list="1" value="'+row.sign+'">&nbsp;&nbsp;-&nbsp;&nbsp;'+row.title+'</option>';
                          //多维筛选
                          htmls_xuanze += '<p>【'+row.title+'】</p><div>';
                          $.each(row.list,function(i,row2){
                              if(row.type==0){
                            	  //单选
                                  if(result_array[row.sign]==row2.sign && result_array[row.sign]!=undefined){
           	                          htmls_xuanze += '<label><input type="radio" name="param['+row.sign+']" value="'+row2.sign+'" checked>'+row2.title+'</label>';
                                  }else{
           	                          htmls_xuanze += '<label><input type="radio" name="param['+row.sign+']" value="'+row2.sign+'">'+row2.title+'</label>';
                                  }
                              }else if(row.type==1){
                                  //多选
                                  var row_arrobj = result_array[row.sign];
                            	  if(result_array[row.sign]!=undefined){
                            		  var row_arrobj_is = false;
                            		  for(var i=0;i<row_arrobj.length;i++){
                            			  if(row_arrobj[i]==row2.sign && row_arrobj[i]!=undefined){
                            				  row_arrobj_is= true;
                                          }  
                            		  }
                            		  if(row_arrobj_is==true){
               	                          htmls_xuanze += '<label><input type="checkbox"  name="param['+row.sign+'][]" value="'+row2.sign+'" checked>'+row2.title+'</label>';
                                      }else{
               	                          htmls_xuanze += '<label><input type="checkbox"  name="param['+row.sign+'][]" value="'+row2.sign+'">'+row2.title+'</label>';
                                      }  
                                  }else{
           	                          htmls_xuanze += '<label><input type="checkbox"  name="param['+row.sign+'][]" value="'+row2.sign+'">'+row2.title+'</label>';
                                  }
                              }
            	          });
                          htmls_xuanze +=  '</div>';
                      }else{
                    	  htmls += '<option data-list="0" value="'+row.sign+'">&nbsp;&nbsp;-&nbsp;&nbsp;'+row.title+'</option>';
                      }
                  });
                  htmls_xuanze += '  </div>';
                  
                  $('#DbgMsExpandSx').html(htmls_xuanze);	 
                  
                  $('#DbgMsExpandLm1').html(htmls);	 
                  $("#DbgMsExpandLm1").on("change",function(){
          	        var expandid = $(this).find("option:selected").attr('data-list');
          	        var expand2select = $(this).val();
          		    if(expandid>0){
          		    	$('#DbgMsExpandLm2').show();
    	                  $.each(resultlist,function(i,row){
                              if(row.sign==expand2select){
                            	  var htmls='';
            	                  htmls += '<option value="0">&nbsp;&nbsp;-&nbsp;&nbsp;请选择</option>';
                            	  $.each(row.list,function(i,row2){
                            		 htmls += '<option value="'+row2.sign+'">&nbsp;&nbsp;-&nbsp;&nbsp;';
   	                                 htmls += row2.title+'</option>';
            	                  });
                            	  $('#DbgMsExpandLm2').html(htmls);	 
                              }
    	                  });
          		    }else{
          		    	$('#DbgMsExpandLm2').hide();
          		    }
          		 }); 
              }
           });
	    }else{
	    	$('#DbgMsExpandLmTr').hide();
	    }
	 });
	 $("#DbgMsColumnSelect").attr("selected",true).trigger('change');
});
 </script>