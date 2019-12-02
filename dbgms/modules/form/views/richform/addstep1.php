<style>
    .addstep1_div{
        margin-top: 10px;
        text-align: center;
        width:100%;
    }
    .addstep1_div ul {
        font-size: 15px;
        margin: 10px;
    }
    .addstep1_div ul li{
        margin-right: 3px;
        text-align: center;
        font-size: 20px;
        overflow: hidden;
        min-height: 50px;
    }
    .addstep1_div ul li .lidivleft{
        float:left;
        width:50%;
        text-align: right;
    }
    .addstep1_div ul li .lidivright{
        float:right;
        width:50%;
        text-align: left;
    }
    .addstep1_div .title{
        font-size: 25px;
        color:green;
    }
    .addstep1_div ul li .inputtext{
        height: 30px;
        margin: 5px;
        width: 300px;
    }
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
    }
    .addstep1_div form ul li label{
        color:green;
    }
    .addstep1_div form ul li textarea{
        width:300px;
        height:80px;
        margin: 5px;
    }
    .addstep1_div form ul li select{
        width:300px;
        height:30px;
        margin: 5px;
    }
</style>

<div class="addstep1_div">
    <label class="title">创建富表单》步骤一》填写富表单基本信息</label>
    <form method="post" id="DbgMsFormEdit" enctype="multipart/form-data">
        <ul>
            <li><div class="lidivleft"><label>富表单名称：</label></div><div class="lidivright"><input type="text" name="rfname" maxlength="60" placeholder="必填：富表单名称" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>关联数据库表：</label></div><div class="lidivright"><input type="text" name="tablename" maxlength="60" placeholder="必填：关联数据库表名" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>富表单action：</label></div><div class="lidivright"><input type="text" name="action" maxlength="127" placeholder="可先不填：富表单action" class="inputtext" value="/Form/purseformpushdata"/></div></li>
            <li><div class="lidivleft"><label>提交后跳转地址：</label></div><div class="lidivright"><input type="text" name="jumpurl" maxlength="127" placeholder="非必填：表单提交成功后跳转地址,默认跳到首页" class="inputtext" value="/"/></div></li>
            <li><div class="lidivleft"><label>提交成功提示语：</label></div><div class="lidivright"><input type="text" name="okmsg" maxlength="60" placeholder="非必填：提交成功后的提示语" class="inputtext"/></div></li>
            <li><div class="lidivleft"><label>富表单method：</label></div><div class="lidivright"><label>post</label><input type="radio" name="method" value="1" checked="checked" style="margin-right: 20px;"/><label>get</label><input type="radio" name="method" value="2"/></div></li>
            <li><div class="lidivleft"><label>富表单描述：</label></div><div class="lidivright"><textarea name="description" placeholder="非必填：富表单描述或备注"></textarea></div></li>
            <li>
                <div class="lidivleft"><label>关联产品：</label></div>
                <div class="lidivright">
                    <select name="bindproduct">
                        <option value="">非必选</option>
                        <?php foreach ($productlist as $key => $value):?>
                        <option value="<?php echo $value['id']?>|<?php echo $value['title']?>|<?php echo $value['table']?>"><?php echo $value['title']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </li>
        </ul>
        <div>
            <input type="button" value="下一步" onclick="cmsContentUpdate()" class="divsubmit">
        </div>
    </form>
</div>
<script type="text/javascript">
    function cmsContentUpdate(){ 	  
      $.ajax({ 
        url:"<?php echo $addstep1_url;?>",
        type:"POST",
        data:$('#DbgMsFormEdit').serialize(),
        success:function(jsonresult){
            if(!jsonresult.match("^\{(.+:.+,*){1,}\}$")){
                alert(jsonresult);
            }else{
                var results = JSON.parse(jsonresult);
                if(results.result==1){
                    location.href='<?php echo $addstep2_url;?>&rfid='+results.rfid;
                    return;
               }else{
                    alert(jsonresult);
               }
            }
        }
      });
    }
</script>

