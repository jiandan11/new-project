<style>
    .addstep1_div{text-align: center;width:100%;}
    .addstep1_div ul {font-size: 15px;margin: 10px;overflow: hidden;}
    .addstep1_div ul li{float:left;width:19%;margin-right: 3px;text-align: left;}
    .addstep1_div label{font-size: 25px;color:green;}
    .addstep1_div ul li input{margin-right: 5px;}
    .addstep1_div div input,.dbg_top form .dbg_top_submit{
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
    
</style>

 <div class="dbg_top">
  <div class="span_r" style="float:left;margin-left:30px;">
   <form action="<?php echo $addstep2_url;?>" method="post">
    <input type="hidden" name="rfid" value="<?php echo $rfid;?>">
    <input type="text" name="q" class="titxt" value="<?php echo empty($search['q'])?'':$search['q'];?>" placeholder="请输入富表单元素名或其所属风格组名" style="width: 250px"> &nbsp;
    <input type="submit" value="搜索 " class="dbg_top_submit">
   </form>
  </div>
 </div>

<div class="addstep1_div">
    <label>创建富表单》步骤二》请选择富表单元素</label>
    <form method="post" id="DbgMsFormEdit" enctype="multipart/form-data">
        <input type="hidden" name="rfid" value="<?php echo $rfid;?>">
        <input type="hidden" name="submit" value="submit">
        <ul>
            <?php foreach ($richelement as $key => $value):?>
                <?php if( ($key)%5 == 0 ):?>
                    </ul>
                    <ul>
                <?php endif;?>
                    <li><input type="checkbox" value="<?php echo $value['rid'];?>" name="relement[]">
                        <?php echo $value['rname'];?><?php if($value['gname'] != ''):?>【<?php echo $value['gname'];?>】<?php else:?>&nbsp;<?php endif;?></li>
            <?php endforeach;?>
        </ul>
        <div><?php echo $pagebreak;?></div>
        <div>
            <input type="button" value="下一步" onclick="cmsContentUpdate()">
        </div>
    </form>
</div>
<script type="text/javascript">
    function cmsContentUpdate(){ 	  
      $.ajax({ 
        url:"<?php echo $addstep2_url;?>",
        type:"POST",
        data:$('#DbgMsFormEdit').serialize(),
        success:function(jsonresult){
            if(!jsonresult.match("^\{(.+:.+,*){1,}\}$")){
                alert(jsonresult);
            }else{
                var results = JSON.parse(jsonresult);
                if(results.result==1){
                    alert("成功!");
                    location.href='<?php echo $curr_url;?>';
                    return;
               }else{
                    alert(jsonresult);
               }
            }
        }
      });
    }
</script>
