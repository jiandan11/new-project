<style>
    .addstep1_div{margin-top: 10px;width:100%;}
    .addstep1_div ul {font-size: 15px;margin: 10px;}
    .addstep1_div ul li{margin-right: 3px;text-align: center;font-size: 20px;overflow: hidden;min-height: 50px;}
    .addstep1_div ul li .lidivleft{float:left;width:20%;text-align: right;}
    .addstep1_div ul li .lidivright{float:right;width:80%;text-align: left;}
    .addstep1_div .title{font-size: 25px;color:green;}
    .addstep1_div ul li .inputtext{height: 30px;margin: 5px;width: 350px;}
    .addstep1_div .divsubmit{
        background-color: #7CB024;
        border: 1px solid #9ED18E;
        color: white;
        border-radius: 0.5em;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        display: inline-block;
        font: 14px/100% Arial,Helvetica,sans-serif;
        margin: 0 2px;
        outline: medium none;
        padding: 0.5em 2em 0.55em;
        text-align: center;
        text-decoration: none;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        vertical-align: baseline;
        margin-left:286px;}
    .addstep1_div form ul li label{color:green;}
    .addstep1_div form ul li textarea{width:350px;height:200px;margin: 5px;}
    .rfnametitle{
        font-size: 20px;
        margin-left: 10px;
    }
</style>
<div class="rfnametitle"><a class="dbgms_btn" href="<?php echo $manageelement_url;?>&rfid=<?php echo $rfid;?>&rfname=<?= $rfname;?>">返回列表</a>正在设置：<?php echo $rfname;?> ==> <?php echo $elementinfo['rname']?></div>
<div class="addstep1_div">
    <form method="post" id="DbgMsFormEdit" enctype="multipart/form-data">
        <input type="hidden" name="rfid" value="<?php echo $elementinfo['rfid'];?>">
        <input type="hidden" name="rid" value="<?php echo $rid;?>">
        <ul>
            <li><div class="lidivleft"><label>标签属性name：</label></div><div class="lidivright"><input type="text" name="attrname" value="<?php echo $elementinfo['attrname'];?>" maxlength="60" placeholder="表单元素标签的name属性" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>CRUD数据标识：</label></div><div class="lidivright"><input type="text" name="nametag" value="<?php echo $elementinfo['nametag'];?>" maxlength="60" placeholder="在数据管理时方便查看" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>数据库存储长度：</label></div><div class="lidivright"><input type="text" name="namelength" value="<?php echo $elementinfo['namelength'];?>" maxlength="127" placeholder="填写合适的数字有利于数据存储" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>数据库表结构字段备注：</label></div><div class="lidivright"><input type="text" name="namecomment" value="<?php echo $elementinfo['namecomment'];?>" maxlength="60" placeholder="数据存储表结构对应字段的备注信息" class="inputtext"/></div></li>
            <li>
                <div class="lidivleft"><label>数据库存储数据类型：</label></div>
                <div class="lidivright">
                    <label>varchar</label><input type="radio" name="namecharset" value="varchar" <?php if($elementinfo['namecharset'] == 'varchar'):?>checked="checked"<?php endif;?> style="margin-right: 20px;"/>
                    <label>int</label><input type="radio" name="namecharset" value="int" <?php if($elementinfo['namecharset'] == 'int'):?>checked="checked"<?php endif;?>/>
                </div>
            </li>
            <li><div class="lidivleft"><label>表单元素属性value设置：</label></div><div class="lidivright"><input type="text" name="attrvalue" value="<?php echo $elementinfo['attrvalue'];?>" maxlength="60" placeholder="表单元素标签的value属性" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>label标签间的文字设置：</label></div><div class="lidivright"><input type="text" name="labelcontent" value="<?php echo $elementinfo['labelcontent'];?>" maxlength="60" placeholder="例如输入框旁边显示的文字" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>表单元素属性maxlength设置：</label></div><div class="lidivright"><input type="text" name="attrmaxlength" value="<?php echo $elementinfo['attrmaxlength'];?>" maxlength="60" placeholder="表单元素标签的maxlength属性,用于限制用户输入长度" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>表单元素属性placeholder设置：</label></div><div class="lidivright"><input type="text" name="attrplaceholder" value="<?php echo $elementinfo['attrplaceholder'];?>" maxlength="60" placeholder="表单元素标签的placeholder属性,用于提示用户输入" class="inputtext"/></div></li>
            <li>
                <div class="lidivleft"><label>li标签的样式设置：</label></div>
                <div class="lidivright"><textarea name="listyle" placeholder="设置li标签的样式"><?php echo htmlspecialchars($elementinfo['listyle']);?></textarea></div>
            </li>
            <li>
                <div class="lidivleft"><label>label标签的样式设置：</label></div>
                <div class="lidivright"><textarea name="labelstyle" placeholder="设置label标签的样式"><?php echo htmlspecialchars($elementinfo['labelstyle']);?></textarea></div>
            </li>
            <li><div class="lidivleft"><label>表单元素属性id设置：</label></div><div class="lidivright"><input type="text" name="attrid" value="<?php echo $elementinfo['attrid'];?>" maxlength="60" placeholder="表单元素标签的id属性" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>表单元素属性class设置：</label></div><div class="lidivright"><input type="text" name="attrclass" value="<?php echo $elementinfo['attrclass'];?>" maxlength="60" placeholder="表单元素标签的class属性" class="inputtext"/></div></li>
        </ul>
        <div>
            <input type="button" value="确定" onclick="cmsContentUpdate()" class="divsubmit">
        </div>
    </form>
</div>
<script type="text/javascript">
    function cmsContentUpdate(){ 	  
          $.ajax({ 
            url:"<?php echo $elementlevelset_url;?>",
            type:"POST",
            data:$('#DbgMsFormEdit').serialize(),
            success:function(result){
              if(result==1){
                alert("成功!");
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
    }
</script>

