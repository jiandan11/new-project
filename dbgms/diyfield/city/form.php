<?php include_once 'cssjs.php';?>
<tr <?php echo $field['disable']==1?'style="display:none;"':'';?>>
 <td class="ft"><?php echo $field['name'];?>：</td>
 <td>
  <div class="hpft">
   &nbsp;&nbsp;省： <select id="s_province" name="<?php echo $field['field'];?>[]" style="width: 140px;">
    <option value="省份">省份</option>
    <option value="北京市">北京市</option>
    <option value="天津市">天津市</option>
    <option value="上海市">上海市</option>
    <option value="重庆市">重庆市</option>
    <option value="河北省">河北省</option>
    <option value="山西省">山西省</option>
    <option value="内蒙古">内蒙古</option>
    <option value="辽宁省">辽宁省</option>
    <option value="吉林省">吉林省</option>
    <option value="黑龙江省">黑龙江省</option>
    <option value="江苏省">江苏省</option>
    <option value="浙江省">浙江省</option>
    <option value="安徽省">安徽省</option>
    <option value="福建省">福建省</option>
    <option value="江西省">江西省</option>
    <option value="山东省">山东省</option>
    <option value="河南省">河南省</option>
    <option value="湖北省">湖北省</option>
    <option value="湖南省">湖南省</option>
    <option value="广东省">广东省</option>
    <option value="广西">广西</option>
    <option value="海南省">海南省</option>
    <option value="四川省">四川省</option>
    <option value="贵州省">贵州省</option>
    <option value="云南省">云南省</option>
    <option value="西藏">西藏</option>
    <option value="陕西省">陕西省</option>
    <option value="甘肃省">甘肃省</option>
    <option value="青海省">青海省</option>
    <option value="宁夏">宁夏</option>
    <option value="新疆">新疆</option>
    <option value="香港">香港</option>
    <option value="澳门">澳门</option>
    <option value="台湾省">台湾省</option>
   </select>&nbsp;&nbsp;市：<select id="s_city" name="<?php echo $field['field'];?>[]" style="width: 140px;">
    <option value="地级市">地级市</option>
   </select>&nbsp;&nbsp;区：<select id="s_county" name="<?php echo $field['field'];?>[]" onchange="showArea()" style="width: 140px;">
    <option value="市、县级市">市、县级市</option>
   </select>&nbsp;&nbsp;
  </div>
  <div class="hpft" id="show2"></div>
 </td>
</tr>
<tr>
 <td class="ft">&nbsp;&nbsp;</td>
 <td>
  <div class="hpft">
   <font style="color: #999">详细地址：</font> <input id="show" style="color: #999" type="text" class="itxt" value="" readonly="readonly">
  </div>
 </td>
</tr>
<script type="text/javascript">
 $(document).ready(function(){
	 $("#s_province").attr("value","<?php echo $field['value'][0];?>"); 
	 $("#s_province").change();
	 $("#s_city").attr("value","<?php echo $field['value'][1];?>");  
	 $("#s_city").change();
	 $("#s_county").attr("value","<?php echo $field['value'][2];?>"); 
	 $("#s_county").change();
 });
 _init_area();
 var showArea = function() {
     document.getElementById('show').value = "省" + document.getElementById('s_province').value + " - 市" + document.getElementById('s_city').value + " - 县/区" + document.getElementById('s_county').value;
 }
 document.getElementById('s_county').setAttribute('onchange', 'showArea()');
 </script>
