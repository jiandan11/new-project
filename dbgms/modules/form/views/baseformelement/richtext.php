<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        <div style="width:200px;">
        <ul>
            <li>
                <label>第一个li</label>
                <?php $diyf['form']='DbgMsFormEdit';$diyf['name']='富文本编辑器';$diyf['field']='content';?>
                <?php dbg_diyfield ( 'load', 'ueditor', $diyf,'asdlkfkjsdafsafdhsladfhk' );?>
            </li>
<!--            <li>
                <label>第二个li</label>
                <?php //$diyf['form']='DbgMsFormEdit';$diyf['name']='富文本编辑器';$diyf['field']='contents';?>
                <?php //dbg_diyfield ( 'load', 'ueditor', $diyf,'asdlkfkjsdafsafdhsladfhk' );?>
            </li>-->
        </ul>
        </div>
    </body>
</html>
