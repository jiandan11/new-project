<?php if($act=='edit'):?>
<div class="dbgms_tabs_wrap">
 <h2>
  <a href="<?php echo $con_url;?>">友情链接</a> <font style="color: #666;">&nbsp;&gt;&gt;&nbsp;</font> 编辑
 </h2>
</div>
<div class="dbg_warp">
 <form method="post" id="DbgMsFormEdit" name="DbgMsFormEdit">
  <input type="hidden" readonly="readonly" value="<?php echo $row['id'];?>" name="id"> <input type="hidden" readonly="readonly" value="update" name="act">
  <table class="subtab">
   <tbody>
    <tr>
     <td class="ft">链接名称：</td>
     <td>
      <div class="hpft">
       <input type="text" class="itxt" name="title" value="<?php echo $row['title'];?>"> <a href="###" id="signBtn">检测唯一性</a>
      </div>
     </td>
    </tr>
    <tr>
        <td class="ft">服务器名：</td>
        <td>
            <div class="hpft">
                <input type="text" class="itxt" name="fw" value="<?php echo $row['fw'];?>">
            </div>
        </td>
    </tr>
    <tr>
        <td class="ft">服务器IP：</td>
        <td>
            <div class="hpft">
                <input type="text" class="itxt" name="fw_ip" value="<?php echo $row['fw_ip'];?>">
            </div>
        </td>
    </tr>
    <tr>
        <td class="ft">开区时间 月/日/时：</td>
        <td>
            <div class="hpft">
                <input type="text" class="itxt" name="time" value="<?php echo $row['time'];?>">
            </div>
        </td>
    </tr>
    <tr>
        <td class="ft">线路类型：</td>
        <td>
            <div class="hpft">
                <input type="text" class="itxt" name="xianlu" value="<?php echo $row['xianlu'];?>">
            </div>
        </td>
    </tr>
    <tr>
        <td class="ft">版本介绍：</td>
        <td>
            <div class="hpft">
                <input type="text" class="itxt" name="info" value="<?php echo $row['info'];?>">
            </div>
        </td>
    </tr>
    <tr>
        <td class="ft">客服QQ：</td>
        <td>
            <div class="hpft">
                <input type="text" class="itxt" name="qq" value="<?php echo $row['qq'];?>">
            </div>
        </td>
    </tr>
    <tr>
        <td class="ft">排序：</td>
        <td>
            <div class="hpft">
                <input type="text" class="itxt" name="sort" value="<?php echo $row['sort'];?>" placeholder="用于前端列表排序显示,数字大靠前">
            </div>
        </td>
    </tr>
    <tr>
     <td class="ft">修改时间：</td>
     <td><input type="text" class="itxt" name="uptime" value="<?php if(empty($row['uptime'])){echo date("Y-m-d H:i:s",time());}else{echo date("Y-m-d H:i:s", $row['uptime']);}?>"></td>
    </tr>
    <tr>
     <td class="ft">链接组别：</td>
     <td><input type="text" class="itxt" name="type" value="<?php echo $row['type'];?>" placeholder="添加链接时，可以添加多个分组用英文逗号(,)间隔，编辑时无法改变多个组别，输入多个只取最后一个"></td>
    </tr>
    <?php $baselogo['form']='DbgMsFormEdit';$baselogo['name'] = '友链图标';$baselogo['field'] = 'icon';$baselogo['path']=$model['sign'];dbg_diyfield ( 'load', 'file', $baselogo,$row['icon'] );?>
    <tr>
     <td class="ft">链接：</td>
     <td><input type="text" class="itxt" name="link" value="<?php echo $row['link'];?>"></td>
    </tr>
    <tr>
        <td class="ft">状态：</td>
        <td>
            <select name="status" style="width: 150px">
                <option <?php if($row['status']==0){echo 'selected=""';}?> value="0">关闭</option>
                <option <?php if($row['status']==1){echo 'selected=""';}?> value="1">开启</option>
            </select>
        </td>
    </tr>
    <tr style="height: 100px;">
     <td></td>
     <td><a class="dbgms_btn_submit" onclick="dbgmsUpdate('DbgMsFormEdit','<?php echo $con_url;?>')" href="javascript:;">确认提交</a> <a class="dbgms_btn" href="<?php echo $con_url;?>">返回列表</a></td>
    </tr>
   </tbody>
  </table>
 </form>
</div>
<?php else:?>
<div class="dbg_warp">
 <div class="dbg_top">
  <span class="span_l"><a class="dbgms_btn" href="<?php echo $con_url;?>&act=edit">新增友链</a></span><span class="span_r"><input type="button" value="更新所有缓存" class="dbgms_btn" onclick="upcache()"> </span>

     <form action="cms?con=flink&act=index" method="post" id="formhtmlsubmit" onsubmit="return formhtmlsubmit()" enctype="multipart/form-data">

         <input type='text'  name='keywords' value="<?php echo $keywords?>" placeholder='请输入链接名称或链接地址' style="width:300px;height:30px;float: left"/>

         <input type='submit' name='提交' value='提交' style="width:80px;height: 34px;margin-left: 5px"/>
     </form>
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th>选</th>
    <th>ID</th>
    <th>链接组别</th>
    <th>名称</th>
    <th>图标</th>
    <th width="20%">链接</th>
    <th>更新时间</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key=>$val):?>
   <tr id="tr<?php echo $val['id'];?>">
    <td><input type="checkbox" value="<?php echo $val['id'];?>" name="ids[]"></td>
    <td><?php echo $val['id'];?></td>
    <td><?php echo $val['type'];?></td>
    <td><?php echo $val['title'];?></td>
    <td><img src="<?php echo $val['icon'];?>" style="width: 110px; height: 70px; border: solid 1px silver;" /></td>
    <td><?php echo $val['link'];?></td>
    <td><?php echo get_time_deviation($val['uptime']);?></td>
    <td><a href="<?php echo $con_url.'&act=edit&id='.$val['id'];?>">编辑</a><a href="<?php echo $val['link'];?>" target="_blank">访问</a> <a onclick="dbgmsDelete('<?php echo $delete_url.$val['id'];?>')">删除</a></td>
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