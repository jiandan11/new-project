<style>
    .addstep1_div{margin-top: 10px;width:100%;}
    .addstep1_div ul {font-size: 15px;margin: 10px;}
    .addstep1_div ul li{margin-right: 3px;text-align: center;font-size: 20px;overflow: hidden;min-height: 50px;}
    .addstep1_div ul li .lidivleft{float:left;width:10%;text-align: right;}
    .addstep1_div ul li .lidivright{float:right;width:90%;text-align: left;}
    .addstep1_div .title{font-size: 25px;color:green;}
    .addstep1_div ul li .inputtext{height: 30px;margin: 5px;width: 300px;}
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
    .addstep1_div form ul li textarea{width:300px;height:80px;margin: 5px;}
</style>

<div class="addstep1_div">
    <form method="post" id="DbgMsFormEdit" enctype="multipart/form-data">
        <input type="hidden" name="rfid" value="<?php echo $forminfo['rfid'];?>">
        <ul>
            <li><div class="lidivleft"><label>富表单名称：</label></div><div class="lidivright"><input type="text" name="rfname" value="<?php echo $forminfo['rfname'];?>" maxlength="60" placeholder="必填：富表单名称" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>关联数据库表：</label></div><div class="lidivright"><input type="text" name="tablename" value="<?php echo $forminfo['tablename'];?>" maxlength="60" placeholder="必填：关联数据库表名" class="inputtext" readonly="readonly"/></div></li>
            <li><div class="lidivleft"><label>富表单action：</label></div><div class="lidivright"><input type="text" name="action" value="<?php echo $forminfo['action'];?>" maxlength="127" placeholder="可先不填：富表单action" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>提交后跳转地址：</label></div><div class="lidivright"><input type="text" name="jumpurl" value="<?php echo $forminfo['jumpurl'];?>" maxlength="127" placeholder="非必填：表单提交成功后跳转地址 不填不跳转" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>提交成功提示语：</label></div><div class="lidivright"><input type="text" name="okmsg" value="<?php echo $forminfo['okmsg'];?>" maxlength="60" placeholder="非必填：提交成功后的提示语 不填不提示" class="inputtext"/></div></li>
            <li>
                <div class="lidivleft"><label>富表单method：</label></div>
                <div class="lidivright">
                    <label>post</label><input type="radio" name="method" value="1" <?php if($forminfo['method'] == 'post'):?>checked="checked"<?php endif;?> style="margin-right: 20px;"/>
                    <label>get</label><input type="radio" name="method" value="2" <?php if($forminfo['method'] == 'get'):?>checked="checked"<?php endif;?>/>
                </div>
            </li>
            <li>
                <div class="lidivleft"><label>富表单描述：</label></div>
                <div class="lidivright"><textarea name="description" placeholder="非必填：富表单描述或备注"><?php echo $forminfo['description'];?></textarea></div>
            </li>
            <li>
                <div class="lidivleft"><label>关联产品：</label></div>
                <div class="lidivright">
                    <select name="bindproduct">
                        <option value="">非必选</option>
                        <?php foreach ($productlist as $key => $value):?>
                        <option value="<?php echo $value['id']?>|<?php echo $value['title']?>|<?php echo $value['table']?>" 
                                <?php if($forminfo['bindproduct'] == $value['id'].'|'.$value['title'].'|'.$value['table']):?>selected="selected"<?php endif;?>
                        >
                            <?php echo $value['title']?>
                        </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </li>
        </ul>
        <div>
            <input type="button" value="确定" onclick="cmsContentUpdate()" class="divsubmit">
        </div>
    </form>
</div>
<script type="text/javascript">
    function cmsContentUpdate(){ 	  
          $.ajax({ 
            url:"<?php echo $edit_url;?>",
            type:"POST",
            data:$('#DbgMsFormEdit').serialize(),
            success:function(result){
              if(result==1){
                alert("成功!");
                location.href='<?php echo $con_url.'&page='.$page;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
    }
</script>

