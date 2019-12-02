<?php include '_head.php'?>
    <style type="text/css">
        .back_color{
            background-color:#efbc0c;
        }
    </style>
<?php $colum = getColumn(1, $_channel["sign"]); ?>
<div class="fwmain" style="position:relative;height:793px;min-height:10px;position:relative;" rel="13">
  <div class="edit_putHere  block_area" rel="83" id="83" saveTitle="area83" style="width:1200px;height:134px;z-index:100;left:0px;top:0px;position:absolute; ">
    <div class="label advertising" id="82" rel="82" titles="文字"  usestate="1" style='width:200px;height:48px;z-index:100;left:500px;top:20px;position:absolute;margin-left:0px;'>
      <div class="label_content advContent text82">
        <p style="text-align:center;"> <span style="font-size:24px;font-family:'Microsoft YaHei';"><?php echo $colum['name'] ?></span> </p>
      </div>
    </div>
    <script type="text/javascript">
        $(function(){tlancv('82','500')});
    </script>
    <div class="label clear sxdh85" id="85" rel="85" titles="竖形导航"   usestate="1" style='width:419px;height:45px;z-index:100;left:391px;top:73px;position:absolute;margin-left:0px;'> 
    <script>
      $('#85').css('height','auto');
    </script>
      <div class="label_content verticalNav85">
        <?php foreach ($colum['list'] as $key=>$value) : ?>
        <h1 class="sxdh1"><a class="<?php echo $key==0?'back_color':'' ?>" style="font-size:14px;font-family:SimSun;" href="<?php echo $value['link'] ?>"><?php echo $value['name'] ?></a></h1>
        <?php endforeach; ?>
      </div>
      <div class="label_foot"></div>
    </div>
    <style type="text/css">
        .verticalNav85{padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px;}
        .verticalNav85 h1,.verticalNav85 h2,.verticalNav85 li{font-weight:normal;}
        .verticalNav85 h1{width:126px;height:45px;margin-left:10px;background-color:#f2f8fc;float:left;}
        .verticalNav85 h2{width:126px;height:45px;margin-left:10px;background-color:#f2f8fc;float:left;}
        .verticalNav85 li{width:126px;height:45px;margin-left:10px;background-color:#f2f8fc;float:left;}
        .verticalNav85 h1 a{display:inline-block;width:100%;padding-left:0px;line-height:45px;color:#000;text-align:center;}
        .verticalNav85 h2 a{display:inline-block;width:100%;padding-left:0px;line-height:45px;color:#000;text-align:center;}
        .verticalNav85 li a{display:inline-block;width:100%;padding-left:0px;line-height:45px;color:#000;text-align:center;}
        .verticalNav85 .selectCheck a,.verticalNav85 h1 a:hover,.verticalNav85 h2 a:hover,.verticalNav85 li a:hover{font-weight:normal;text-align:center;}
        .verticalNav85 .selectCheck,.verticalNav85 h1:hover,.verticalNav85 h2:hover,.verticalNav85 li:hover{background-color:#efbc0c;}
    </style>
    <script type="text/javascript">
        $(function(){tlancv('85','391')});
    </script>
  </div>
  <div class="label advertising" id="86" rel="86" titles="文字"  usestate="1" style='width:1200px;height:661px;z-index:100;left:0px;top:132px;position:absolute;margin-left:0px;'>
    <div class="label_content advContent text86">
        <?php $data = getColumn(1, $colum['list'][0]['sign']); ?>
      <p> <span style="line-height:2;font-size:14px;font-family:'Microsoft YaHei';"><?php echo $data['content']['content'] ?></span> </p>
    </div>
  </div>
  <script type="text/javascript">
      $(function(){tlancv('86','0')});
  </script>
</div>


<?php include '_foot.php'?>