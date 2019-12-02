
<div class="dbg_warp">
 <div class="dbg_top">
     <span class="span_l">已实现的基本表单元素：此部分的功能由开发人员维护</span>
<!--     <span class="span_l"><a href="<?php echo $con_url.'&act=richtext';?>">富文本</a></span>-->
 </div>
 <table class="tblist">
  <thead>
   <tr>
    <th>标签对应的序号</th>
    <th>基本表单元素名称</th>
    <th>具备的一些功能举例</th>
    <th>操作</th>
   </tr>
  </thead>
  <tbody>
<?php foreach ($lists as $key=>$val):?>
   <tr>
    <td><?php echo $key;?></td>   
    <td><?php echo $val['tagname'];?></td>
    <td><?php echo $val['description'];?></td>
    <td><a href="<?php echo $con_url.'&act=view&id='.$key;?>">查看效果</a></td>
   </tr>
<?php endforeach;?>
  </tbody>
  <tfoot>
   <tr>
    <td colspan="11"><?php echo $pagebreak;?></td>
   </tr>
  </tfoot>
 </table>
</div>