<style>
	.pop-window {position:fixed;top:25%;left:50%;width:680px;height:700px;margin:-180px 0 0 -330px;border-radius:5px;display:none;box-shadow: 0 0 10px #666;background-color: white; z-index: 5;}
	.zzinvisible{background-color:rgba(0,0,0,0.6);width:100%;height:900px;display: none;position: absolute;top: 0;left: 0;z-index: 4;}
	.zzvisible{background-color:rgba(0,0,0,0.6);width:100%;height:900px;display: block;position: absolute;top: 0;left: 0;z-index: 4;}
        .pop-window-close-a{font-size: 24px;padding-right: 7px;}
        .pop-window-close{text-align: right;}
        .formdivmulti{padding:10px;overflow: hidden;}
        .formdivmulti label{width:18%;float:left;}
        .formdivmulti textarea{float:left;width:80%;height:80px;}
        .divhead{overflow: hidden;font-size: 25px;}
        .divhead .left{float:left;width:50%;text-align: left;color: #7AAE21;padding: 10px;margin:10px;}
        .divhead .right{float:right;margin:10px;padding: 10px;background: none repeat scroll 0 0 #82C400; border-width: 0;color: #FFFFFF;border-radius: 6px;cursor:pointer; }
        .level1{margin: 10px;margin: 10px;}
        .level2{padding:10px;overflow: hidden;border-bottom: 1px #7AAE21 dashed;}
        .level2-1{padding:10px;overflow: hidden;background-color: #7AAE21;font-size:18px;}
        .level3{float:left;width: 6%;margin-right: 10px;padding: 3px;border: 1px #7AAE21 solid;text-align: center;cursor:pointer;}
        .level3-1{float:left;width: 6%;margin-right: 10px;padding: 3px;color:#7AAE21;font-size: 15px;text-align: center;overflow: hidden;}
        .level3-2{float:left;width: 6%;margin-right: 10px;padding: 3px;font-size: 18px;text-align: center;}
        .level3-button-left{float:left;width:40%;border:1px #7AAE21 solid;border-radius: 5px;background-color: #7AAE21;cursor:pointer;}
        .level3-button-right{float:right;width:40%;border:1px #7AAE21 solid;border-radius: 5px;background-color: #7AAE21;cursor:pointer;}
        .level3-1 .button{border:1px #7AAE21 solid;border-radius: 5px;background-color: #7AAE21;cursor:pointer;margin-left:5px;color:black;}
        .add-element, .js-event, .auth-regular{padding: 10px;}
        .add-element li, .js-event li, .auth-regular li{padding: 10px;font-size: 15px;border-bottom: 1px #7AAE21 dashed;}
        .add-element li input, .js-event li input, .auth-regular li input{margin-right: 10px;}
        #pop-add-element .title, #pop-js-event .title, #pop-auth-regular .title{font: bold;font-size: 20px;}
        .stylesearch{margin:0 10px 0 10px;text-align: right;}
        .stylesearch .text{height: 30px;margin: 10px;width: 33%;}
        .stylesearch .submit{background: #82c400 none repeat scroll 0 0;border-radius: 6px;border-width: 0;color: #ffffff;cursor: pointer;padding: 6px;}
        .replicate{background-color:#7AAE21;margin: 10px;overflow: hidden;padding:5px;}
        .replicate .left1{float:left;font-size: 20px;margin-right: 30px;}
        .replicate .left2{float:left;overflow: hidden;font-size: 20px;}
        .replicate .left2 input{width:300px;height:30px;}
</style>
<style type="text/css">
    div.dbgms_pagebreak{text-align: center;padding:30px 10px;height: 36px; overflow: hidden;}
    div.dbgms_pagebreak a{border:1px solid #e4e4e4; font-family:"Tahoma","Arial"; font-size:14px; height:30px; line-height: 30px; padding:0 12px; margin-left: 2px; display: inline-block; overflow: hidden; background: #FFF; color:#6a6a6a}
    div.dbgms_pagebreak a:hover{background:#0666c5;color:#FFF;text-decoration:none}
    div.dbgms_pagebreak a.on{background:#6e2685;color:#FFF}
    div.dbgms_pagebreak input.gopage{width:30px;position:relative;top:-11px;font-size:14px;height:30px;line-height:30px;margin-left:2px;display: inline-block; overflow: hidden;}
</style>
<div class="divhead">
    <div class="left"><?php echo $rfname;?>==>元素管理设置&nbsp;&nbsp;&nbsp;&nbsp;【记得重新生成html】</div>
    <div class="right" onclick="builddbtable(<?php echo $rfid;?>);">生成数据库表</div>
    <div class="right" onclick="addelement(<?php echo $rfid;?>);">添加富表单元素</div>
    <div class="right" onclick="buildhtml(<?php echo $rfid;?>);">生成html</div>
    <div class="right"><a href="<?php echo $curr_url.'&page='.$page.'&act=overview&rfid='. $rfid;?>" target="_blank" style="color:#fff;">【预览】</a></div>
</div>
<div class="level1">
    <div class="level2-1">
        <div class="level3-2" style="width:1%;">rid</div>
        <div class="level3-2">元素名称</div>
        <div class="level3-2">元素类型</div>
        <div class="level3">name设置</div>
        <div class="level3">value设置</div>
        <div class="level3">元素属性</div>
        <div class="level3">li和label</div>
        <div class="level3" style="width:3%;">排序</div>
        <div class="level3">禁用/启用</div>
        <div class="level3">设为表字段</div>
        <div class="level3">展示到crud</div>
        <div class="level3">设置js事件</div>
        <div class="level3">验证规则</div>
        <div class="level3">其它操作</div>
        <div class="level3">移除此元素</div>
    </div>
    <?php foreach ($lists as $key => $value):?>
    <div class="level2">
        <div class="level3-1" style="width:1%;"><?php echo $value['rid'];?></div>
        <div class="level3-1">
            <?php if($value['attrtype']=='select'):?>
                <div><?php echo $value['rname'];?></div>
                <div class="button" onclick="setselectoption(<?php echo $rfid;?>,
                                                            <?php echo $value['rid'];?>,
                                                            '<?php echo $value['rname'];?>',
                                                            '<?php echo $value['optionvalue'];?>',
                                                            '<?php echo htmlspecialchars($value['optionstyle']);?>',
                                                            '<?php echo $value['optioncontent'];?>');">
                设置option</div>
            <?php else:?>
                <?php echo $value['rname'];?>
            <?php endif;?>
        </div>
        <div class="level3-1">
            <?php 
                //echo $value['bname'].'-'.$value['attrtype'];
                echo $value['attrtype'];
            ?>
        </div>
        <div class="level3" onclick="setname(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>,
                                            '<?php echo $value['attrname'];?>',
                                            '<?php echo $value['rname'];?>',
                                            '<?php echo $value['namelength'];?>',
                                            '<?php echo $value['namecharset'];?>',
                                            '<?php echo $value['namecomment'];?>',
                                            '<?php echo $value['nametag'];?>'
                                            );">
        <?php echo $value['attrname'];?>&nbsp;</div>
        <div class="level3" onclick="setvalue(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>,
                                            '<?php echo $value['attrvalue'];?>',
                                            '<?php echo $value['rname'];?>');">
        <?php echo $value['attrvalue'];?>&nbsp;</div>
        <div class="level3" onclick="setattr(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>,
                                            '<?php echo $value['rname'];?>',
                                            '<?php echo $value['attrid'];?>',
                                            '<?php echo $value['attrclass'];?>',
                                            '<?php echo $value['attrmaxlength'];?>',
                                            '<?php echo $value['attrplaceholder'];?>'
                                            );">
        点击设置</div>
        <div class="level3" onclick="setlilabelstyle(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>,
                                            '<?php echo $value['rname'];?>',
                                            '<?php echo htmlspecialchars($value['listyle']);?>',
                                            '<?php echo htmlspecialchars($value['labelstyle']);?>',
                                            '<?php echo $value['labelcontent'];?>');">
        点击设置</div>
        <div class="level3" style="width:3%;" onclick="setsortnum(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>,
                                            '<?php echo $value['rname'];?>',
                                            '<?php echo $value['sortnum'];?>');">
        <?php echo $value['sortnum'];?>&nbsp;</div>
        <div class="level3">
            禁用<input type="radio" onclick="enable(<?php echo $rfid;?>,<?php echo $value['rid'];?>,0);" <?php if($value['enable'] == 0):?>checked="checked"<?php endif;?>>
            启用<input type="radio" onclick="enable(<?php echo $rfid;?>,<?php echo $value['rid'];?>,1);" <?php if($value['enable'] == 1):?>checked="checked"<?php endif;?>>
        </div>
        <div class="level3">
            <?php if($value['attrtype'] != 'button' && $value['attrtype'] != 'submit'):?>
            使用<input type="radio" onclick="setelementtotable(<?php echo $rfid;?>,<?php echo $value['rid'];?>,1);" <?php if($value['isrecord'] == 1):?>checked="checked"<?php endif;?>>
            不使用<input type="radio" onclick="setelementtotable(<?php echo $rfid;?>,<?php echo $value['rid'];?>,0);" <?php if($value['isrecord'] == 0):?>checked="checked"<?php endif;?>>
            <?php else:?>
            &nbsp;
            <?php endif;?>
        </div>
        <div class="level3">
            <?php if($value['attrtype'] != 'button' && $value['attrtype'] != 'submit'):?>
            展示<input type="radio" onclick="showtocrud(<?php echo $rfid;?>,<?php echo $value['rid'];?>,1);" <?php if($value['isshow'] == 1):?>checked="checked"<?php endif;?>>
            不展示<input type="radio" onclick="showtocrud(<?php echo $rfid;?>,<?php echo $value['rid'];?>,0);" <?php if($value['isshow'] == 0):?>checked="checked"<?php endif;?>>
            <?php else:?>
            &nbsp;
            <?php endif;?>
        </div>
        <div class="level3" onclick="setjsevent(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>,
                                            '<?php echo $value['rname'];?>');">
        <?php echo $value['jsename'];?>&nbsp;</div>
        <div class="level3" onclick="setauthregular(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>,
                                            '<?php echo $value['rname'];?>');">
        <?php echo $value['regname'];?>&nbsp;</div>
        <div class="level3"><a href="<?php echo $elementlevelset_url.'&rfid='.$rfid.'&rid='.$value['rid'].'&rfname='.$rfname;?>">元素设置</a></div>
        <div class="level3" onclick="removeelement(<?php echo $rfid;?>,
                                            <?php echo $value['rid'];?>);">
        移除</div>
    </div>
    <?php endforeach;?>
</div>
<div class="replicate">
    <div class="left1">元素的li样式复制</div>
    <form method="post" id="DbgMsFormReplicateLiStyle" name="DbgMsFormEdit" enctype="multipart/form-data" class="left2">
        <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
        <label>复制 </label><input type="text" name="sourcerid" class="text" placeholder="请输入一个数据源表单元素rid">
        <label>的li样式给 </label><input type="text" name="destinationrids" class="text" placeholder="请输入多个目标表单元素rid：例如 25|26|27">
        <a class="dbgms_btn_submit" onclick="replicatelistyle()" href="javascript:;">执行</a>
    </form>
</div>
<div class="replicate">
    <div class="left1">元素的label样式复制</div>
    <form method="post" id="DbgMsFormReplicateLabelStyle" name="DbgMsFormEdit" enctype="multipart/form-data" class="left2">
        <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
        <label>复制 </label><input type="text" name="sourcerid" class="text" placeholder="请输入一个数据源表单元素rid">
        <label>的label样式给 </label><input type="text" name="destinationrids" class="text" placeholder="请输入多个目标表单元素rid：例如 25|26|27">
        <a class="dbgms_btn_submit" onclick="replicatelabelstyle()" href="javascript:;">执行</a>
    </form>
</div>
<div class="zzinvisible" id="zzdiv"></div>
<!--pop-set-name begin-->
<div class="pop-window" id="pop-set-name">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-name-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormSetName" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div style="text-align: center;margin-bottom: 15px;"><h3 class="title"> </h3></div>
             <div class="formdivmulti">
                 <label>属性name：</label>
                 <textarea name="attrname" class="attrname" placeholder="必填,用于提交表单信息"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>crud列表展示的标识：</label>
                 <textarea name="nametag" class="nametag" placeholder="若要记录到数据库中,则必填"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>保存在表中的数据类型：</label>
                 varchar<input type="radio" name="namecharset" value="varchar" class="varchar" style="margin-right: 20px;">
                 int<input type="radio" name="namecharset" value="int" class="int">
             </div>
             <div class="formdivmulti">
                 <label>数据表中的长度namelength：</label>
                 <textarea name="namelength" class="namelength" placeholder="必填,用于限定保存数据长度"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>数据表中的备注namecomment：</label>
                 <textarea name="namecomment" class="namecomment" placeholder="非必填,用于在数据表中显示备注信息"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetName()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-set-name begin-->

<!--pop-set-value begin-->
<div class="pop-window" id="pop-set-value">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-value-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormSetValue" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div style="text-align: center;margin-bottom: 15px;"><h3 class="title"> </h3></div>
             <div class="formdivmulti">
                 <label>属性value：</label>
                 <textarea name="attrvalue" class="attrvalue" placeholder="必填,用于提交表单信息"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetValue()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-set-value begin-->

<!--pop-set-attr begin-->
<div class="pop-window" id="pop-set-attr">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-attr-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormSetAttr" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div style="text-align: center;margin-bottom: 15px;"><h3 class="title"> </h3></div>
             <div class="formdivmulti">
                 <label>属性id：</label>
                 <textarea name="attrid" class="attrid" placeholder="非必填,标签元素属性id"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>属性class：</label>
                 <textarea name="attrclass" class="attrclass" placeholder="非必填,标签元素属性class"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>属性maxlength：</label>
                 <textarea name="attrmaxlength" class="attrmaxlength" placeholder="非必填,标签元素属性maxlength"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>属性attrplaceholder：</label>
                 <textarea name="attrplaceholder" class="attrplaceholder" placeholder="非必填,标签元素属性placeholder"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetAttr()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-set-attr begin-->

<!--pop-set-li-label style begin-->
<div class="pop-window" id="pop-set-li-label">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-li-label-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormSetLiLabel" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div style="text-align: center;margin-bottom: 15px;"><h3 class="title"> </h3></div>
             <div class="formdivmulti">
                 <label>li的样式：</label>
                 <textarea name="listyle" class="listyle" placeholder="非必填,设置li标签的样式"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>label的样式：</label>
                 <textarea name="labelstyle" class="labelstyle" placeholder="非必填,设置label标签的样式"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>label标签间的内容：</label>
                 <textarea name="labelcontent" class="labelcontent" placeholder="非必填,设置label标签的间的文字"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetLiLabel()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-set-li-label style begin-->

<!--pop-set-sortnum begin-->
<div class="pop-window" id="pop-set-sortnum">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-sortnum-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormSetSortnum" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div style="text-align: center;margin-bottom: 15px;"><h3 class="title"> </h3></div>
             <div class="formdivmulti">
                 <label>排序值：</label>
                 <textarea name="sortnum" class="sortnum" placeholder="非必填,用于表单展示时的页面排版"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetSortnum()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-set-value begin-->

<!--pop-add-element begin-->
<div class="pop-window" id="pop-add-element">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-add-element-close">×</a></div>
     <div>
            <form method="post" id="DbgMsFormAddElementSearch" name="DbgMsFormEdit" enctype="multipart/form-data" class="stylesearch">
                <input type="hidden" name="rfid" value="<?php echo $rfid;?>">
                <input type="text" name="q" class="text" value="<?php echo empty($search['q'])?'':$search['q'];?>" placeholder="请输入富表单元素名或其所属风格组名"> &nbsp;
                <input type="button" value="搜索" class="submit" onclick="cmsContentAddElementSearch()">
            </form>
     </div>
     <div style="text-align: center;"><h3 class="title">添加富表单元素</h3></div>
     <div>
         <form method="post" id="DbgMsFormAddElement" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="">
             <div class="formdivmulti">
                 <ul class="add-element">
                 </ul>
                 <div class="pagebreak"></div>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentAddElement()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-add-element begin-->

<!--pop-select-option begin-->
<div class="pop-window" id="pop-select-option">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-select-option-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormSetSelectOption" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div style="text-align: center;margin-bottom: 15px;"><h3 class="title">标题</h3></div>
             <div class="formdivmulti">
                 <label>多个option的属性值：</label>
                 <textarea name="optionvalue" class="optionvalue" placeholder="必填,设置select的子级option标签的值,以'|'隔开;如1|2|3"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>多个option的展示内容：</label>
                 <textarea name="optioncontent" class="optioncontent" placeholder="必填,设置select的子级option标签间展示的内容,以'|'隔开;如火车|卡车|动车"></textarea>
             </div>
             <div class="formdivmulti">
                 <label>option的样式：</label>
                 <textarea name="optionstyle" class="optionstyle" placeholder="非必填,设置select的子级option标签的样式"></textarea>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentSetSelectOption()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-select-option begin-->

<!--pop-js-event begin-->
<div class="pop-window" id="pop-js-event">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-js-event-close">×</a></div>
     <div>
         <form method="post" id="DbgMsFormJSevent" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div style="text-align: center;margin-bottom: 15px;"><h3 class="title">添加表单元素js事件</h3></div>
             <div class="formdivmulti">
                 <ul class="js-event">
                 </ul>
                 <div class="pagebreak"></div>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentJSEvent()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-js-event begin-->

<!--pop-auth-regular begin-->
<div class="pop-window" id="pop-auth-regular">
     <div class="pop-window-close"><a href="javascript:;" title="关闭" class="pop-window-close-a" id="set-auth-regular-close">×</a></div>
     <div>
            <form method="post" id="DbgMsFormAuthRegularSearch" name="DbgMsFormEdit" enctype="multipart/form-data" class="stylesearch">
                <input type="hidden" name="rfid" value="<?php echo $rfid;?>">
                <input type="hidden" name="rid" class="hiddenrid" value="">
                <input type="text" name="q" class="text" value="<?php echo empty($search['q'])?'':$search['q'];?>" placeholder="请输入验证规则名称"> &nbsp;
                <input type="button" value="搜索" class="submit" onclick="cmsContentAuthRegularSearch()">
            </form>
     </div>
     <div style="text-align: center;"><h3 class="title">添加表单元素验证规则</h3></div>
     <div>
         <form method="post" id="DbgMsFormAuthRegular" name="DbgMsFormEdit" enctype="multipart/form-data">
             <input type="hidden" name="rfid" class="hiddenrfid" value="<?php echo $rfid;?>">
             <input type="hidden" name="rid" class="hiddenrid" value="">
             <div class="formdivmulti">
                 <ul class="auth-regular">
                 </ul>
                 <div class="pagebreak"></div>
             </div>
             <div style="text-align: center;"><a class="dbgms_btn_submit" onclick="cmsContentAuthRegular()" href="javascript:;">确认</a></div>
         </form>
     </div>
</div>
<!--pop-auth-regular begin-->

 <script type="text/javascript"> 
        jQuery(document).ready(function($) {
                $('#set-name-close').click(function(){
                        $('#pop-set-name').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-value-close').click(function(){
                        $('#pop-set-value').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-attr-close').click(function(){
                        $('#pop-set-attr').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-li-label-close').click(function(){
                        $('#pop-set-li-label').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-sortnum-close').click(function(){
                        $('#pop-set-sortnum').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-add-element-close').click(function(){
                        $('#pop-add-element').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-select-option-close').click(function(){
                        $('#pop-select-option').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-js-event-close').click(function(){
                        $('#pop-js-event').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
                $('#set-auth-regular-close').click(function(){
                        $('#pop-auth-regular').slideUp(100);
                        $('#zzdiv').attr('class','zzinvisible');
                });
        })
        
        function slidedownname(){
            $('#pop-set-name').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownvalue(){
            $('#pop-set-value').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownattr(){
            $('#pop-set-attr').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownlilabel(){
            $('#pop-set-li-label').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownsortnum(){
            $('#pop-set-sortnum').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownaddelement(){
            $('#pop-add-element').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownselectoption(){
            $('#pop-select-option').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownjsevent(){
            $('#pop-js-event').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function slidedownauthregular(){
            $('#pop-auth-regular').slideDown(100);
            $('#zzdiv').attr('class','zzvisible');
        }
        
        function setname(rfid,rid,attrname,rname,namelength,namecharset,namecomment,nametag){
            $('#DbgMsFormSetName .hiddenrfid').val(rfid);//传递富表单rfid
            $('#DbgMsFormSetName .hiddenrid').val(rid);//传递富表单元素rid
            $('#DbgMsFormSetName .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">name</span>属性');
            $('#DbgMsFormSetName .attrname').val(attrname);
            $('#DbgMsFormSetName .nametag').val(nametag);
            $('#DbgMsFormSetName .namelength').val(namelength);
            $('#DbgMsFormSetName .namecomment').val(namecomment);
            if(namecharset != ''){
                    $('#DbgMsFormSetName .'+namecharset).attr('checked','checked');
            }
            slidedownname();
        }
        
        function setvalue(rfid,rid,attrvalue,rname){
            $('#DbgMsFormSetValue .hiddenrfid').val(rfid);//传递富表单rfid
            $('#DbgMsFormSetValue .hiddenrid').val(rid);//传递富表单元素rid
            $('#DbgMsFormSetValue .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">value</span>属性');
            $('#DbgMsFormSetValue .attrvalue').val(attrvalue);
            slidedownvalue();
        }
        
        function setattr(rfid,rid,rname,attrid,attrclass,attrmaxlength,attrplaceholder){
            $('#DbgMsFormSetAttr .hiddenrfid').val(rfid);//传递富表单rfid
            $('#DbgMsFormSetAttr .hiddenrid').val(rid);//传递富表单元素rid
            $('#DbgMsFormSetAttr .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">id、class、attrmaxlength、attrplaceholder</span>属性');
            $('#DbgMsFormSetAttr .attrid').val(attrid);
            $('#DbgMsFormSetAttr .attrclass').val(attrclass);
            $('#DbgMsFormSetAttr .attrmaxlength').val(attrmaxlength);
            $('#DbgMsFormSetAttr .attrplaceholder').val(attrplaceholder);
            slidedownattr();
        }
        
        function setlilabelstyle(rfid,rid,rname,listyle,labelstyle,labelcontent){
            $('#DbgMsFormSetLiLabel .hiddenrfid').val(rfid);//传递富表单rfid
            $('#DbgMsFormSetLiLabel .hiddenrid').val(rid);//传递富表单元素rid
            $('#DbgMsFormSetLiLabel .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">li和label标签的</span>样式');
            $('#DbgMsFormSetLiLabel .listyle').val(listyle);
            $('#DbgMsFormSetLiLabel .labelstyle').val(labelstyle);
            $('#DbgMsFormSetLiLabel .labelcontent').val(labelcontent);
            slidedownlilabel();
        }
        
        function setsortnum(rfid,rid,rname,sortnum){
            $('#DbgMsFormSetSortnum .hiddenrfid').val(rfid);//传递富表单rfid
            $('#DbgMsFormSetSortnum .hiddenrid').val(rid);//传递富表单元素rid
            $('#DbgMsFormSetSortnum .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">排序值</span>');
            $('#DbgMsFormSetSortnum .sortnum').val(sortnum);
            slidedownsortnum();
        }
        
        function setselectoption(rfid,rid,rname,optionvalue,optionstyle,optioncontent){
            $('#DbgMsFormSetSelectOption .hiddenrfid').val(rfid);//传递富表单rfid
            $('#DbgMsFormSetSelectOption .hiddenrid').val(rid);//传递富表单元素rid
            $('#DbgMsFormSetSelectOption .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">option的值和样式</span>');
            $('#DbgMsFormSetSelectOption .optionvalue').val(optionvalue);//多个option的值
            $('#DbgMsFormSetSelectOption .optionstyle').val(optionstyle);//多个optionstyle的值
            $('#DbgMsFormSetSelectOption .optioncontent').val(optioncontent);//多个optionstyle的值
            slidedownselectoption();
        }
        
        function setjsevent(rfid,rid,rname,page){
            if(!page){
                page = 1;
            }
            //1. 获取js事件
            $.ajax({ 
              url:"<?php echo $getjsevent_url;?>&page="+page,
              type:"POST",
              data:{'rfid':rfid,'rid':rid,'rname':rname},
              success:function(result){
                  var jresult = JSON.parse(result);
                  var lists = jresult.lists;
                  var pagebreak = jresult.pagebreak;
                  $('#DbgMsFormJSevent .hiddenrfid').val(rfid);//传递富表单rfid
                  $('#DbgMsFormJSevent .hiddenrid').val(rid);//传递富表单rfid
                  $('#DbgMsFormJSevent .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">js事件</span>');
                  var listshtml = '';
                  var length = lists.length;
                  for(var i=0; i<length; i++){
                      listshtml += '<li><input type="radio" value="'+lists[i]['jseid']+'|'+lists[i]['jsename']+'" name="eventname">'+lists[i]['jsename']+'【'+lists[i]['eventname']+'】</li>';
                  }
                  $('#DbgMsFormJSevent .js-event').html(listshtml);
                  $('#DbgMsFormJSevent .pagebreak').html(pagebreak);
              }
            });
            slidedownjsevent();
        }
        
        function setauthregular(rfid,rid,rname,page,q){
            if(!page){
                page = 1;
            }
            if(!q){
                q = '';
            }
            //1. 获取验证规则
            $.ajax({ 
              url:"<?php echo $getauthregular_url;?>&page="+page+"&q="+q,
              type:"POST",
              data:{'rfid':rfid,'rid':rid,'rname':rname},
              success:function(result){
                  var jresult = JSON.parse(result);
                  var lists = jresult.lists;
                  var pagebreak = jresult.pagebreak;
                  $('#DbgMsFormAuthRegular .hiddenrfid').val(rfid);//传递富表单rfid
                  $('#DbgMsFormAuthRegular .hiddenrid').val(rid);//传递富表单rfid
                  $('#DbgMsFormAuthRegularSearch .hiddenrid').val(rid);//传递富表单rfid
                  $('#DbgMsFormAuthRegular .title').html('设置富表单元素 <span style="color:red;">'+rname+'</span> 的 <span style="color:#7AAE21;">提交表单时的验证规则</span>');
                  var listshtml = '';
                  var length = lists.length;
                  for(var i=0; i<length; i++){
                      listshtml += '<li><input type="radio" value="'+lists[i]['regid']+'|'+lists[i]['regname']+'" name="regularinfo">'+lists[i]['regname']+'</li>';
                  }
                  $('#DbgMsFormAuthRegular .auth-regular').html(listshtml);
                  $('#DbgMsFormAuthRegular .pagebreak').html(pagebreak);
              }
            });
            slidedownauthregular();
        }
        
        function replicatelistyle(){
            $.ajax({ 
              url:"<?php echo $replicatelistyle_url;?>",
              type:"POST",
              data:$('#DbgMsFormReplicateLiStyle').serialize(),
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
        
        function replicatelabelstyle(){
            $.ajax({ 
              url:"<?php echo $replicatelabelstyle_url;?>",
              type:"POST",
              data:$('#DbgMsFormReplicateLabelStyle').serialize(),
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
        
        function cmsContentAuthRegularSearch(){
            //1. 获取验证规则
            $.ajax({ 
              url:"<?php echo $getauthregular_url;?>",
              type:"POST",
              data:$('#DbgMsFormAuthRegularSearch').serialize(),
              success:function(result){
                  var jresult = JSON.parse(result);
                  var lists = jresult.lists;
                  var pagebreak = jresult.pagebreak;
                  var listshtml = '';
                  var length = lists.length;
                  for(var i=0; i<length; i++){
                      listshtml += '<li><input type="radio" value="'+lists[i]['regid']+'|'+lists[i]['regname']+'" name="regularinfo">'+lists[i]['regname']+'</li>';
                  }
                  $('#DbgMsFormAuthRegular .auth-regular').html(listshtml);
                  $('#DbgMsFormAuthRegular .pagebreak').html(pagebreak);
              }
            });
        }
        
        function cmsContentSetName(){ 	  
          $.ajax({ 
            url:"<?php echo $setname_url;?>",
            type:"POST",
            data:$('#DbgMsFormSetName').serialize(),
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
        function cmsContentSetValue(){ 	  
          $.ajax({ 
            url:"<?php echo $setvalue_url;?>",
            type:"POST",
            data:$('#DbgMsFormSetValue').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function cmsContentSetAttr(){ 	  
          $.ajax({ 
            url:"<?php echo $setattr_url;?>",
            type:"POST",
            data:$('#DbgMsFormSetAttr').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function cmsContentSetLiLabel(){ 	  
          $.ajax({ 
            url:"<?php echo $setlilabel_url;?>",
            type:"POST",
            data:$('#DbgMsFormSetLiLabel').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function cmsContentSetSortnum(){ 	  
          $.ajax({ 
            url:"<?php echo $setsortnum_url;?>",
            type:"POST",
            data:$('#DbgMsFormSetSortnum').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function enable(rfid,rid,value){
          $.ajax({ 
            url:"<?php echo $enable_url;?>",
            type:"POST",
            data:{'rfid':rfid,'rid':rid,'value':value},
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function setelementtotable(rfid,rid,value){
          $.ajax({ 
            url:"<?php echo $setelementtotable_url;?>",
            type:"POST",
            data:{'rfid':rfid,'rid':rid,'value':value},
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function showtocrud(rfid,rid,value){
          $.ajax({ 
            url:"<?php echo $showtocrud_url;?>",
            type:"POST",
            data:{'rfid':rfid,'rid':rid,'value':value},
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function addelement(rfid,page,q){
            if(!page){
                page = 1;
            }
            if(!q){
                q = '';
            }
            //1. 获取除了已有的富表单元素
            $.ajax({ 
              url:"<?php echo $getrichelement_url;?>&page="+page+"&q="+q,
              type:"POST",
              data:{'rfid':rfid},
              success:function(result){
                  var jresult = JSON.parse(result);
                  var lists = jresult.lists;
                  var pagebreak = jresult.pagebreak;
                  var rfid = jresult.rfid;
                  $('#DbgMsFormAddElement .hiddenrfid').val(rfid);//传递富表单rfid
                  var listshtml = '';
                  var length = lists.length;
                  for(var i=0; i<length; i++){
                      listshtml += '<li><input type="checkbox" value="'+lists[i]['rid']+'" name="relement[]">'+lists[i]['rname']+'【'+lists[i]['gname']+'】</li>';
                  }
                  $('#DbgMsFormAddElement .add-element').html(listshtml);
                  $('#DbgMsFormAddElement .pagebreak').html(pagebreak);
              }
            });
            //2. 展示到弹出框中
            slidedownaddelement();
        }
        function cmsContentAddElement(){
          $.ajax({ 
            url:"<?php echo $addelement_url;?>",
            type:"POST",
            data:$('#DbgMsFormAddElement').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function cmsContentAddElementSearch(){
          $.ajax({ 
            url:"<?php echo $getrichelement_url;?>",
            type:"POST",
            data:$('#DbgMsFormAddElementSearch').serialize(),
              success:function(result){
                  var jresult = JSON.parse(result);
                  var lists = jresult.lists;
                  var pagebreak = jresult.pagebreak;
                  var rfid = jresult.rfid;
                  $('#DbgMsFormAddElement .hiddenrfid').val(rfid);//传递富表单rfid
                  var listshtml = '';
                  var length = lists.length;
                  for(var i=0; i<length; i++){
                      listshtml += '<li><input type="checkbox" value="'+lists[i]['rid']+'" name="relement[]">'+lists[i]['rname']+'【'+lists[i]['gname']+'】</li>';
                  }
                  $('#DbgMsFormAddElement .add-element').html(listshtml);
                  $('#DbgMsFormAddElement .pagebreak').html(pagebreak);
              }
          });
        }
        function removeelement(rfid,rid){
            if (!confirm("确认移除？")) {
                    window.event.returnValue = false;
            }else{
                    $.ajax({ 
                      url:"<?php echo $removeelement_url;?>",
                      type:"POST",
                      data:{'rfid':rfid,'rid':rid},
                      success:function(result){
                        if(result==1){
                          location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                          return;
                        }else{
                          alert(result);
                        }
                      }
                    });
            }
        }
        function cmsContentSetSelectOption(){
          $.ajax({ 
            url:"<?php echo $setselectoption_url;?>",
            type:"POST",
            data:$('#DbgMsFormSetSelectOption').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function cmsContentJSEvent(){
          $.ajax({ 
            url:"<?php echo $setjsevent_url;?>",
            type:"POST",
            data:$('#DbgMsFormJSevent').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function cmsContentAuthRegular(){
          $.ajax({ 
            url:"<?php echo $setauthregular_url;?>",
            type:"POST",
            data:$('#DbgMsFormAuthRegular').serialize(),
            success:function(result){
              if(result==1){
                location.href='<?php echo $manageelement_url.'&page='.$page.'&rfid='.$rfid.'&rfname='.$rfname;?>';
                return;
              }else{
                alert(result);
              }
            }
          });
        }
        function builddbtable(rfid){
            if (!confirm("此操作将导致数据丢失,且不可挽回,确认生成数据库表？")) {
                    window.event.returnValue = false;
            }else{
                    $.ajax({ 
                      url:"<?php echo $builddbtable_url;?>",
                      type:"POST",
                      data:{'rfid':rfid},
                      success:function(result){
                        if(result==1){
                          alert("成功!");
                          return;
                        }else{
                          alert(result);
                        }
                      }
                    });
            }
        }
        function buildhtml(rfid){
          $.ajax({ 
            url:"<?php echo $buildhtml_url;?>",
            type:"POST",
            data:{'rfid':rfid},
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
    <script type="text/javascript">
        var dbgms_pagebreak =document.getElementById('page1');
        if(dbgms_pagebreak!=undefined){
            dbgms_pagebreak.setAttribute('class','on');
        }
    </script>