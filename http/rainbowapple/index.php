<html lang="ja">
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
</head>
<body style="background-image:url(./static/back.png);background-size:contain;">
	<?php
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 0;
		}
		if($_GET['size']=='low'){
			$low = true;
			$size=$_GET['size'];
		}else{
			$low = false;
		}
		$files = scandir("./vrchat");
		$max=floor((count($files)-3)/12);
		if($page < 0){
			$page=0;
		}
		if($page > $max){
			$page=$max;
		}
	?>
	<div class="images">
		<?php
		for ($i=0; $i<3; $i++){
		?>
		<?php
			for ($j=0; $j<4; $j++){
				$num=count($files)-($page*12+4*$i+$j) - 1;

				if($num <= 1){
					continue;
				}
		?>
				<p style="float:left;margin-right:2%;width:23%">
					<a id="<?php $co=4*$i+$j;echo $co ?>" href="#<?php print("$files[$num]")?>" width="100%" onclick="disableMultiple()"><img src="
<?php $thumb="./thumb/".substr($files[$num], 0, -4).".png";if(file_exists($thumb)){echo $thumb;}else{echo "./static/thumb.png";}?>" width="100%"></a><?php print(substr("$files[$num]",17,16));?>
					<a id="<?php print("$files[$num]")?>" href="#close" class="lb" onclick="disableMultiple()"><img src="./<?php if($low && file_exists("low/".substr($files[$num], 0, -4)."png")){print("low/".substr($files[$num], 0, -4));}else{print("vrchat/$files[$num]");}?>" width="100%"></a>
				</p>
			<?php
			}
		?>
		<?php
		}
		?>
		<a id="close" href="#close" onclick="disableMultiple()"></a>
	</div>
	<div style="position:fixed;bottom:0;width:100%;height:15%;text-align:center;right-margin:0">
		<p>
				<input id="pre" type="button" value="前へ" <?php $prevpage=$page-1;?> onclick="disableMultiple();<?php if($page!=0){print("location.href='/RainbowApple/index.php?page=$prevpage&size=$size'");}?>" <?php if($page==0){echo 'disabled';}?>>
			<?php
				print("$page");
				print("/");
				print("$max");
			 ?>
				<input id="nex" type="button" value="次へ" <?php $nextpage=$page+1;?> onclick="disableMultiple();<?php if($page!=$max){ print("location.href='/RainbowApple/index.php?page=$nextpage&size=$size'");}?>" <?php if($page==$max){echo 'disabled';}?>>
		</p>
    <div>
    <?php
      for ($i=0; $i<= $max; $i++){
     ?>
       <input type="button" <?php if($page==$i){echo 'disabled';}?> value='<?php print("$i")?>' onclick="location.href='/RainbowApple/index.php?page=<?php print("$i&size=$size");?>'">
    <?php
      }
    ?>
    </div>
    <div>
       <input type="button" <?php if($page==$i){echo 'disabled';}?> value='<?php if($low){print("高解像度にする");}else{print("低解像度にする");}?>' onclick="location.href='/RainbowApple/index.php?page=<?php if($low){ print("$page&size=");}else{print("$page&size=low");}?>'">
    </div>
	</div>
	<script>
		var lock = false;
		function disableMultiple(){
			if(lock == true){
				event.preventDefault();
			}
			if(!lock){
				window.setTimeout(function(){
					console.log("reset");
					lock = false;
				}
					,200);
				lock = true;
			}
		}
	</script>
</body>
</html>
